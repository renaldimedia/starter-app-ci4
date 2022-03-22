<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class Users extends BaseAdminController
{
    use ResponseTrait;
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
        $db = \Config\Database::connect();
        $data_id = $this->request->getVar('id');
        
        $this->data['title'] = 'Data User';
        $this->data['buttons'] = array(
            'submit_text' => 'Simpan Data'
        );
        $this->data['submit_url'] = base_url('admin/users/add');

        $this->data['groups'] = $db->table('m_auth_admin_groups')->get()->getResult();
        
        if($data_id != null){
            // goto models nanti ya!
            
            $this->data['data'] = $db->table('m_auth_admins')->where('id', $data_id)->get()->getRowArray();
            // ----------------
            $this->data['subtitle'] = '<i class="icon icon-pencil"></i> Edit Data User';
            $this->data['buttons']['submit_text'] = 'Update Data';
            $this->data['data_id'] = $data_id;
            $this->data['submit_url'] = base_url('admin/users/update');
        }
        return view('admin-module/users/form', $this->data);
    }

    public function save($extra = null)
    {
        if (!$this->validate([
            'name' => "required",
            'username' => "string|in_db[m_auth_admin_groups.id]",
            'email' => "required|valid_email",
            'password' => "string|min_length[8]",
            'confirm_password' => "string|matches[password]",
            'default_group' => "required",
            'phone' => "numeric",
            'data_id' => "numeric|".($extra == 'update' ? 'required' : '')
        ])) {
            // echo json_encode(['error' => 1, 'message' => $this->validator->getErrors()]);
            return $this->failValidationError($this->validator->getErrors());
            exit;
        }
        $password = $this->request->getVar('password');
        $res = ['id' => null, 'error' => 1, 'message' => 'Gagal menambahkan data!', 'detail' => []];
        try {
            $data_id = $this->request->getVar('data_id');
            $db = \Config\Database::connect();
            $builder = $db->table('m_auth_users');
            
            if($data_id == null){
                $password = $password == null ? '12345678' : $password;
                $password = password_hash($password, PASSWORD_BCRYPT);

                $x = $builder->insert(array(
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('phone'),
                    'active' => $this->request->getVar('active'),
                    'default_group' => $this->request->getVar('default_group'),
                    'password' => $password,
                ));
    
                if($x){
                    $res['id'] = $db->insertID();
                    $res['error'] = 0;
                    $res['message'] = 'Berhasil menambahkan data!'; 
                    return $this->respondCreated($res);
                }else{
                    $res['detail'] = $db->error()['message'];
                }
                return $this->fail($res);
            }else if($data_id != null){
                $set = array(
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('phone'),
                    'active' => $this->request->getVar('active'),
                    'default_group' => $this->request->getVar('default_group')
                );
                if($password != null){
                    $set['password'] = password_hash($password, PASSWORD_BCRYPT);
                }
                $x = $builder->where('id', $data_id)->update($set);
            }
        } catch (\Throwable $th) {
            $res['detail'] = $th;
            return $this->fail($res, 400);
        }
       
        return $this->fail($res, 400);
    }

}
