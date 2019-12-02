<?php

class InfoForm
{
    private $Fullname;
    private $happy;
    private $address;
    private $phone;
    private $Pet;
    private $happyPet;
    private $TypePet;
    private $Opisanie; 
    private $Bolez;

    function __construct(Array $data)
    {
        $this->Fullname = isset($data['Fullname']) ? $data['Fullname'] : null;
        $this->happy = isset($data['happy']) ? $data['happy'] : null;
        $this->address = isset($data['address']) ? $data['address'] : null;
        $this->phone = isset($data['phone']) ? $data['phone'] : null;
        $this->discount = isset($data['discount']) ? $data['discount'] : null;
        $this->Pet = isset($data['Pet']) ? $data['Pet'] : null;
        $this->happyPet = isset($data['happyPet']) ? $data['happyPet'] : null;
        $this->TypePet = isset($data['TypePet']) ? $data['TypePet'] : null;
        $this->Opisanie = isset($data['Opisanie']) ? $data['Opisanie'] : null;
        $this->Bolez = isset($data['Bolez']) ? $data['Bolez'] : null;



    }
    //Сделать нормальную валидацию данных
    public function validate() 
    {
        return !empty($this->Fullname) || !empty($this->happy) || !empty($this->Opisanie) || !empty($this->address) || !empty($this->phone) || !empty($this->discount) || !empty($this->Pet)|| !empty($this->Bolez);
    }

    public function getFullname()
    {
        return $this->Fullname;
    }

    public function setFullname($Fullname)
    {
        $this->Fullname = $Fullname;
    }

    public function gethappy()
    {
        return $this->happy;
    }

    public function sethappy($happy)
    {
        $this->happy = $happy;
    }

    public function getaddress()
    {
        return $this->address;
    }

    public function setaddress($address)
    {
        $this->address = $address;
    }

    public function getphone()
    {
        return $this->phone;
    }

    public function setphone($phone)
    {
        $this->phone = $phone;
    }
    public function getPet()
    {
        return $this->Pet;
    }

    public function setPet($Pet)
    {
        $this->Pet = $Pet;
    }

    public function gethappyPet()
    {
        return $this->happyPet;
    }

    public function sethappyPet($happyPet)
    {
        $this->happyPet = $happyPet;
    }

    public function getTypePet()
    {
        return $this->TypePet;
    }

    public function setTypePet($TypePet)
    {
        $this->TypePet = $TypePet;
    }

    public function getOpisanie()
    {
        return $this->Opisanie;
    }

    public function setOpisanie($Opisanie)
    {
        $this->TypePet = $TypePet;
    }

    public function getBolez()
    {
        return $this->Bolez;
    }

    public function setBolez($Bolez)
    {
        $this->Bolez = $Bolez;
    }



} 