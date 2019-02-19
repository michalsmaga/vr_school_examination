<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 06.02.19
 * Time: 13:12
 */

require_once 'Controller.php';

class Router {

    protected static $endpointMap = [
        'store' => [
            'POST' => 'Controller.store'
        ],
        'retrieve' => [
            'GET' => 'Controller.retrieve'
        ]
    ];

    public static function dispatch(Request $request) {

        try {

            $endpoint = self::getEndPoint($request);
            $response = self::execute($endpoint, $request);

            echo json_encode($response);
        } catch (Exception $e) {

            http_response_code(404);
            echo $e->getMessage();
        }
    }

    protected static function getEndPoint(Request $request) {

        if (!isset(self::$endpointMap[$request->getURI()]) || !isset(self::$endpointMap[$request->getURI()][$request->getHTTPMethod()])) {

            throw new Exception('Missing endpoint.');
        }

        $endpoint = self::$endpointMap[$request->getURI()][$request->getHTTPMethod()];
        return explode('.', $endpoint);
    }

    protected static function execute(array $endPoint, Request $request) {

        $reflectionMethod = new \ReflectionMethod($endPoint[0], $endPoint[1]);
        return $reflectionMethod->invokeArgs(new $endPoint[0](), array($request));
    }
} 