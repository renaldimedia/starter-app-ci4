<?php

namespace App\Controllers;

class Admins extends BaseAdminController
{
    public function index()
    {
        // $data['theme_path'] = $this->baseadminthemepath;
        return view('admin-module/dashboard', $this->data);
    }
}
