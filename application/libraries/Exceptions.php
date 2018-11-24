<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exceptions
{
    public static function info($msg, $code = 404)
    {
        throw new InfoException($msg, $code);
    }

    public static function notice($msg, $code = 404)
    {
        throw new NoticeException($msg, $code);
    }

    public static function error($msg, $code = 404)
    {
        throw new ErrorException($msg, $code);
    }

    public static function capture(Exception $e)
    {
        if ($e instanceof ErrorException) {
            $record['code'] = $e->getCode();
            $record['msg']  = $e->getMessage();
            $record['file'] = $e->getFile();
            $record['line'] = $e->getLine();
        } elseif ($e instanceof RedisException) {
            $record['code'] = $e->getCode();
            $record['msg']  = $e->getMessage();
            $record['file'] = $e->getFile();
            $record['line'] = $e->getLine();
        } elseif ($e instanceof MysqlException) {
            $record['code'] = $e->getCode();
            $record['msg']  = $e->getMessage();
            $record['file'] = $e->getFile();
            $record['line'] = $e->getLine();
        }
    }
}

class RecordException extends Exception
{
}
class NoticeException extends Exception
{
}
class InfoException   extends Exception
{
}
