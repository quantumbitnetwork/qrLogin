<?php
/**
 * Created by PhpStorm.
 * User: nino
 * Date: 08-Jan-16
 * Time: 3:25 PM
 */

namespace Rayac\qrlogin\controllers;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rayac\qrlogin\user;
use Rayac\qrlogin\Database;

use Twig_Environment;
use Twig_Loader_Filesystem;


class loginController
{
    public function action (ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $pdo = Database::getPDO();
        $user = new user($pdo);

        $user->login($args["username"]);

        header("Location: /");

        return $response;
    }

    public function logout (ServerRequestInterface $request, ResponseInterface $response)
    {
        $pdo = Database::getPDO();
        $user = new user($pdo);

        $user->logout();

        session_destroy();

        header("Location: /");

        return $response;
    }

}