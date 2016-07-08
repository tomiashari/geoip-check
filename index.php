<?php

require('lib/geocheck.php');

$geocheck = new geoip();
echo 'Hello! You\'re visit from ' .$geocheck->detail();