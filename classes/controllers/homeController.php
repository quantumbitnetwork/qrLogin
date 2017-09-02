<?php
/**
 * Created by PhpStorm.
 * User: nino
 * Date: 08-Jan-16
 * Time: 3:25 PM
 */

namespace Rayac\qrlogin\controllers;
/*
use Psecio\Gatekeeper\Gatekeeper;
use Rayac\skola\Database;
use Rayac\skola\post;
use Rayac\skola\user;
use Twig_Environment;
use Twig_Loader_Filesystem;
*/

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;



class homeController
{
    public function action (ServerRequestInterface $request, ResponseInterface $response)
    {
        $loader = new \Twig_Loader_Filesystem('../views/twig');
        $twig = new \Twig_Environment($loader, array('cache' => false));

        $response->getBody()->write($twig->render("home.twig"));
        return $response;
    }

    public function notFound (ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write('<p>hi</p>');
        return $response;
    }

}