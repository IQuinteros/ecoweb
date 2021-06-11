<?php
class Article_model{
    public int $id;
    public string $title;
    public string $description;
    public int $price;
    public int $stock;
    public string $creation_date;
    public string $last_update_date;
    public int $enabled;
    public int $article_form_id;
    public int $category_id;
    public int $store_id;
    public int $past_price;
}