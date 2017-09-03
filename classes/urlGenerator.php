<?php
/**
 * Created by PhpStorm.
 * User: dioro
 * Date: 03/09/2017
 * Time: 13:40
 */

namespace Rayac\qrlogin;


class urlGenerator
{
    private $pdo;
    private $url;


    public function __construct($pdoinput)
    {
        $this->pdo = $pdoinput;
    }

    public function setURL()
    {

    }

    public function getURL($session)
    {
        $stmt = $this->pdo->prepare("SELECT url FROM testing WHERE id = :id");
        $stmt->execute(['id' => $session]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
}