<?hh

namespace HH\Lib\Experimental\OS;
use namespace HH\Lib\C;
use namespace HH\Lib\Vec;
use namespace \HH\Lib\_Private\_OS;
use type HH\Lib\OS\{FileDescriptor, IsNotADirectoryException};
use function HH\Lib\OS\{close, open};

newtype pid_t as arraykey = int;
newtype ExitCode as int = int;

<<__Sealed(
  posix_spawn_file_actions_addopen::class,
  posix_spawn_file_actions_adddup2::class,
  posix_spawn_file_actions_addchdir_np::class,
)>>
interface PosixSpawnFileActionsSetter {}

final class posix_spawn_file_actions_addopen
  implements PosixSpawnFileActionsSetter {
  public function __construct(
    public int $filedes,
    public string $path,
    public int $oflag,
    public int $mode,
  ) {}
}

final class posix_spawn_file_actions_adddup2
  implements PosixSpawnFileActionsSetter {
  public function __construct(
    public FileDescriptor $filedes,
    public int $newfiledes,
  ) {}
}

final class posix_spawn_file_actions_addchdir_np
  implements PosixSpawnFileActionsSetter {
  public function __construct(public string $path) {
  }
}

type posix_spawn_file_actions_t = vec<PosixSpawnFileActionsSetter>;

const int POSIX_SPAWN_SETPGROUP = 2;
const int POSIX_SPAWN_SETSID = 128;

type PosixSpawnFlags = int;

type posix_spawnattr_t = shape(
  'posix_spawnattr_setpgroup' => pid_t,
  'posix_spawnattr_setflags' => PosixSpawnFlags,
);

function posix_spawnp(
  string $file,
  posix_spawn_file_actions_t $file_actions,
  posix_spawnattr_t $attributes,
  vec<string> $argv,
  vec<string> $envp,
): pid_t {
  $default_fork_and_execve = (
    string $path,
    vec<string> $argv,
    vec<string> $envp,
    dict<int, FileDescriptor> $fds,
    _OS\ForkAndExecveOptions $options,
  ) ==> {
    $cwd = $options['cwd'] ?? null;
    $dev_null_fd = open('/dev/null', _OS\O_RDWR);
    try {
      $fds[_OS\STDIN_FILENO] ??= $dev_null_fd;
      $fds[_OS\STDOUT_FILENO] ??= $dev_null_fd;
      $fds[_OS\STDERR_FILENO] ??= $dev_null_fd;
      return _OS\fork_and_execve(
        $cwd is null ? $path : $cwd.'/'.$path,
        $argv,
        $envp,
        $fds,
        $options,
      );
    } finally {
      close($dev_null_fd);
    }
  };
  $fork_and_execve = C\reduce(
    Vec\reverse($file_actions),
    ($fork_and_execve, $file_action) ==> (
      string $path,
      vec<string> $argv,
      vec<string> $envp,
      dict<int, FileDescriptor> $fds,
      _OS\ForkAndExecveOptions $options,
    ) ==> {
      if ($file_action is posix_spawn_file_actions_addchdir_np) {
        $cwd = $options['cwd'] ?? null;
        $new_cwd =
          $cwd is null ? $file_action->path : $cwd.'/'.$file_action->path;
        $canonicalized_new_cwd = \realpath($new_cwd);
        if ($canonicalized_new_cwd === false) {
          throw new IsNotADirectoryException($new_cwd.' is not a directory');
        } else {
          $canonicalized_new_cwd as string;
          if (\is_dir($canonicalized_new_cwd)) {
            $options['cwd'] = $canonicalized_new_cwd;
          } else {
            throw new IsNotADirectoryException(
              $canonicalized_new_cwd.' is not a directory',
            );
          }
        }
        return $fork_and_execve($path, $argv, $envp, $fds, $options);
      } else if ($file_action is posix_spawn_file_actions_adddup2) {
        $fds[$file_action->newfiledes] = $file_action->filedes;
        return $fork_and_execve($path, $argv, $envp, $fds, $options);
      } else if ($file_action is posix_spawn_file_actions_addopen) {
        $cwd = $options['cwd'] ?? null;
        $fd = open(
          $cwd is null ? $file_action->path : $cwd.'/'.$file_action->path,
          $file_action->oflag,
          $file_action->mode,
        );
        try {
          $fds[$file_action->filedes] = $fd;
          return $fork_and_execve($path, $argv, $envp, $fds, $options);
        } finally {
          close($fd);
        }
      } else {
        throw new \Exception("Not Implemented");
      }
    },
    $default_fork_and_execve,
  );
  $options = shape(
    'execvpe' => true,
    'setsid' =>
      ($attributes['posix_spawnattr_setflags'] & POSIX_SPAWN_SETSID) !== 0,
  );
  if (($attributes['posix_spawnattr_setflags'] & POSIX_SPAWN_SETPGROUP) !== 0) {
    $options['setpgid'] = $attributes['posix_spawnattr_setpgroup'];
  }
  return $fork_and_execve($file, $argv, $envp, dict[], $options);
}
