<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('absensi_model');
        $this->load->model('cetak_model');

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            if($this->session->userdata('jabatan') != "Panitia"){
                if($this->session->userdata('jabatan') != "Kajur"){
                    if($this->session->userdata('jabatan') != "Kaprodi"){
                        redirect('auth');
                    }
                }
            }
        }
    }
    public function index(){
        $data['title'] = 'Daftar Jadwal Ujian';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $data['querydosen'] = $this->cetak_model->prjadwalperdosen();
        $data['queryPerDosen'] = $this->cetak_model->jadwalperdosen();

        $dosen = $this->cetak_model->prjadwalperdosen();
        $jadwal = $this->cetak_model->jadwalperdosen();
        $num=0;
        foreach($dosen as $d){
            $id = $d['id'];
            $nama = $d['nama_singkat'];
            $data['total'][$id] = $this->cetak_model->countAbsensiDosen($nama)->num_rows();
            $data['temp'][$id] = $this->cetak_model->countNullAbsen($nama)->num_rows();
            if($data['temp'][$id]==0){
                $num++;
            }     
        }
        // ][]=$total;
       
        // $data['total'] = $this->cetak_model->countAbsensiDosen($nama)->num_rows();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('absensi/index',$data);
        $this->load->view('templates/footer');
    }
    public function kehadiran($nama){
        $data['title'] = 'Daftar Jadwal Ujian';
        
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $nama_singkat = str_replace("%20"," ",$nama);
        $data['nama_singkat'] = $nama_singkat;
        $data['querydosen'] = $this->cetak_model->prjadwalperdosen();
        $data['queryPerDosen'] = $this->cetak_model->jadwalperdosen();
    

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('absensi/kehadiran',$data);
        $this->load->view('templates/footer');



     
    }
    public function update(){
   
        error_reporting(E_ALL ^ E_NOTICE);
        $ID_att = $this->input->post('ID_att');
        $result = array();
        foreach($ID_att AS $key => $val){
            $result[] = array(
            "id" => $ID_att[$key],
            "absensi"  => $_POST['kehadiran'][$val]
            );
        }
        $test = $this->db->update_batch('jadwal', $result, 'id');
        if($test){
            $this->session->set_flashdata('flash','Absensi Berhasil Ditambahkan');
            redirect('absensi');    }
            else{
                print_r($result) ;   
            echo "gagal di input";
        }

    }
    public function cek($nama){
        $data['title'] = 'Daftar Jadwal Ujian';
        
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $nama_singkat = str_replace("%20"," ",$nama);
        $data['nama_singkat'] = $nama_singkat;
        $data['querydosen'] = $this->cetak_model->prjadwalperdosen();
        $data['queryPerDosen'] = $this->cetak_model->jadwalperdosen();
        $data['golongan'] = $this->cetak_model->getGolonganByNama($nama_singkat)->row_array();
        // $data['golongan'] = $this->cetak_model->

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('absensi/cek',$data);
        $this->load->view('templates/footer');



     
    }
    public function countDone(){
        $this->load->model('cetak_model');
        $data['querydosen'] = $this->cetak_model->prjadwalperdosen();
        $data['queryPerDosen'] = $this->cetak_model->jadwalperdosen();

        $dosen = $this->cetak_model->prjadwalperdosen();
        $jadwal = $this->cetak_model->jadwalperdosen();
        $num=0;
        foreach($dosen as $d){
            $id = $d['id'];
            $nama = $d['nama_singkat'];
            $data['total'][$id] = $this->cetak_model->countAbsensiDosen($nama)->num_rows();
            $data['temp'][$id] = $this->cetak_model->countNullAbsen($nama)->num_rows();
            if($data['temp'][$id]==0){
                $num++;
            }     
        }
        return $num;
    }

}