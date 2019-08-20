<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    private $semester;
    private $tahun_ajaran;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('soal_ujian_model');
        if($this->session->userdata('nip') != TRUE){
            redirect('auth');
        }
        if($this->session->userdata('jabatan') != "Petugas"){
            redirect('auth');
        }
        
    }
    public function index(){
        $this->getSet();
        $data['title'] = 'Notifikasi Ingatkan Dosen';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
        $data['mine'] = 1;

        $data['soal'] = $this->soal_ujian_model->tampilSoal($this->semester,$this->tahun_ajaran);

        $this->load->model('Pegawai_model');
        $data['pegawai'] = $this->Pegawai_model->tampilJadwal();
       

        $data['cekk'] = $this->db->query("select id_pegawai from soal_ujian where semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'")->result_array();
        $cekk =  $this->db->query("select id_pegawai from soal_ujian where semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'")->result_array();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('notifikasi/index',$data);
        $this->load->view('templates/footer');

    }

    public function getSet()
    {
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->tahun_ajaran = $tahun_ajaran;
        $this->semester = $semester;
    }
    

}
?>
