<?php

require_once 'vendor\autoload.php';

use App\Services\Route;

Route::create($_SERVER['REQUEST_URI'])->routing();
