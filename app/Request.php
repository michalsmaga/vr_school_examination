<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 06.02.19
 * Time: 13:36
 */

class Request {

    protected $httpMethod = 'GET';

    protected $uri = null;

    protected $get = [];

    protected $post = [];

    public function __construct() {

        $this->setHTTPMethod();

        $this->setURI();

        $this->setPOST();
    }

    protected function setHTTPMethod() {

        if (isset($_SERVER['REQUEST_METHOD'])) {

            $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        } else {

            throw new Exception('Request method not provided.');
        }
    }

    protected function setURI() {

        if (isset($_SERVER['REQUEST_URI'])) {

            $get = parse_url($_SERVER['REQUEST_URI']);
            $this->uri = trim($get['path'], '/');

            if (isset($get['query'])) {

                parse_str($get['query'], $this->get);
            }
        } else {

            throw new Exception('URI not exist.');
        }
    }

    protected function setPOST() {

        if (!empty($_POST)) {

            $this->post = $_POST;
        }
    }

    public function getHTTPMethod() {

        return $this->httpMethod;
    }

    public function getURI() {

        return $this->uri;
    }

    public function getPOST() {

        return $this->post;
    }

    public function getGET() {

        return $this->get;
    }
} 