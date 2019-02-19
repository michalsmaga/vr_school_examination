<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 07.02.19
 * Time: 10:05
 */

require_once 'DefaultRow.php';

class Movie1Row extends DefaultRow{

    protected $table = 'movie1';

    protected $data = [];

    protected $validations = [
        'country' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'school' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'class' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'moderator_name' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'date' => [
            'required'  => true,
            'length'    => 10,
            'type'      => 'string'
        ],
        'gender' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'chose_to_continue_with' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'tough_that_chen_should' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ]
    ];
} 