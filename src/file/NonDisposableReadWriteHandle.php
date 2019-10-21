<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the MIT license found in the
 *  LICENSE file in the root directory of this source tree.
 *
 */

namespace HH\Lib\Experimental\File;

use namespace HH\Lib\Experimental\IO;

final class NonDisposableReadWriteHandle
  extends _Private\NonDisposableFileHandle
  implements ReadWriteHandle, IO\NonDisposableReadWriteHandle {
  use IO\_Private\LegacyPHPResourceReadHandleTrait;
  use IO\_Private\LegacyPHPResourceWriteHandleTrait;
}
