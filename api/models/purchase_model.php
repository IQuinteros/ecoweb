<?php

require_once __DIR__.('/info_purchase_model.php');

class Purchase_model{
    public int $id;
    public int $total;
    public string $creation_date;
    public int $profile_id;
    public int $info_purchase_id;
    public ?int $chat_id;

    public ?Chat_model $chat;
    public ?Info_purchase_model $info_purchase;

    public ?array $articles;
}