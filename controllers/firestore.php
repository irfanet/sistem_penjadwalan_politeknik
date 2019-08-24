<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Core\Timestamp;
use DateTime;


class Firestore extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Jadwal_ujian_model');

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            if($this->session->userdata('jabatan') != "Mahasiswa"){
                redirect('auth');
            }
        }
    }
    public function index(){
        $firestore = new FirestoreClient([
            'projectId' => 'sipetpolines-490a6',
        ]);
        $id = uniqid();
        $data=[
            'tanggal' => new TimeStamp(new DateTime()),
        'url' => 'sipet.newplbsfm.org/',
        ];         
        $firestore->collection('Rekap')->newDocument()->set($data);
        $this->session->set_flashdata('flash','Notifikasi Berhasil dikirim');
        
        redirect('agenda');
    }
    public function rekapanPerhari(){
        $firestore = new FirestoreClient([
            'projectId' => 'sipetpolines-490a6',
        ]);
        $id = uniqid();
        $data=[
        'tanggal' => new TimeStamp(new DateTime()),
        'url' => 'sipet.newplbsfm.org/',
        
        ];         
        $firestore->collection('Rekap')->newDocument()->set($data);
        $this->session->set_flashdata('flash','Notifikasi Berhasil dikirim');
        redirect('rekapan_perhari');
    }
    public function tunjuk($tgl){
        // $data= $this->uri->segment(3);
        // echo $data;
        $this->load->model('rekapan_perhari_model');
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
       
        $berangkat = 0;
        $mbolos = 0;
        $waiting = 0;
        $tgl=str_replace('%20',' ',$tgl);
        $rekapan = $this->rekapan_perhari_model->tampilGroupByHari($tgl,$semester,$tahun_ajaran); 
        foreach($rekapan as $rek){
            if($rek['absensi']==1){
                $berangkat++;
            }else if($rek['absensi']==NULL){
                $waiting++;
            }else{
                $mbolos++;
            }
        }
        // echo 'Hadir   :'.$berangkat.' | ';
        $firestore = new FirestoreClient([
            'projectId' => 'sipetpolines-490a6',
        ]);
        $id = uniqid();
        $data=[
        'tanggal' => new TimeStamp(new DateTime()),
        'url' => 'sipet.newplbsfm.org/',
        'mbolos' => $mbolos,
        ];         
        $firestore->collection('Rekap')->newDocument()->set($data);
        $this->session->set_flashdata('flash','Notifikasi Berhasil dikirim');
        redirect('rekapan_perhari');
    }
}