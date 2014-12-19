<?php

use moofyme\Database as DB;

require_once __DIR__ . '/vendor/autoload.php';

var_dump( DB::table('users') );
