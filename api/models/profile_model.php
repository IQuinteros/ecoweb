<?php
class Profile{
    public $name;
    public $last_name;
    public $email;
    public $contact_number;
    public $birthday;
    public $terms;
    public $location;
    public $rut;
    public $rut_cd;
    public $creation_date;
    public $last_update_date;
    public $district_id;
    public $user_id;
    public function from_array(){
        $this->name=$data['name'];
        $this->last_name=$data['last_name'];
        $this->email=$data['email'];
        $this->contact_number=$data['contact_number'];
        $this->birthday=$data['birthday'];
        $this->terms=$data['terms_checked'];
        $this->location=$data['location'];
        $this->rut=$data['rut'];
        $this->rut_cd=$data['rut_cd'];
        $this->creation_date=$data['creation_date'];
        $this->last_update_date=$data['last_update_date'];
        $this->district_id=$data['district_id'];
        $this->user_id=$data['user_id'];
    }
    public function encode(){
        
    }
}