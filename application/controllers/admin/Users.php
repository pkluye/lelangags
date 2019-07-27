<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model(array('m_crud','m_kategori','m_indonesia','m_user', 'm_auth','m_lelang','m_pekerjaan','m_tawaran'));
	}

	public function index()
	{
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");
	    $data["users"] = $this->m_crud->read('lelangags_user');
        $this->load->view("admin/v_users", $data);
        //$this->load->view("admin/includes/footer");
	}
	
	public function form($action = 'Tambah', $id = null){
	    if($id){
            $akun = $this->m_crud->selectBy('lelangags_user', array('user_id'=> $id))[0];
            $data["users"] = $akun;
	    } else {
            $akun = null;
            $data["users"] = null;
	    }
        $prov = ($akun)?$this->m_user->getprovid($akun->user_kotaid):0;
        $data['provid'] = ($prov)?$prov->provinsi_id:0;
        $data['kotaid'] = ($akun)?$akun->user_kotaid:0;
        $data['prov'] = $this->m_indonesia->selectProvinsi();
        
	    $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");
	    $this->load->view("admin/v_user_form", $data);
	}
	
	public function simpan(){
	    
	}
	
	public function add()
    {
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");  
        // $product = $this->product_model;
        // $validation = $this->form_validation;
        // $validation->set_rules($product->rules());

        //if ($validation->run()) {
            // $product->insert();
          //  $this->session->set_flashdata('success', 'Berhasil disimpan');
        //}
        // $akun = $this->m_crud->selectBy('lelangags_user', array('user_id'=> $id))[0];
        // $prov = $this->m_user->getprovid($akun->user_kotaid);
        // $data['provid'] = ($prov)?$prov->provinsi_id:0;
        // $data['kotaid'] = ($akun)?$akun->user_kotaid:0;
        $data['prov'] = $this->m_indonesia->selectProvinsi();
        $data["users"] = null;
        // $data["product"] = $product->getById($id);
        // if (!$data["users"]) show_404();
        
        $this->load->view("admin/v_user_form", $data);
    }

    public function edit($id = null) {
        if (!isset($id)) redirect('admin/users');
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");  
        // $product = $this->product_model;
        // $validation = $this->form_validation;
        // $validation->set_rules($product->rules());

        //if ($validation->run()) {
            // $product->update();
          //  $this->session->set_flashdata('success', 'Berhasil disimpan');
        //}
        $akun = $this->m_crud->selectBy('lelangags_user', array('user_id'=> $id))[0];
        $prov = $this->m_user->getprovid($akun->user_kotaid);
        $data['provid'] = ($prov)?$prov->provinsi_id:0;
        $data['kotaid'] = ($akun)?$akun->user_kotaid:0;
        $data['prov'] = $this->m_indonesia->selectProvinsi();
        $data["users"] = $akun;
        // $data["product"] = $product->getById($id);
        if (!$data["users"]) show_404();
        
        $this->load->view("admin/v_user_form", $data);
    }
    
    public function editprog($id = null) {
        if (!isset($id)) redirect('admin/users');
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");  
        // $product = $this->product_model;
        // $validation = $this->form_validation;
        // $validation->set_rules($product->rules());

        //if ($validation->run()) {
            // $product->update();
          //  $this->session->set_flashdata('success', 'Berhasil disimpan');
        //}
        $akun = $this->m_crud->selectBy('lelangags_user', array('user_id'=> $id))[0];
        $prov = $this->m_user->getprovid($akun->user_kotaid);
        $data['provid'] = ($prov)?$prov->provinsi_id:0;
        $data['kotaid'] = ($akun)?$akun->user_kotaid:0;
        $data['prov'] = $this->m_indonesia->selectProvinsi();
        $data["users"] = $akun;
        // $data["product"] = $product->getById($id);
        if (!$data["users"]) show_404();
        
        $this->load->view("admin/v_user_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
    }
    
        public function getKabProv($idKab){
        $kabprov = $this->m_indonesia->selectKabProv($idKab);
        return $kabprov[0];
    }
}
