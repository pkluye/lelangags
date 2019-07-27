<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lelang extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('m_crud','m_kategori','m_indonesia','m_user', 'm_auth','m_lelang','m_pekerjaan','m_tawaran'));
	}

	public function index()
	{
	    $data['controller'] = $this;
        $data['parent'] = $this->m_kategori->selectKategori();
        $data['pembayaran'] = unserialize(PEMBAYARAN);
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");
	    $data["lelangs"] = $this->m_crud->read('lelangags_lelang');
        $this->load->view("admin/v_lelang", $data);
	}

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/users');
       
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
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
            array_push($produk, array("idp"=>$val->pekerjaan_id, "idl"=>$val->pekerjaan_lelangid, "nama"=>$val->kategori_nama, "ukuran"=>$val->pekerjaan_ukuran, "bahan"=>$val->pekerjaan_bahan, "catatan"=>$val->pekerjaan_catatan, "jumlah"=>$val->pekerjaan_jumlah, "idk"=>$val->pekerjaan_kategoriid, "harga"=>$val->pekerjaan_harga));
        }
        return $produk;
    }
    
    public function getJumlahProduk($id){
        $jumlah = $this->m_pekerjaan->getJumlahProduk($id);
        return $jumlah;
    }
	
    
    public function getDaftarTawaran($id){
        $dataP = $this->m_tawaran->selectTawaranBy($id);
        $tawaran = array();
        foreach($dataP as $val){
            array_push($tawaran, array("id"=>$val->tawaran_id, "nama"=>$val->user_nama, "hps"=>$val->tawaran_anggaran, "foto"=>$val->user_imgurl));
        }
        return $tawaran;
    }
    
    public function getJumlahTawaran($id){
        $jumlah = $this->m_tawaran->getJumlahTawaran($id);
        return $jumlah;
    }
}
