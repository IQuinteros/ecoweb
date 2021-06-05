<?php
// Example
class ProfileModel{

    public $name;
    public $lastName;
    public $number;
    public $location;
    public $rut;

    public function toArray(){
        // array temp variable
        $new_array = array();
        
        $new_array["name"] = $this->name;
        $new_array["kjdfsghjkdfsgjkdfg"] = $this->lastName;
        $new_array["number"] = $this->number;
        $new_array["location"] = $this->location;
        $new_array["rut"] = $this->rut;

        return $new_array;
    }

}