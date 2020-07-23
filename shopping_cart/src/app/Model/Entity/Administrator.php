<?php

class Administrator
{
    private $adminID;
    private $emailAddress;
    private $password;
    private $firstName;
    private $lastName;

    function __construct($administrator)
    {
        $this->adminID = $administrator['adminID'];
        $this->emailAddress = $administrator['emailAddress'];
        $this->password = $administrator['password'];
        $this->firstName = $administrator['firstName'];
        $this->lastName = $administrator['lastName'];
    }

    function getAdminID()
    {
        return $this->adminID;
    }
    function getEmailAddress()
    {
        return $this->emailAddress;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getFirstName()
    {
        return $this->firstName;
    }
    function getLastName()
    {
        return $this->lastName;
    }
}
