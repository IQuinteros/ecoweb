<?php
require_once('../base_request.php');
require_once('../../query/purchase.php');

$purchase = new Purchase();

$result=$purchase->insert_purchase($data);


send_response(isset($result), $result); 