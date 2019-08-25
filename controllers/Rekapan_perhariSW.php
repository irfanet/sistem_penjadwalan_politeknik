<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekapan_perhariSW extends CI_Controller
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
        $this->load->view('rekapan_perhariSW/index',$data);
        $this->load->view('templates/footer');
    }
    public function index_hari(){
        $data['title'] = 'Daftar REKAPAN PERHARI';
        $post = $this->input->post();
        $haritanggal = $post["haritanggal"];
        $absen = $post["absen"];
        if($absen=="all"){
            $data['rekapan'] = $this->rekapan_perhari_model->tampilGroupByHari($haritanggal,$this->semester,$this->tahun_ajaran);
        }else{
            if($absen=='null'){
                $data['rekapan'] = $this->rekapan_perhari_model->tampilGroupByHariNull($haritanggal,$this->semester,$this->tahun_ajaran);
            }else{
                $data['rekapan'] = $this->rekapan_perhari_model->tampilGroupByHariK($absen,$haritanggal,$this->semester,$this->tahun_ajaran);
            }
        }
        $data['tgl'] = $this->rekapan_perhari_model->getTgl($haritanggal,$this->semester,$this->tahun_ajaran)->row_array();
        $data['jml'] = $this->rekapan_perhari_model->getTgl($haritanggal,$this->semester,$this->tahun_ajaran)->num_rows();
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        // $data['rekapan'] = $this->rekapan_perhari_model->tampilGroupByHari($haritanggal,$this->semester,$this->tahun_ajaran);
        // $data['rekapan_hari'] = $this->rekapan_perhari_model->getPerhari($this->semester,$this->tahun_ajaran);
        // $data['queryPerDosen'] = $this->rekapan_perhari_model->jadwalperdosen();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekapan_perhariSW/viewSW',$data);
        $this->load->view('templates/footer');
    }
    public function hitung_mbolos(){
        $data['title'] = 'Hitung Absensi';
        $post = $this->input->post();
        $haritanggal = $post["haritanggal"];
        $berangkat = 0;
        $mbolos = 0;
        $waiting = 0;
        $rekapan = $this->rekapan_perhari_model->tampilGroupByHari($haritanggal,$this->semester,$this->tahun_ajaran); 
        foreach($rekapan as $rek){
            if($rek['status']==1){
                $berangkat++;
            }else if($rek['status']==NULL){
                $waiting++;
            }else{
                $mbolos++;
            }
        }
        $data['berangkat'] = $berangkat;
        $data['mbolos'] = $mbolos;
        $data['waiting'] = $waiting;   
        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('................',$data);
        $this->load->view('templates/footer');    
    }
}
