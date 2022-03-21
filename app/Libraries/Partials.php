<?php

namespace App\Libraries;


class Partials
{
    protected $db;
  
    public function __construct(){
    	
       $this->db = db_connect();
    } 
  
    public function mainsidebar(){
        $data['title'] = "Reapp Admin";
        $data['user_name'] = "Ardi Renaldi";
        return view('admin-module/partials/sidebar-main', $data);
    }
}
