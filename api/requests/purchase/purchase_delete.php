<?php
require_once('../base_request.php');
require_once('../../query/purchase.php');

$purchase = new Purchase();

$result=$purchase->delete_purchase($data->id);


send_response(isset($result), $result); 