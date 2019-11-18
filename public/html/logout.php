<?php

require_once("../../private/initialise.php") ;

session_destroy();
redirect_to('/public/html/index.php');
