<?php


namespace App\Controller;


use App\Models\View;

class BaseController
{
    protected $view;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }
}