<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekapan_perhari extends CI_Controller
{
    private $semester;
    private $tahun_ajaran;

    public function __construct(){
        parent::__construct();
        
        $this->load->model('rekapan_perhari_model');
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->tahun_ajaran = $tahun_ajaran;
        $this->semester = $semester;
        
    }
    public function index(){
        $data['title'] = 'Daftar REKAPAN PERHARI';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        // $data['rekapan'] = $this->rekapan_perhari_model->tampilGroupByHari($haritanggal,$this->semester,$this->tahun_ajaran);
        $data['rekapan_hari'] = $this->rekapan_perhari_model->getPerhari($this->semester,$this->tahun_ajaran);
        // $data['queryPerDosen'] = $this->rekapan_perhari_model->jadwalperdosen();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekapan_perhari/index',$data);
        $this->load->view('templates/footer');
    }
    public function index_hari(){
        $data['title'] = 'Daftar REKAPAN PERHARI';
        $post = $this->input->post();
        $haritanggal = $post["haritanggal"];
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $data['rekapan'] = $this->rekapan_perhari_model->tampilGroupByHari($haritanggal,$this->semester,$this->tahun_ajaran);
        // $data['rekapan_hari'] = $this->rekapan_perhari_model->getPerhari($this->semester,$this->tahun_ajaran);
        // $data['queryPerDosen'] = $this->rekapan_perhari_model->jadwalperdosen();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekapan_perhari/view',$data);
        $this->load->view('templates/footer');
    }
}
