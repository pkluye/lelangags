<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pekerjaan extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_pekerjaan');
        $this->load->model('m_lelang');
    }

    public function pekerjaan_buat()
    {
        $secret_key=$this->input->post('secret_key');
        $pekerjaan_data=array(
            'pekerjaan_lelangid' =>$this->input->post('pekerjaan_lelangid'),
            'pekerjaan_ukuran ' =>$this->input->post('pekerjaan_ukuran'),
            'pekerjaan_bahan' =>$this->input->post('pekerjaan_bahan'),
            'pekerjaan_jumlah'=>$this->input->post('pekerjaan_jumlah'),
            'pekerjaan_harga' =>$this->input->post('pekerjaan_harga'),
            'pekerjaan_catatan' =>$this->input->post('pekerjaan_catatan'),
            'pekerjaan_fileurl' =>$this->input->post('pekerjaan_fileurl'),
            'pekerjaan_kategoriid' =>$this->input->post('pekerjaan_kategoriid'),
            'pekerjaan_cid' =>$this->input->post('user_id'),
            'pekerjaan_status' => status_enable
        );
        $lelang_data_=(array)$this->m_lelang->selectlelang($pekerjaan_data['pekerjaan_lelangid']);
        if($secret_key==secret_key){
            $lelang_data=array(
                'lelang_uid'=>$this->input->post('user_id'),
                'lelang_anggaran'=>$lelang_data_[0]->lelang_anggaran+$pekerjaan_data['pekerjaan_harga']
            );
            $result=$this->m_lelang->updatelelang($pekerjaan_data['pekerjaan_lelangid'],$lelang_data);
            $result=$this->m_pekerjaan->insertPekerjaan($pekerjaan_data);
            if($result==berhasil_buat_pekerjaan){
                $this->response(null,false,$result);
            }else{
                $this->response(null,true,$result);
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }

    public function pekerjaan_edit()
    {
        $secret_key=$this->input->post('secret_key');
        $pekerjaan_id=$this->input->post('pekerjaan_id');
        $pekerjaan_data=array(
            'pekerjaan_ukuran ' =>$this->input->post('pekerjaan_ukuran'),
            'pekerjaan_bahan' =>$this->input->post('pekerjaan_bahan'),
            'pekerjaan_jumlah'=>$this->input->post('pekerjaan_jumlah'),
            'pekerjaan_harga' =>$this->input->post('pekerjaan_harga'),
            'pekerjaan_catatan' =>$this->input->post('pekerjaan_catatan'),
            'pekerjaan_fileurl' =>$this->input->post('pekerjaan_fileurl'),
            'pekerjaan_uid' =>$this->input->post('user_id')
        );
        if($pekerjaan_data['pekerjaan_fileurl']==''){  
            $pekerjaan_data['pekerjaan_fileurl']="-";
        }
        if($secret_key==secret_key){
            $lelang_data=array(
                'lelang_uid'=>$this->input->post('user_id'),
                'lelang_anggaran'=>$pekerjaan_data['pekerjaan_harga'],
            );
            $result=$this->m_lelang->updatelelang($pekerjaan_data['pekerjaan_lelangid'],$lelang_data);
            $result=$this->m_pekerjaan->updatePekerjaan($pekerjaan_id,$pekerjaan_data);
            if($result==berhasil_edit_pekerjaan){
                $this->response(null,false,$result);
            }else{
                $this->response(null,true,$result);
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }

    public function pekerjaan_delete()
    {
        $secret_key=$this->input->post('secret_key');
        $pekerjaan_id=$this->input->post('pekerjaan_id');
        $pekerjaan_data=array(
            'pekerjaan_status' =>status_delete,
            'pekerjaan_uid' =>$this->input->post('user_id')
        );
        $lelang_data_=(array)$this->m_lelang->selectlelang($pekerjaan_data['pekerjaan_lelangid']);
        if($secret_key==secret_key){
            $lelang_data=array(
                'lelang_uid'=>$this->input->post('user_id'),
                'lelang_anggaran'=>$lelang_data_[0]->lelang_anggaran - $pekerjaan_data['pekerjaan_harga'],
            );
            $result=$this->m_lelang->updatelelang($pekerjaan_data['pekerjaan_lelangid'],$lelang_data);
            $result=$this->m_pekerjaan->updatePekerjaan($pekerjaan_id,$pekerjaan_data);
            if($result==berhasil_edit_pekerjaan){
                $this->response(null,false,$result);
            }else{
                $this->response(null,true,$result);
            }
        }else{
            $this->response(null,true,secret_key_salah);
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