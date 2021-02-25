<?php


namespace App\Controller;


use App\Exceptions\HttpExceptions;
use App\Exceptions\NotFoundException;
use App\Lib\Request;
use App\Lib\Response;
use App\DataBase\Connection;
use App\Repository\UserRepository;
use App\Service\UserService;

use PDO;


class UserController
{

    public static function getAll(Request $request, Response $response): Response
    {
        try {
            $userService = new UserService();
            $data = $userService->getAll();
            $response->status(200);
            $response->toJSON($data);
        }catch (HttpExceptions $ex) {
            $response->status($ex->getStatusCode());
            $response->toJSON($ex->getMessage());
        } catch (\Exception $ex) {
            $response->status(500);
            $response->toJSON($ex->getMessage());
        }
        return $response;
    }

    public static function get(Request $request, Response $response): Response
    {
        try {
            $id = $request->params[0];
            $userService =  new UserService();
            $response->status(200);
            $response->toJSON($userService->get($id));
        } catch (HttpExceptions $ex) {
            $response->status($ex->getStatusCode());
            $response->toJSON($ex->getMessage());
        } catch (\Exception $ex) {
            $response->status(500);
            $response->toJSON($ex->getMessage());
        }
        return $response;
    }

    public static function post(Request $request, Response $response): Response
    {
        try {
            $body = $request->getJSON();
            $service = new UserService();
            $service->validateFields($body, array("name", "address", "city", "state"));
            $service->create($body);
            $response->status(201);
            $response->toJSON();
        } catch (HttpExceptions $ex){
            $response->status($ex->getStatusCode());
            $response->toJSON($ex->getMessage());
        } catch (\Exception $ex) {
            $response->status(500);
            $response->toJSON($ex->getMessage());
        }
        return $response;

    }

    public static function put(Request $request, Response $response): Response
    {
        try {
            $id = $request->params[0];
            $userService = new UserService();
            $userService->update(array("id" => $id, "content" => $request->getJSON()));

        } catch (NotFoundException $e) {
            // pass
        }

        $fields = array("name", "address", "city", "state");
        $update = array();
        if (isset($body['city'])){

        }
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