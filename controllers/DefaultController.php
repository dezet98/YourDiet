<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//User.php';
require_once __DIR__.'//..//Repository//UserRepository.php';


class DefaultController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function start()
    {
        return $this->render('start');
    }

}

