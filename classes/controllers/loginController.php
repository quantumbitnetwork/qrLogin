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



class loginController
{
    public function action (ServerRequestInterface $request, ResponseInterface $response)
    {
        $loader = new \Twig_Loader_Filesystem('../views/twig');
        $twig = new \Twig_Environment($loader, array('cache' => false));

        $response->getBody()->write($twig->render("login.twig"));
        return $response;
    }

}