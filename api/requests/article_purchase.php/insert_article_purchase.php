<?php
require_once('../base_request.php');
require_once('../../query/article_purchase.php');

$a_purchase = new Article_purchase();

$result=$a_purchase->insert_article_purchase($data);


send_response(isset($result), $result); 