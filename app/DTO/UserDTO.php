<?php

namespace App\DTO;
class UserDTO
{
    public $id;
    public $nickname;
    public $name;
    public $email;

    public function __construct($id, $nickname, $name, $email)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->name = $name;
        $this->email = $email;
    }
}