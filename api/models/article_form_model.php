<?php
class Article_form_model{
    public int $id;
    public string $creation_date;
    public string $last_update_date;
    public string $recycled_mats;
    public ?string $recycled_mats_detail;
    public ?string $general_detail;
    public ?string $reuse_tips;
    public string $recycled_prod;
    public ?string $recycled_prod_detail;
}