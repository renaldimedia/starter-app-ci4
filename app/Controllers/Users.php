<?php

namespace App\Controllers;

class Users extends BaseAdminController
{
    // protected $data;
    public function __construct()
    {
        // $this->data['theme_path'] = $this->baseadminthemepath;   
    }

    public function index()
    {
        return view('admin-module/users/lists', $this->data);
    }
    public function form()
    {
        $data_id = $this->request->getVar('data_id');
        
        $this->data['title'] = 'Data User';
        $this->data['buttons'] = array(
            'submit_text' => 'Simpan Data'
        );
        $this->data['data_id'] = 0;
        if($data_id != null){
            $this->data['subtitle'] = '<i class="icon icon-pencil"></i> Edit Data User';
            $this->data['buttons']['submit_text'] = 'Update Data';
            $this->data['data_id'] = $data_id;
        }
        return view('admin-module/users/form', $this->data);
    }

}
