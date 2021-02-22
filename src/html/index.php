<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;

Router::get('/', function (Request $req, Response $res) {
    $res->status(404);
    $res->toJSON([
        "message" => "not found"
    ]);
});


Router::get('/user/[0-9]', function (Request $req, Response $res) {
    $res->status(200);
    $res->toJSON([
        'post' =>  ['id' => "00000"],
        'status' => 'ok'
    ]);
});

Router::post('/user', function (Request $req, Response $res) {
    $res->status(200);
    $res->toJSON([
        'post' =>  [$req],
        'status' => 'ok'
    ]);
});


Router::put('/user/[0-9]', function (Request $req, Response $res) {
    $res->status(200);
    $res->toJSON([
        'post' =>  ['id' => "00000"],
        'status' => 'ok'
    ]);
});

Router::delete('/user/[0-9]', function (Request $req, Response $res) {
    $res->status(200);
    $res->toJSON([
        'post' =>  ['id' => "00000"],
        'status' => 'ok'
    ]);
});