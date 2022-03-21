<?php

namespace App\Controllers;

class Home extends BaseAdminController
{
    public function index()
    {
        return view('welcome_message');
    }
}
