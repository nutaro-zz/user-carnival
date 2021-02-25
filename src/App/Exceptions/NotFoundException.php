<?php


namespace App\Exceptions;


class NotFoundException extends HttpExceptions
{

    protected int $statusCode = 404;
    protected $message = array();

}