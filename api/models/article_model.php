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

    public bool $favorite = false;

    public ?Store_model $store;
    public ?Article_form_model $form;
    public ?Category_model $category;

    public ?array $opinions;
    public ?array $photos;
    public ?array $questions;
}