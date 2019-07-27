<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_tawaran extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_tawaran');
    }
    
    public function tawaran_buat()
    {
        $secret_key=$this->input->post('secret_key');
        $tawaran_data=array(
            'tawaran_userid' =>$this->input->post('user_id'),
            'tawaran_lelangid'=>$this->input->post('lelang_id'),
            'tawaran_cid'=>$this->input->post('user_id'),
            'tawaran_anggaran'=>$this->input->post('anggaran'),
            'tawaran_status'=>3
        );
        
        if($secret_key==secret_key){
            $result=$this->m_tawaran->insert($tawaran_data);
            if($result==berhasil_buat_tawaran){
                $this->response(null,false,$result);
            }
            $this->response(null,true,$result);
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function tawaran_buatv2(){
        $req_data=json_decode($this->input->raw_input_stream);
        $tawaran_data=$req_data->tawaran;
        $tawaran_data->tawaran_status=3;
        $tawaran_data->tawaran_cid=$tawaran_data->tawaran_userid;
        $twpekerjaan_data=$req_data->twpekerjaan;
        $secret_key=$req_data->secret_key;
        if($secret_key==secret_key){
            $insertid=$this->m_tawaran->insertTawaran($tawaran_data);
            if(isset($insertid)){
                $twpekerjaan_array=array();
                foreach($twpekerjaan_data as $value){
                    $value->twpekerjaan_tawaranid=$insertid;
                    $value->twpekerjaan_status=3;
                    $twpekerjaan_array[]=$value;
                }
                $result=$this->m_tawaran->insertTWPekerjaanBatch($twpekerjaan_array);
                if($result){
                    $this->response(null,false,berhasil_buat_tawaran);
                }else{
                    $this->response(null,true,gagal_buat_tawaran);
                }
            }else{
                $this->response(null,true,gagal_buat_tawaran);
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function tawaran_edit()
    {
        $secret_key=$this->input->post('secret_key');
        $tawaran_data=array(
            'tawaran_uid'=>$this->input->post('user_id'),
            'tawaran_anggaran'=>$this->input->post('anggaran')
        );
        $tawaran_id= $this->input->post('tawaran_id');
        if($secret_key==secret_key){
            $result=$this->m_tawaran->update(array('tawaran_id'=>$tawaran_id),$tawaran_data);
            if($result==berhasil_edit_tawaran){
                $this->response(null,false,$result);
            }
            $this->response(null,true,$result);
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function tawaran_editv2(){
        $req_data=json_decode($this->input->raw_input_stream);
        $tawaran_data=$req_data->tawaran;
        $tawaran_data->tawaran_uid=$tawaran_data->tawaran_userid;
        $twpekerjaan_data=$req_data->twpekerjaan;
        $secret_key=$req_data->secret_key;
        if($secret_key==secret_key){
            $result=$this->m_tawaran->update(array('tawaran_id'=>$tawaran_data->tawaran_id),$tawaran_data);
            if($result==berhasil_edit_tawaran){
                $result=$this->m_tawaran->updateTWPekerjaan($twpekerjaan_data);
                if($result){
                    $this->response(null,false,berhasil_edit_tawaran);
                }else{
                    $this->response(null,true,gagal_edit_tawaran);
                }
            }else{
                $this->response(null,true,gagal_edit_tawaran);
            }
        }else{
            $this->response(null,true,secret_key_salah);
        }
    }
    
    public function tawaran_delete()
    {
        $secret_key=$this->input->post('secret_key');
        $tawaran_data=array(
            'tawaran_uid'=>$this->input->post('user_id'),
            'tawaran_status'=>1
        );
        $tawaran_id=$this->input->post('tawaran_id');
        if($secret_key==secret_key){
            $result=$this->m_tawaran->update(array('tawaran_id'=>$tawaran_id),$tawaran_data);
            if($result==berhasil_edit_tawaran){
                $this->response(null,false,$result);
            }
            $this->response(null,true,$result);
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