<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_auth extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_auth');
	}
	
	public function index()
	{
		//$this->load->view('login');
		echo "halo";
	}
	
	public function sentemail(){
	    if($this->m_auth->sentCodetoMail("sugabnogroho@gmail.com","20190616061514dho","205934")){
	        return "sukses";
	    }
	    return "gagal";
	}

	public function auth_login(){
        $secret_key=$this->input->post('secret_key');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if($secret_key == secret_key){
            $result = $this->m_auth->userLogin($email,$password);
            if($result == berhasil_login){
                $res_data = $this->m_auth->getUserByEmail($email);
                $this->response($res_data,false,$result);
            }else{
                $this->response(null,true,$result);
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }

    public function auth_register(){
        $secret_key=$this->input->post('secret_key');
        $data = array(
            'user_nama' => $this->input->post('nama'),
            'user_email' => $this->input->post('email'),
            'user_telpon' =>$this->input->post('telpon'),
            'user_pass' => password_hash($this->input->post('password'),PASSWORD_DEFAULT)
        );
        if($secret_key==secret_key){
            $result = $this->m_auth->createUser($data);
            if($result == berhasil_register){
                $res_data = $this->m_auth->getUserByEmail($data['user_email']);
                $this->response($res_data,false,$result);
            }else{
                $this->response(null,true,$result);
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }

    public function auth_verif()
    {
        $secret_key=$this->input->post('secret_key');
        $data=array(
            'verifikasi_userid' => $this->input->post('user_id'),
            'verifikasi_code' => $this->input->post('code')
        );
        if($secret_key==secret_key){
            $result = $this->m_auth->verifikasi($data);
            if($result == berhasil_verifikasi){
                $res_data = $this->m_auth->getUserByID($data['verifikasi_userid']);
                $this->response($res_data,false,$result);
            }else{
                $this->response(null,true,$result);
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }

    public function auth_verif_mail($userid,$code)
    {
        $data=array(
            'verifikasi_userid' => $userid,
            'verifikasi_code' => $code
        );
        $result = $this->m_auth->verifikasi($data);
        if($result == berhasil_verifikasi){
            $this->response(null,false,$result);
        }else{
            $this->response(null,true,$result);
        }
    }

    public function response($data,$error,$message)
    {
        $response = array(
            'error' => $error,
            'message' => $message,
            'data'=> $data);

        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
        exit;
    }
}
