<?php
/**
 * Created by PhpStorm.
 * User: dioro
 * Date: 24/09/2017
 * Time: 16:11
 */

namespace Rayac\qrlogin;


use PDO;

class user
{
    private $pdo;

    public function __construct($pdoinput)
    {
        $this->pdo = $pdoinput;
    }

    public function isLoggedIn()
    {
        if ($this->getOwner() == null){
            return false;
        }

        return true;
    }

    public function getOwner()
    {
        $stmt = $this->pdo->prepare("SELECT owner FROM testing WHERE phpSession = :phpSession");
        $stmt->execute(['phpSession' => session_id()]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["owner"];
    }

    public function login($username)
    {
        if(isset($username) && !$this->isLoggedIn()) {
            $stmt = $this->pdo->prepare("UPDATE testing SET owner = :username WHERE phpSession = :phpSession");
            $stmt->execute([
                'username' => $username,
                'phpSession' => session_id()
            ]);
        }
    }

    public function logout()
    {
        $stmt = $this->pdo->prepare("DELETE FROM testing WHERE phpSession = :phpSession");
        $stmt->execute([
            'phpSession' => session_id()
        ]);
    }
}