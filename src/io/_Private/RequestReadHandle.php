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

use namespace HH\Lib\{IO, OS};

final class RequestReadHandle implements IO\ReadHandle {
  use IO\ReadHandleConvenienceMethodsTrait;

  public function read(?int $max_bytes = null): string {
    invariant(
      $max_bytes === null || $max_bytes > 0,
      '$max_bytes must be null or positive',
    );
    return namespace\request_read($max_bytes ?? DEFAULT_READ_BUFFER_SIZE);
  }

  public async function readAsync(
    ?int $max_bytes = null,
    ?int $timeout_ns = null,
  ): Awaitable<string> {
    return $this->read($max_bytes);
  }
}
