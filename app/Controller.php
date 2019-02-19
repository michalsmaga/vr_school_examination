<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 06.02.19
 * Time: 14:35
 */

require_once 'Movie1Row.php';
require_once 'Movie2Row.php';

class Controller {

    public function store(Request $request) {

        $model = $this->pickModel($request);
        $model = new $model($request->getPOST());
        $model->preserve();

        return true;
    }

    public function retrieve(Request $request) {

        $model = new DefaultRow($request->getGET());
        return $model->retrieve();
    }

    protected function pickModel(Request $request) {

        $post = $request->getPOST();
        if (!empty($post)) {

            $post = $request->getPOST();
            if (isset($post['chose_to_continue_with']) || isset($post['tough_that_chen_should'])) {

                return 'Movie1Row';
            } else if (isset($post['what_id_daniel_going_through']) || isset($post['did_the_friends_help_daniel'])) {

                return 'Movie2Row';
            } else {

                return 'Movie1Row';
            }
        }
    }
} 