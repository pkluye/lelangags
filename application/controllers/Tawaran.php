<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tawaran extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->helper(array('url','form'));
		$this->load->model('m_kategori');
		$this->load->model('m_indonesia');
		$this->load->model('m_lelang');
		$this->load->model('m_pekerjaan');
		$this->load->model('m_tawaran');
	}

	public function index(){
	    if (!$this->session->userdata('data_user')){
            redirect(site_url('/login'));
        } else {
            $data_u = $this->session->userdata('data_user');
            if(!$data_u['user_status']){
                $data['title'] = "Verifikasi";
                $this->load->view('includes/v_header', $data);
                $this->load->view('v_verifikasi');
                $this->load->view('includes/v_footer');
            } else {
                redirect(site_url('/profil/tawaran'));
            }
        }
	}
	
	public function pengajuan(){
	    if (!$this->session->userdata('data_user')){
            redirect(site_url('/login'));
        } else {
            $data_u = $this->session->userdata('data_user');
            if(!$data_u['user_status']){
                $data['title'] = "Verifikasi";
                $this->load->view('includes/v_header', $data);
                $this->load->view('v_verifikasi');
                $this->load->view('includes/v_footer');
            } else {
                $data_u = $this->session->userdata('data_user');
	    
        	    $datat['tawaran_lelangid'] = $this->input->post('lid');
        	    $datat['tawaran_userid'] = $data_u['user_id'];
        	    $datat['tawaran_cid'] = $data_u['user_id'];
        	    $datat['tawaran_status'] = 3;

                $idp = $this->input->post('idp');
                $htawaran = preg_replace('/\D/', '', $this->input->post('htawaran'));
                
                $total = array_sum($htawaran);
                
                $datat['tawaran_anggaran'] = $total;
                
                $cekTawaran = $this->m_tawaran->selectTawaranBy(array('lelang_id'=>$datat['tawaran_lelangid'], 'user_id'=>$datat['tawaran_userid'], 'tawaran_status'=>3));
                if($cekTawaran){
                    $datapu['tawaran_anggaran'] = $datat['tawaran_anggaran'];
                    $this->m_tawaran->update(array('tawaran_userid'=>$datat['tawaran_userid'], 'tawaran_lelangid'=>$datat['tawaran_lelangid']), $datapu);
                    for($i = 0; $i < sizeof($idp); $i++){    
                        $this->m_tawaran->updateTawaranPek(array("twpekerjaan_pekerjaanid"=>$idp[$i], "lelang_id"=>$datat['tawaran_lelangid']), array("twpekerjaan_anggaran"=>$htawaran[$i]));
                    }
                } else {
          	        $tawaranid = $this->m_tawaran->insertTawaran($datat);
          	        $datatwp = array();
          	        for($i = 0; $i < sizeof($idp); $i++){
          	            array_push($datatwp, array("twpekerjaan_tawaranid"=>$tawaranid, "twpekerjaan_pekerjaanid"=>$idp[$i], "twpekerjaan_anggaran"=>$htawaran[$i], "twpekerjaan_status"=>3));
          	        }
          	        $this->m_tawaran->insertTWPekerjaanBatch($datatwp);
                }
                redirect(site_url('/profil/tawaran'));
            }
        }
        // var_dump($_POST);
	}
}