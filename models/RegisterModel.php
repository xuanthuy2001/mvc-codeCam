<?php


namespace app\models;

use app\models\Model;;


class RegisterModel extends Model
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public string $confirm_password;

    public function register()
    {
        echo "creating user";
    }
}