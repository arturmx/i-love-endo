<?php

namespace Classes\Admin;

class AdminPages
{

    /**
     * Views directory
     * 
     * @var string
     */
    private $views;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->views = __DIR__ . '/views/';
    }

    /**
     * Forms data: main page
     */
    public function formDataMain ()
    {
        require $this->views . 'forms_data_main.php';
    }
}