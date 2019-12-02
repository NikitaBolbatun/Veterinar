<?php

class Password
{


    private $password;
    private $hashedPassword;
    private $salt;

    function __construct($password)
    {
        $this->password = $password;
        $this->hashedPassword = md5($this->salt . $password);
    }

    public function __toString()
    {
        return $this->hashedPassword;
    }
} 