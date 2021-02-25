<?php


namespace App\Exceptions;


class UnprocessableEntityException extends HttpExceptions
{

    protected int $statusCode = 422;

}