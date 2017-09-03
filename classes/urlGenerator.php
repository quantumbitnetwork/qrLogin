<?php
/**
 * Created by PhpStorm.
 * User: dioro
 * Date: 03/09/2017
 * Time: 13:40
 */

namespace Rayac\qrlogin;


use PDO;

class urlGenerator
{
    private $pdo;
    private $url;


    public function __construct($pdoinput)
    {
        $this->pdo = $pdoinput;
    }

    private function isSessionUsed()
    {
        $stmt = $this->pdo->prepare("SELECT phpSession FROM testing WHERE phpSession = :phpSession");
        $stmt->execute(['phpSession' => session_id()]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result["phpSession"] == null){
            return false;
        }

        return true;
    }

    public function createURL()
    {
        if(!$this->isSessionUsed()) {
            $randomUrl = md5(time());

            $stmt = $this->pdo->prepare("INSERT INTO testing SET url = :url , phpSession = :phpSession");
            $stmt->execute([
                'url' => $randomUrl,
                'phpSession' => session_id()
            ]);
        }
    }

    public function setURL()
    {

    }


    public function getURL()
    {
        $stmt = $this->pdo->prepare("SELECT url FROM testing WHERE phpSession = :phpSession");
        $stmt->execute(['phpSession' => session_id()]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}