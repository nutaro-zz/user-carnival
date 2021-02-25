<?php


namespace App\Exceptions;


class ResourceAlreadyExistsException extends HttpExceptions
{

    protected int $statusCode = 409;
    protected $message = [];

}