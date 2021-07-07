<?php
require_once __DIR__.('/answer_model.php');
class Question_model{
    public int $id;
    public string $question;
    public string $creation_date;
    public int $profile_id;
    public int $article_id;
    public ?Answer_model $answer;

    public ?string $profile_name;
    public ?string $article_name;
}