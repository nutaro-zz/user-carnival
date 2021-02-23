<?php


namespace App\Controller;


use App\Lib\Request;
use App\Lib\Response;

class UserController
{

    public static function get(Request $request, Response $response): Response
    {
        $response->status(200);
        $response->toJSON([
            "request" => $request->params[0],
            'status' => 'ok'
        ]);
        return $response;
    }

    public static function post(Request $request, Response $response): Response
    {
        $response->status(200);
        $response->toJSON([
            "request" => $request->params[0],
            'status' => 'ok'
        ]);
        return $response;
    }

    public static function put(Request $request, Response $response): Response
    {
        $response->status(200);
        $response->toJSON([
            "request" => $request->params[0],
            'status' => 'ok'
        ]);
        return $response;
    }

    public static function delete(Request $request, Response $response): Response
    {
        $response->status(200);
        $response->toJSON([
            "request" => $request->params[0],
            'status' => 'ok'
        ]);
        return $response;
    }

}