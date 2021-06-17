<?php
require_once('../base_request.php');
require_once('../../query/info_purchase.php');

$info = new Info_purchase();

$result=$info->delete_info_purchase($data->id);


send_response(isset($result), $result); 