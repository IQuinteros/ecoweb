<?php
require_once('../base_request.php');
require_once('../../query/article_form.php');

$article_f = new Article_form();
$result=$article_f->delete_article_form($data->id);

send_response(isset($result), $result); 