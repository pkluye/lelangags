<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cari extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session','pagination'));
		$this->load->helper(array('url','form'));
		$this->load->model('m_kategori');
		$this->load->model('m_indonesia');
		$this->load->model('m_lelang');
		$this->load->model('m_pekerjaan');
		$this->load->model('m_auth');
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
                redirect(site_url('/'));;
            }
        }
	}
	
	public function hasil(){
	    $type = $this->input->post('type');
	    $word = $this->input->post('word');
	    
	    $data_u = $this->session->userdata('data_user');
	    $data['title'] = "Hasil Pencarian $word";
	    $data['parent'] = $this->m_kategori->getParent();
	    $data['controller'] = $this;
	    $data['pembayaran'] = unserialize(PEMBAYARAN);
	    $this->load->view('includes/v_header', $data);
	    $data['links'] = null;
	    if($type==0){
	        $data['lelang'] = $this->m_lelang->cariLelang($data_u['user_id'], $word);
	        $this->load->view('v_lihat_lelang', $data);
	    }
        $this->load->view('includes/v_footer');
	}
	
    public function getSub($id){
        $sub = $this->m_kategori->getSubParentKategori($id);
        return $sub;
    }	
    
    public function getProduk($id){
        $produk = $this->m_kategori->getKategori($id);
        return $produk;
    }
    
    public function getKabProv($idKab){
        $kabprov = $this->m_indonesia->selectKabProv($idKab);
        return $kabprov[0];
    }
    
    public function getUserDetail($id){
        $user = $this->m_auth->getUserByID($id);
        return $user;
    }
    
    public function getDaftarProduk($id){
        $dataP = $this->m_pekerjaan->getDaftarProduk($id);
        $produk = array();
        foreach($dataP as $val){
            array_push($produk, array("idp"=>$val->pekerjaan_id, "idl"=>$val->pekerjaan_lelangid, "nama"=>$val->kategori_nama, "ukuran"=>$val->pekerjaan_ukuran, "bahan"=>$val->pekerjaan_bahan, "catatan"=>$val->pekerjaan_catatan, "jumlah"=>$val->pekerjaan_jumlah, "idk"=>$val->pekerjaan_kategoriid, "harga"=>$val->pekerjaan_harga, "sisi"=>$val->pekerjaan_jmlsisi, "laminasi"=>$val->pekerjaan_laminasi));
        }
        return $produk;
    }
    
    public function getJumlahProduk($id){
        $jumlah = $this->m_pekerjaan->getJumlahProduk($id);
        return $jumlah;
    }
    
    public function getDaftarTawaran($where){
        $dataP = $this->m_tawaran->selectTawaranBy($where);
        $tawaran = array();
        foreach($dataP as $val){
            array_push($tawaran, array("id"=>$val->tawaran_id, "nama"=>$val->user_nama, "hps"=>$val->tawaran_anggaran, "foto"=>$val->user_imgurl, "uid"=>$val->user_id));
        }
        return $tawaran;
    }
    
    public function getJumlahTawaran($id){
        $jumlah = $this->m_tawaran->getJumlahTawaran($id);
        return $jumlah;
    }
    
    public function cekTawaran($where){
        $tawaran =  $this->m_tawaran->selectTawaranBy($where);
        $result = ($tawaran)?$tawaran[0]:null;
        return $result;
    }    
}