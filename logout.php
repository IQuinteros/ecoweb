<?php
require_once __DIR__.('/php/utils/auth_util.php');

AuthUtil::logout();

header('Location:index.html');