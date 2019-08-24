<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Google\Cloud\Firestore\FirestoreClient;


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
        'status' => $id,
        'url' => 'sipet.newplbsfm.org/',
        ];         
        $firestore->collection('Rekap')->document('kilop')->set($data);
        $this->session->set_flashdata('flash','Notifikasi Berhasil dikirim');
        
        redirect('agenda');
    }
    public function rekapanPerhari(){
        $firestore = new FirestoreClient([
            'projectId' => 'sipetpolines-490a6',
        ]);
        $id = uniqid();
        $data=[
        'status' => $id,
        'url' => 'sipet.newplbsfm.org/',
        ];         
        $firestore->collection('Rekap')->document('kilop')->set($data);
        $this->session->set_flashdata('flash','Notifikasi Berhasil dikirim');
        redirect('rekapan_perhari');
    }
    public function tunjuk(){
        $data= $this->uri->segment(3);
        echo $data;
    }
}