<?php
class Profiles{
    public int $id;
    public string $name;
    public string $last_name;
    public string $email;
    public int $contact_number;
    public string $birthday;
    public bool $terms_checked;
    public string $location;
    public int $rut;
    public string $rut_cd;
    public string $creation_date;
    public string $last_update_date;
    public ?int $district_id;
    public int $user_id;
    
    public ?int $contador;
}