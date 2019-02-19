<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 07.02.19
 * Time: 10:05
 */

require_once 'DefaultRow.php';

class Movie2Row extends DefaultRow{

    protected $table = 'movie2';

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
        'what_id_daniel_going_through' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ],
        'did_the_friends_help_daniel' => [
            'required'  => true,
            'length'    => 1000,
            'type'      => 'string'
        ]
    ];
} 