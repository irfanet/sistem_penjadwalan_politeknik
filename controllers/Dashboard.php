<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $semester;
    private $tahun_ajaran;
    public function __construct(){
        parent::__construct();
        
        $this->load->model('dashboard_model');
        $this->load->model('agenda_model');
        // $this->load->model('cetak_model');

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            if($this->session->userdata('nim') != TRUE){
                redirect('auth');
            }
            redirect('auth');
        }

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
        $data['title'] = 'Dashboard';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        // $data['querydosen'] = $this->cetak_model->prjadwalperdosen();
        // $data['queryPerDosen'] = $this->cetak_model->jadwalperdosen();

        // $dosen = $this->cetak_model->prjadwalperdosen();
        // foreach($dosen as $d){
        //     $nama = $d['nama_singkat'];
            
        // }

        $hari = 0;
        $this->load->model('jadwal_ujian_model','jadwal');
        $this->load->model('Soal_ujian_model');
        $jadwal = $this->jadwal->tampilJadwalSaya();
        foreach($jadwal as $jdwl){
            if($jdwl->absensi==1){
                $hari++;
            }
        }
        date_default_timezone_set('Asia/Jakarta');
        $tgl=strtotime(date('Y-m-d'));
        $tgl=date('Y-m-d',strtotime('today',$tgl));
        $data['agenda']=$this->agenda_model->getAgenda($tgl)->result_array();

        $data['jadwal_saya'] = $this->jadwal->countJadwal()->num_rows();
        $data['jadwal'] = $this->jadwal->countJadwalAll()->num_rows();
        $data['kelas'] = $this->jadwal->countKelas()->num_rows();
        $data['mapel'] = $this->jadwal->countMapel()->num_rows();
        $data['honor'] = 50000*$hari;
        $data['asc'] = $this->dashboard_model->getData('ASC');
        $data['desc'] = $this->dashboard_model->getData('DESC');

        // $data['notif'] = $this->Soal_ujian_model->get_notif();
        $data['class'] = $this->Soal_ujian_model->get_notif_kelas();
        $data['soal'] = $this->Soal_ujian_model->tampilSoal2($this->semester,$this->tahun_ajaran,$this->session->userdata('id'));
        $data['notif'] = $this->Soal_ujian_model->get_notif();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index',$data);
        $this->load->view('templates/footer');
    }
}