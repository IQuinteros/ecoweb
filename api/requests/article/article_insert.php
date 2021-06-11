<?php
require_once('../base_request.php');
require_once('../../query/article.php');

$article = new Article();
$result=$article->insert_article($data);

send_response($result, null);   