<?php
 namespace Rayac\qrlogin;

 /**
 * Created by PhpStorm.
 * User: dioro
 * Date: 31/08/2017
 * Time: 17:16
 */
class cookieGenerator
{
    private $something;

    public function createCookie($text){

        $this->something = $text;
    }

    public function getFunction(){

        return $this->something;
    }

}