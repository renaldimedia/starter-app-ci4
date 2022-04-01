<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

use \Hermawan\DataTables\DataTable;

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

    public function lists()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('m_auth_admins as adm')->select('adm.name, adm.email, adm.phone, adm.active, adm.default_group as role, adm.id');
       

        return DataTable::of($builder)
            ->setSearchableColumns(['adm.name', 'adm.email', 'adm.phone'])
            // ->filter(function ($q, $request) {

            //     if (property_exists($request, 'korda') && $request->korda)
            //         $q->where('p.korda_id', $request->korda);

            //     if (property_exists($request, 'korwil') && $request->korwil)
            //         $q->where('p.korwil_id', $request->korwil);
            // })
            ->addNumbering() //it will return data output with numbering on first column
            ->toJson();
    }
    public function form($data_id = null)
    {
        $db = \Config\Database::connect();
        // $data_id = $this->request->getVar('id');
        
        $this->data['title'] = 'Data User';
        $this->data['buttons'] = array(
            'submit_text' => 'Simpan Data'
        );
        $this->data['submit_url'] = base_url('admin/users/add');

        $this->data['groups'] = $db->table('m_auth_admin_groups')->get()->getResult();
        
        if($data_id != null){
            // goto models nanti ya!
            
            $this->data['data'] = $db->table('m_auth_admins')->where('id', $data_id)->get()->getRowArray();
            // print_r($this->data);exit;
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
            'username' => "string|required",
            'email' => "required|valid_email|is_unique[m_auth_admins.email]",
            'password' => "string|min_length[8]|permit_empty",
            'confirm_password' => "string|matches[password]|permit_empty",
            'role' => "required|in_db[m_auth_admin_groups.id]",
            'mobile' => "numeric|max_length[14]|permit_empty|is_unique[m_auth_admins.phone]",
            'data_id' => "numeric|".($extra == 'update' ? 'required' : 'permit_empty')
        ])) {

            // echo json_encode(['error' => 1, 'message' => $this->validator->getErrors()]);exit;
            return $this->failValidationError(json_encode($this->validator->getErrors()));
            exit;
        }
        $password = $this->request->getVar('password');
        $res = ['id' => null, 'error' => 1, 'message' => 'Gagal menambahkan data!', 'detail' => [], 'redirect' => null];
        try {
            $data_id = $this->request->getVar('data_id');
            $db = \Config\Database::connect();
            $builder = $db->table('m_auth_admins');
            
            if($data_id == null){
                $password = $password == null ? '12345678' : $password;
                $password = password_hash($password, PASSWORD_BCRYPT);

                $x = $builder->insert(array(
                    'name' => $this->request->getVar('name'),
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('phone'),
                    'active' => $this->request->getVar('active') == null ? 1 : $this->request->getVar('active'),
                    'default_group' => $this->request->getVar('role'),
                    'password' => $password,
                ));
    
                if($x){
                    $res['id'] = $db->insertID();
                    $res['error'] = 0;
                    $res['message'] = 'Berhasil menambahkan data!'; 
                    $res['redirect'] = base_url('admin/users');
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
                    'active' => $this->request->getVar('active') == null ? 1 : $this->request->getVar('active'),
                    'default_group' => $this->request->getVar('role')
                );
                if($password != null){
                    $set['password'] = password_hash($password, PASSWORD_BCRYPT);
                }
                $x = $builder->where('id', $data_id)->update($set);
                if($x){
                    $res['id'] = $data_id;
                    $res['error'] = 0;
                    $res['message'] = 'Berhasil mengubah data!'; 
                    $res['redirect'] = base_url('admin/users');
                }
            }
        } catch (\Throwable $th) {
            // print_r($th->getMessage());exit;
            $res['detail'] = $th->getMessage();
            return $this->fail($res, 500);
        }
       
        return $this->fail($res, 400);
    }

}
