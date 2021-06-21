<?php
require_once('../base_request.php');
require_once('../../query/article.php');

$article = new Article();
$result=$article->delete_article($data->id);

send_response($result, null);   