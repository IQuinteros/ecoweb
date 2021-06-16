<?php
require_once('../base_request.php');
require_once('../../query/opinion.php');

$opinion = new Opinion();

$result=$opinion->delete_opinion($data->id);


send_response(isset($result), $result); 