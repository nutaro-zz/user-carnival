<?php


namespace App\Controller;


use App\Lib\Request;
use App\Lib\Response;
use App\DataBase\Connection;
use App\Service\UserService;


class UserController
{


    public static function getAll(Request $request, Response $response): Response
    {
        $connection = Connection::getInstance();
        $data = $connection->query("SELECT * from users");
        $response->status(200);
        $response->toJSON($data->fetchAll());
        return $response;
    }

    public static function get(Request $request, Response $response): Response
    {

        $connection = Connection::getInstance();
        $data = $connection->query("SELECT * from users");
        $response->status(200);
        $response->toJSON($data->fetchAll());
        return $response;
    }

    public static function post(Request $request, Response $response): Response
    {
        $fields = ["name", "address", "city", "state"];
        $content = $request->getJSON();
        foreach ($fields as $field){
            if (!isset($content[$field])) {
                $response->status(422);
                $response->toJSON(array("Mandatory" => $fields));
                return $response;
            }
        }
        $service = new UserService();
        $service->create($content);
        $response->status(201);
        $response->toJSON();
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