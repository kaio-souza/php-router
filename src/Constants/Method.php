<?php


namespace KaioSouza\PhpRouter\Constants;


class Method
{
    //usual
    const POST = 'POST';
    const GET = 'GET';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';
    const PUT = 'PUT';

    //unusual
    const OPTIONS = 'OPTIONS';
    const HEAD = 'HEAD';
    const CONNECT = 'CONNECT';
    const TRACE = 'TRACE';
    const LOCK = 'LOCK';
    const UNLOCK = 'UNLOCK';
    const LINK = 'LINK';
    const UNLINK = 'UNLOCK';
    const PURGE = 'PURGE';
    const COPY = 'COPY';
    const VIEW = 'VIEW';
    const PROPFIND = 'PROPFIND';

}