<?php
class Article_purchase_model{
    public int $id;
    public int $purchase_id;
    public ?int $article_id;
    public string $title;
    public int $unit_price;
    public int $quantity;
    public ?string $photo_url;
    public string $recycled_mats;
    public ?string $recycled_mats_detail;
    public ?string $reuse_tips;
    public string $recycled_prod;
    public ?string $recycled_prod_detail;
    public string $general_detail;
    public ?int $store_id;

    public ?Article_model $article;
    public ?Store_model $store;

}