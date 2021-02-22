<?php
require '/opt/user-api/vendor/autoload.php';

use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;

Router::get('/', function (Request $req, Response $res) {
    $res->status(404);
});


Router::get('/user/([0-9])', function (Request $req, Response $res) {
    $res->toJSON([
        'post' =>  ['id' => $req->params[0]],
        'status' => 'ok'
    ]);
});

App::run();