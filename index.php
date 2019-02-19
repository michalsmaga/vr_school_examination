<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 06.02.19
 * Time: 13:10
 */

ini_set('display_errors', 'On');

require_once 'app/Request.php';
require_once 'app/Router.php';

$request = new Request();
Router::dispatch($request);