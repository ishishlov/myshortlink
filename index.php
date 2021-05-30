<?php

require_once 'Services/Route.php';

use Services\Route;

Route::create($_SERVER['REQUEST_URI'])->routing();
