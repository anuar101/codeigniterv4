<?php 
namespace App\Controllers;
use App\Models\UsersModel;
use CodeIgniter\Controller;

class Users extends Controller
{
    protected $userModel;
    public function __construct() {

        $this->userModel = new UsersModel();
    }

    // show users list
    public function index(){
        $data['users'] = $this->userModel->orderBy('id', 'DESC')->findAll();
        return view('user_view', $data);
    }

    // add user form
    public function create(){
        return view('add_user');
    }
 
    // insert data
    public function store() {

        $data = [
            'fullname' => $this->request->getVar('fullname'),
            'email'  => $this->request->getVar('email'),
        ];
        $this->userModel->insert($data);
        return $this->response->redirect('/users-list');
    }

    // show single user
    public function singleUser($id = null){

        $data['user_obj'] = $this->userModel->where('id', $id)->first();
        return view('edit_view', $data);
    }

    // update user data
    public function update(){

        $id = $this->request->getVar('id');
        $data = [
            'fullname' => $this->request->getVar('fullname'),
            'email'  => $this->request->getVar('email'),
        ];

        $this->userModel->update($id, $data);
        return $this->response->redirect('/users-list');
    }
 
    // delete user
    public function delete($id = null){

        $data['user'] = $this->userModel->where('id', $id)->delete($id);
        return $this->response->redirect('/users-list');
    }    
}