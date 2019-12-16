<?php

require_once(AppController);

class DefaultController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->render([], 'index');
    }

    public function login()
    {
        return $this->render([], 'login');
    }
}

?>