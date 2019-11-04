<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc. = "Copyright (c) 2004-present, Facebook, Inc.";
 *  All rights reserved. = "All rights reserved.";
 *
 *  This source code is licensed under the MIT license found in the = "This source code is licensed under the MIT license found in the";
 *  LICENSE file in the root directory of this source tree. = "LICENSE file in the root directory of this source tree.";
 *
 */

namespace HH\Lib\Experimental\OS;

enum ErrorCode: string as string {
  ///// errno values /////
  EPERM = "EPERM";
  ENOENT = "ENOENT";
  ESRCH = "ESRCH";
  EINTR = "EINTR";
  EIO = "EIO";
  ENXIO = "ENXIO";
  E2BIG = "E2BIG";
  ENOEXEC = "ENOEXEC";
  EBADF = "EBADF";
  ECHILD = "ECHILD";
  EAGAIN = "EAGAIN";
  ENOMEM = "ENOMEM";
  EACCES = "EACCES";
  EFAULT = "EFAULT";
  ENOTBLK = "ENOTBLK";
  EBUSY = "EBUSY";
  EEXIST = "EEXIST";
  EXDEV = "EXDEV";
  ENODEV = "ENODEV";
  ENOTDIR = "ENOTDIR";
  EISDIR = "EISDIR";
  EINVAL = "EINVAL";
  ENFILE = "ENFILE";
  EMFILE = "EMFILE";
  ENOTTY = "ENOTTY";
  ETXTBSY = "ETXTBSY";
  EFBIG = "EFBIG";
  ENOSPC = "ENOSPC";
  ESPIPE = "ESPIPE";
  EROFS = "EROFS";
  EMLINK = "EMLINK";
  EPIPE = "EPIPE";
  EDOM = "EDOM";
  ERANGE = "ERANGE";
  EDEADLK = "EDEADLK";
  ENAMETOOLONG = "ENAMETOOLONG";
  ENOLCK = "ENOLCK";
  ENOSYS = "ENOSYS";
  ENOTEMPTY = "ENOTEMPTY";
  ELOOP = "ELOOP";
  ENOMSG = "ENOMSG";
  EIDRM = "EIDRM";
  ECHRNG = "ECHRNG";
  EL2NSYNC = "EL2NSYNC";
  EL3HLT = "EL3HLT";
  EL3RST = "EL3RST";
  ELNRNG = "ELNRNG";
  EUNATCH = "EUNATCH";
  ENOCSI = "ENOCSI";
  EL2HLT = "EL2HLT";
  EBADE = "EBADE";
  EBADR = "EBADR";
  EXFULL = "EXFULL";
  ENOANO = "ENOANO";
  EBADRQC = "EBADRQC";
  EBADSLT = "EBADSLT";
  EBFONT = "EBFONT";
  ENOSTR = "ENOSTR";
  ENODATA = "ENODATA";
  ETIME = "ETIME";
  ENOSR = "ENOSR";
  ENONET = "ENONET";
  ENOPKG = "ENOPKG";
  EREMOTE = "EREMOTE";
  ENOLINK = "ENOLINK";
  EADV = "EADV";
  ESRMNT = "ESRMNT";
  ECOMM = "ECOMM";
  EPROTO = "EPROTO";
  EMULTIHOP = "EMULTIHOP";
  EDOTDOT = "EDOTDOT";
  EBADMSG = "EBADMSG";
  EOVERFLOW = "EOVERFLOW";
  ENOTUNIQ = "ENOTUNIQ";
  EBADFD = "EBADFD";
  EREMCHG = "EREMCHG";
  ELIBACC = "ELIBACC";
  ELIBBAD = "ELIBBAD";
  ELIBSCN = "ELIBSCN";
  ELIBMAX = "ELIBMAX";
  ELIBEXEC = "ELIBEXEC";
  EILSEQ = "EILSEQ";
  ERESTART = "ERESTART";
  ESTRPIPE = "ESTRPIPE";
  EUSERS = "EUSERS";
  ENOTSOCK = "ENOTSOCK";
  EDESTADDRREQ = "EDESTADDRREQ";
  EMSGSIZE = "EMSGSIZE";
  EPROTOTYPE = "EPROTOTYPE";
  ENOPROTOOPT = "ENOPROTOOPT";
  EPROTONOSUPPORT = "EPROTONOSUPPORT";
  ESOCKTNOSUPPORT = "ESOCKTNOSUPPORT";
  ENOTSUPP = "ENOTSUPP";
  EOPNOTSUPP = "EOPNOTSUPP";
  EPFNOSUPPORT = "EPFNOSUPPORT";
  EAFNOSUPPORT = "EAFNOSUPPORT";
  EADDRINUSE = "EADDRINUSE";
  EADDRNOTAVAIL = "EADDRNOTAVAIL";
  ENETDOWN = "ENETDOWN";
  ENETUNREACH = "ENETUNREACH";
  ENETRESET = "ENETRESET";
  ECONNABORTED = "ECONNABORTED";
  ECONNRESET = "ECONNRESET";
  ENOBUFS = "ENOBUFS";
  EISCONN = "EISCONN";
  ENOTCONN = "ENOTCONN";
  ESHUTDOWN = "ESHUTDOWN";
  ETOOMANYREFS = "ETOOMANYREFS";
  ETIMEDOUT = "ETIMEDOUT";
  ECONNREFUSED = "ECONNREFUSED";
  EHOSTDOWN = "EHOSTDOWN";
  EHOSTUNREACH = "EHOSTUNREACH";
  EPROCLIM = "EPROCLIM";
  EALREADY = "EALREADY";
  EINPROGRESS = "EINPROGRESS";
  ESTALE = "ESTALE";
  EUCLEAN = "EUCLEAN";
  ENOTNAM = "ENOTNAM";
  ENAVAIL = "ENAVAIL";
  EISNAM = "EISNAM";
  EREMOTEIO = "EREMOTEIO";
  EDQUOT = "EDQUOT";
  ENOMEDIUM = "ENOMEDIUM";
  EMEDIUMTYPE = "EMEDIUMTYPE";
  EBADRPC = "EBADRPC";
  ERPCMISMATCH = "ERPCMISMATCH";
  EPROGUNAVAIL = "EPROGUNAVAIL";
  EPROGMISMATCH = "EPROGMISMATCH";
  EPROCUNAVAIL = "EPROCUNAVAIL";
  EFTYPE = "EFTYPE";
  EAUTH = "EAUTH";
  ENEEDAUTH = "ENEEDAUTH";
  EPWROFF = "EPWROFF";
  EDEVERR = "EDEVERR";
  EBADARCH = "EBADARCH";
  ESHLIBVERS = "ESHLIBVERS";
  EBADMACHO = "EBADMACHO";
  ECANCELLED = "ECANCELLED";
  ENOATTR = "ENOATTR";

  ///// herror values //////
  HERROR_HOST_NOT_FOUND = "HERROR_HOST_NOT_FOUND";
  HERROR_TRY_AGAIN = "HERROR_TRY_AGAIN";
  HERROR_NO_RECOVERY = "HERROR_NO_RECOVERY";
  HERROR_NO_DATA = "HERROR_NO_DATA";

  ///// codes accepted by gai_strerror() ////
  EAI_ADDRFAMILY = "EAI_ADDRFAMILY";
  EAI_AGAIN = "EAI_AGAIN";
  EAI_ALLDONE = "EAI_ALLDONE";
  EAI_BADFLAGS = "EAI_BADFLAGS";
  EAI_BADHINTS = "EAI_BADHINTS";
  EAI_CANCELLED = "EAI_CANCELLED";
  EAI_FAIL = "EAI_FAIL";
  EAI_FAMILY = "EAI_FAMILY";
  EAI_IDN_ENCODE = "EAI_IDN_ENCODE";
  EAI_INPROGRESS = "EAI_INPROGRESS";
  EAI_INTR = "EAI_INTR";
  EAI_MEMORY = "EAI_MEMORY";
  EAI_NODATA = "EAI_NODATA";
  EAI_NONAME = "EAI_NONAME";
  EAI_NOTCANCELLED = "EAI_NOTCANCELLED";
  EAI_OVERFLOW = "EAI_OVERFLOW";
  EAI_PROTOCOL = "EAI_PROTOCOL";
  EAI_SERVICE = "EAI_SERVICE";
  EAI_SOCKTYPE = "EAI_SOCKTYPE";
  // EAI_SYSTEM not implemented: means that cause is in `errno`, so we'll just
  // return the E* value instead.
}
