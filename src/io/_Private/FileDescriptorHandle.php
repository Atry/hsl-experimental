<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace HH\Lib\_Private\_IO;

use namespace HH\Lib\{IO, OS, Str};
use namespace HH\Lib\_Private\_OS;

abstract class FileDescriptorHandle implements IO\CloseableHandle {
  protected bool $isAwaitable = true;

  protected function __construct(protected OS\FileDescriptor $impl) {
    // Preserve existing flags, especially O_APPEND
    $flags = OS\fcntl($impl, OS\FcntlOp::F_GETFL) as int;
    OS\fcntl($impl, OS\FcntlOp::F_SETFL, $flags | OS\O_NONBLOCK);
  }

  private ?Awaitable<mixed> $lastOperation;
  final protected function queuedAsync<T>(
    (function(): Awaitable<T>) $next,
  ): Awaitable<T> {
    $last = $this->lastOperation;
    $queue = async {
      await $last;
      return await $next();
    };
    $this->lastOperation = $queue;
    return $queue;
  }


  final protected async function selectAsync(
    int $flags,
    int $timeout_ns,
  ): Awaitable<void> {
    if (!$this->isAwaitable) {
      return;
    }
    try {
      $result = await _OS\poll_async($this->impl, $flags, $timeout_ns);
      if ($result === \STREAM_AWAIT_CLOSED) {
        _OS\throw_errno(OS\Errno::EBADFD, "Can't await a closed FD");
      }

    } catch (_OS\ErrnoException $e) {
      if ($e->getCode() === OS\Errno::ENOTSUP) {
        // e.g. real files on Linux when using epoll
        $this->isAwaitable = false;
        return;
      }
      throw $e;
    }
  }

  final public async function closeAsync(): Awaitable<void> {
    if ($this is IO\WriteHandle) {
      await $this->flushAsync();
    }
    OS\close($this->impl);
  }
}
