<?php
require_once __DIR__.('/store_model.php');
require_once __DIR__.('/purchase_model.php');

class Chat_model{
    public int $id;
    public string $creation_date;
    public int $closed;
    public string $last_seen_date;
    public int $store_id;

    public ?Store_model $store;
    public Purchase_model $purchase;

    public ?array $messages;
    public int $purchase_id;

}