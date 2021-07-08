<?php
class Store_model{
    public int $id;
    public string $public_name;
    public string $description;
    public string $email;
    public int $contact_number;
    public string $location;
    public string $passwords;
    public int $rut;
    public int $rut_cd;
    public int $enabled;
    public string $creation_date;
    public string $last_update_date;
    public int $district_id;
    public ?string $district_name;
    public ?string $photo_url;

    public ?array $opinions;
    
}