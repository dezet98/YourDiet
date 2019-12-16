<?php

class AppController
{
    private $request = null;

    function __construct()
    {
        $this->request = strtolower($SERVER['REQUEST METHOD']);
        echo "request = " . $request;
    }

    function isGet()
    {
        return $this->request === 'get';
    }

    function isPost()
    {
        return $this->request === 'set';
    }

    function render($variables = [], $fileName = null)
    {
        $templatePath = $fileName ? dirname('DIR') . '\views\\' . get_class($this) . '\\' . $fileName . '.php' : '';
        $output = 'File not found';

        if(file_exists($templatePath))
        {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    
    }
}


?>