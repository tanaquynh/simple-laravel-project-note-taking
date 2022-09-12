<?php

namespace App\Services;

class AuthService
{
    public function checkPassword($inputPass, $dbPass) {
        if (crypt($inputPass, $dbPass) == $dbPass) {
            return true;
        }

        $salt = preg_replace("/^([^\.]+)\..+$/", '$1', $dbPass);
        if (crypt($inputPass, $salt) == $dbPass) {
            return true;
        }

        return false;  
    }

}