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
use Rayac\qrlogin\Database;
use Rayac\qrlogin\urlGenerator;
use Symfony\Component\VarDumper\Cloner\Data;
use Twig_Environment;
use Twig_Loader_Filesystem;


class homeController
{
    public function action (ServerRequestInterface $request, ResponseInterface $response)
    {
        $loader = new Twig_Loader_Filesystem('../views/twig');
        $twig = new Twig_Environment($loader, array('cache' => false));

        $pdo = Database::getPDO();
        $url = new urlGenerator($pdo);

        $url->createURL();

        $response->getBody()->write($twig->render("home.twig", ["sessionID" => session_id(), "url" => $url->getURL()["url"]]));
        return $response;
    }

}