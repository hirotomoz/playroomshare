<?php

require("../conf/config.php");
require '../bootstrap.php';
require '../PlayRoomShare.php';

$app = new PlayRoomShare(true);
$app->run();
