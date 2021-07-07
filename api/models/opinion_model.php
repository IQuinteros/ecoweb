<?php
class Opinion_model{
    public int $id;
    public int $rating;
    public string $title;
    public string $content;
    public string $creation_date;
    public int $article_id;
    public int $profile_id;

    public ?string $profile_name;
}