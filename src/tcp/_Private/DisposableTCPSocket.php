<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace HH\Lib\Experimental\TCP\_Private;

use namespace HH\Lib\Experimental\{IO, TCP};

final class DisposableTCPSocket
  extends IO\_Private\DisposableHandleWrapper<TCP\NonDisposableSocket>
  implements
    \IAsyncDisposable,
    IO\DisposableReadWriteHandle,
    TCP\DisposableSocket {

  use IO\_Private\DisposableReadHandleWrapperTrait<TCP\NonDisposableSocket>;
  use IO\_Private\DisposableWriteHandleWrapperTrait<TCP\NonDisposableSocket>;

  public function __construct(TCP\NonDisposableSocket $impl) {
    parent::__construct($impl);
  }
}
