<?php

require_once __DIR__.('/store_model.php');
require_once __DIR__.('/article_form_model.php');

class Article_model{
    public int $id;
    public string $title;
    public string $description;
    public int $price;
    public int $stock;
    public string $creation_date;
    public string $last_update_date;
    public bool $enabled;
    public int $article_form_id;
    public int $category_id;
    public int $store_id;
    public ?int $past_price;

    public ?string $category_title;
    public ?string $from_creation_date;
    public ?string $form_last_update_date;
    public ?string $recycled_mats;
    public ?string $recycled_mats_detail;
    public ?string $general_detail;
    public ?string $reuse_tips;
    public ?string $recycled_prod;
    public ?string $recycled_prod_detail;

    public ?string $public_name;
    public ?string $location;
    public ?string $photo_url;

    public ?Store_model $store;
    public ?Article_form_model $form;
    public ?Category_model $category;

    public ?int $district_id;
    public ?string $district_name;
    public ?array $opinions;
}