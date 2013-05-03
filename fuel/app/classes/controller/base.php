<?php

class Controller_Base extends Controller
{
    public function before()
    {
        parent::before();
    }
    
    public function after($response)
    {
        return parent::after($response);
    }
}
