<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $semester;
    private $tahun_ajaran;
    public function __construct(){
        parent::__construct();
        
        $this->load->model('dashboard_model');
        $this->load->model('agenda_model');
        $this->load->model('Panitia_ujian_model');
        // $this->load->model('cetak_model');

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            if($this->session->userdata('jabatan') != "Mahasiswa"){
                redirect('auth');
            }
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
        $this->load->model('Cetak_model');
        $id = $this->session->userdata('id');
        $jadwal = $this->jadwal->tampilJadwalSaya();
        foreach($jadwal as $jdwl){
            if($jdwl->absensi==1){
                $hari++;
            }
        }
        date_default_timezone_set('Asia/Jakarta');
        $tgl=strtotime(date('Y-m-d'));
        $tgl=date('Y-m-d',strtotime('today',$tgl));
        

        $data['agenda']=$this->agenda_model->getAgenda($tgl,$this->semester,$this->tahun_ajaran)->result_array();
        $data['agenda2']=$this->agenda_model->getAgenda2($tgl,$this->semester,$this->tahun_ajaran)->result_array();

        $data['jadwal_saya'] = $this->jadwal->countJadwal()->num_rows();
        $data['jadwal'] = $this->jadwal->countJadwalAll()->num_rows();
        $data['kelas'] = $this->jadwal->countKelas()->num_rows();
        $data['mapel'] = $this->jadwal->countMapel()->num_rows();

        
        $gaji = 50000;
        $golongan = $this->session->userdata('golongan');
											if($golongan==4){
                                                $pajak = "15%";
                                                $potongan = 0.15;
												$pocongan = 0.15*$gaji;
												$penghasilan = ($gaji*$hari)-($hari*$pocongan);
											}else{
                                                $pajak = "5%";
                                                $potongan = 0.05;
												$pocongan = 0.05*$gaji;
												$penghasilan = ($gaji*$hari)-($hari*$pocongan);
                                            }
        $makul = $this->Cetak_model->cekSoal($id,$this->semester,$this->tahun_ajaran)->num_rows();
        $kelas = $this->Cetak_model->cekKelas($id,$this->semester,$this->tahun_ajaran)->num_rows();
        $gajiSoal = 82000;
        $gajiKoreksi = 2000;
        $honorSoal = $gajiSoal*$makul;
        $honorKoreksi = $gajiKoreksi*$kelas*24;
        $totalKotor = $honorSoal+$honorKoreksi;
        $totalBersih = $totalKotor - ($totalKotor*$potongan);

        $data['honor'] = $totalBersih+$penghasilan;
        $data['asc'] = $this->dashboard_model->getData('ASC');
        $data['desc'] = $this->dashboard_model->getData('DESC');

        // $data['notif'] = $this->Soal_ujian_model->get_notif();
        $data['class'] = $this->Soal_ujian_model->get_notif_kelas();
        $data['soal'] = $this->Soal_ujian_model->tampilSoal2($this->semester,$this->tahun_ajaran,$this->session->userdata('id'));
        $data['notif'] = $this->Soal_ujian_model->get_notif();

        $importPegawai = $this->dashboard_model->notif_import_pegawai()->num_rows();
        if($importPegawai==0){
            $data['import_pegawai'] = "<strong>Segera Import file CSV Data Pegawai !</strong>";
        } 
        $importKelas = $this->dashboard_model->notif_import_Kelas()->num_rows();
        if($importKelas==0){
            $data['import_kelas'] = "<strong>Segera Import file CSV Data Kelas !</strong>";
        } 
        $importRuangKelas = $this->dashboard_model->notif_import_ruangKelas()->num_rows();
        if($importRuangKelas==0){
            $data['import_ruangKelas'] = "<strong>Segera Import file CSV Data Ruang Kelas !</strong>";
        } 
        $importProdi = $this->dashboard_model->notif_import_prodi()->num_rows();
        if($importProdi==0){
            $data['import_prodi'] = "<strong>Segera Import file CSV Data Prodi !</strong>";
        } 


        $importMakul = $this->dashboard_model->notif_import_makul($this->semester,$this->tahun_ajaran)->num_rows();
        if($importMakul==0){
            $data['import_makul'] = "<strong>Segera Import file CSV Data Matkul !</strong>";
        }
        $importPengampu = $this->dashboard_model->notif_import_pengampu($this->semester,$this->tahun_ajaran)->num_rows();
        if($importPengampu==0){
            $data['import_pengampu'] = "<strong>Segera Import file CSV Data Pengampu !</strong>";
        }
        $importPengawasCadangan = $this->dashboard_model->notif_import_pengawasCadangan($this->semester,$this->tahun_ajaran)->num_rows();
        if($importPengawasCadangan==0){
            $data['import_pengawasCadangan'] = "<strong>Segera Import file CSV Data Pengawas Cadangan !</strong>";
        }
        $importJadwal = $this->dashboard_model->notif_import_jadwal($this->semester,$this->tahun_ajaran)->num_rows();
        if($importJadwal==0){
            $data['import_jadwal'] = "<strong>Segera Import file CSV Jadwal !</strong>";
        }
        $notifAgenda = $this->dashboard_model->notif_agenda($this->semester,$this->tahun_ajaran)->num_rows();
        if($notifAgenda<10){
            $data['notif_agenda'] = "<strong>Segera Lengkapi Tanggal Agenda Kegiatan !</strong>";
        }
        
        $cek1 = $this->Panitia_ujian_model->tampilKabid($this->semester,$this->tahun_ajaran)->num_rows();
        $cek2 = $this->Panitia_ujian_model->tampilSekretaris($this->semester,$this->tahun_ajaran)->num_rows();
        $cek3 = $this->Panitia_ujian_model->tampilSeksiTempat($this->semester,$this->tahun_ajaran)->num_rows();
        $cek4 = $this->Panitia_ujian_model->tampilKoorSPDJ($this->semester,$this->tahun_ajaran)->num_rows();
        $cek5 = $this->Panitia_ujian_model->tampilKoorSNDP($this->semester,$this->tahun_ajaran)->num_rows();
        $cek6 = $this->Panitia_ujian_model->tampilPA($this->semester,$this->tahun_ajaran)->num_rows();
        $cek7 = $this->Panitia_ujian_model->tampilAnggota1($this->semester,$this->tahun_ajaran)->num_rows();
        $cek8 = $this->Panitia_ujian_model->tampilAnggota2($this->semester,$this->tahun_ajaran)->num_rows();
        $cek9 = $this->Panitia_ujian_model->tampilPembantu($this->semester,$this->tahun_ajaran)->num_rows();
        // $notif_panitia = $cek1 + $cek2 + $cek3 + $cek4 + $cek5 + $cek6 + $cek7 + $cek8 + $cek9;
        if($cek1 == 0 || $cek2 == 0 || $cek3 == 0 || $cek4 == 0 || $cek5 == 0 || $cek6 == 0 || $cek7 == 0 || $cek8 == 0 || $cek9 == 0){
            $data['notif_panitia'] = "<strong>Segera Lengkapi Panitia Ujian ! </strong>";
        }

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index',$data);
        $this->load->view('templates/footer');
    }
}