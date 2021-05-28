<?php

require_once 'Services/Route.php';

use Services\Route;

(new Route($_SERVER['REQUEST_URI']))->routing();
