<?php
require_once('../base_request.php');
require_once('../../query/opinion.php');

$opinion = new Opinion();

$result=$opinion->insert_opinion($data);


send_response(isset($result), $result); 