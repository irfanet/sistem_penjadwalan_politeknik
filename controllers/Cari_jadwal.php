<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cari_jadwal extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('Cari_jadwal_model');

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            redirect('auth');
        }
    }

    public function index(){
        $data['title'] = 'Form Cari Jadwal';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
        
        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('cari_jadwal/index',$data);
        $this->load->view('templates/footer');
        
    }
    public function hasil(){
        $data['title'] = 'Form Cari Jadwal';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $post = $this->input->post();
        $nama_dosen = $post["nama_dosen"];
        $data['nama_dosen'] = $nama_dosen;
        $data['lPerDosen'] = $this->Cari_jadwal_model->filter($nama_dosen);
        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('cari_jadwal/hasil_cari_jadwal',$data);
        $this->load->view('templates/footer');
    }

}