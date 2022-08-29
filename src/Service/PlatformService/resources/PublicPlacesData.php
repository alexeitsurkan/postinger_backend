<?php

namespace App\Service\PlatformService\resources;

class PublicPlacesData
{
    private int $id;
    private string $name;
    private string $photo;

    public function getId(){
        return $this->id;
    }
    public function setId($val){
        $this->id = $val;
        return $this;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($val){
        $this->name = $val;
        return $this;
    }

    public function getPhoto(){
        return $this->photo;
    }
    public function setPhoto($val){
        $this->photo = $val;
        return $this;
    }
}