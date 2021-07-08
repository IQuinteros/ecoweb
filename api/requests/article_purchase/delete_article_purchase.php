<?php
require_once('../base_request.php');
require_once('../../query/article_purchase.php');

$a_purchase = new Article_purchase();

$result=$a_purchase->delete_article_purchase($data->id);


send_response(isset($result), $result); 