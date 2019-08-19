<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

    private $semester;
    private $tahun_ajaran;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('agenda_model');

        if($this->session->userdata('nip') != TRUE){
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
        $data['title'] = 'Agenda';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();    
       
        // $data['matkul'] = $this->agenda->tampilAllMatkul();
        if($this->semester=='Ganjil'){
            $ujian = "Pelaksanaan Ujian Tengah Semester Ganjil Tahun $this->tahun_ajaran ";
        }else{
            $ujian = "Pelaksanaan Ujian Akhir Semester Tahun $this->tahun_ajaran ";
        }
        $kegiatan = ['Penyerahan soal sudah <u>diketik sendiri</u> (sesuai format terlampir dan sudah ditandatangani Kaprodi) dikumpulkan di PBM paling lambat.',
        'Penyerahan soal <u>digandakan sendiri</u> paling lambat (bentuk soal tidak boleh lewat internet dan jumlah soal 26 lembar/soal)',
        $ujian,
        'Entri Nilai di SIA',
        'Rapat Evaluasi',
        'Rapat Evaluasi Mahasiswa Tingkat 1,2,3 dan 4',
        'Pengumuman Peserta Uji Ulang I',
        'Pelaksanaan Uji Ulang I',
        'Pengumuman Uji Ulang II',
        'Pelaksanaan Uji Ulang II',
        'Yudisium mahasiswa Tingkat 1,2,3 dan 4'];


        $data['todo0'] = $this->agenda_model->cekKegiatan($kegiatan['0'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo1'] = $this->agenda_model->cekKegiatan($kegiatan['1'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo2'] = $this->agenda_model->cekKegiatan($kegiatan['2'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo3'] = $this->agenda_model->cekKegiatan($kegiatan['3'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo4'] = $this->agenda_model->cekKegiatan($kegiatan['4'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo5'] = $this->agenda_model->cekKegiatan($kegiatan['5'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo6'] = $this->agenda_model->cekKegiatan($kegiatan['6'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo7'] = $this->agenda_model->cekKegiatan($kegiatan['7'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo8'] = $this->agenda_model->cekKegiatan($kegiatan['8'],$this->semester,$this->tahun_ajaran)->row_array();
        $data['todo9'] = $this->agenda_model->cekKegiatan($kegiatan['9'],$this->semester,$this->tahun_ajaran)->row_array();

        $data['cek0'] = $this->agenda_model->cekKegiatan($kegiatan['0'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek1'] = $this->agenda_model->cekKegiatan($kegiatan['1'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek2'] = $this->agenda_model->cekKegiatan($kegiatan['2'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek3'] = $this->agenda_model->cekKegiatan($kegiatan['3'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek4'] = $this->agenda_model->cekKegiatan($kegiatan['4'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek5'] = $this->agenda_model->cekKegiatan($kegiatan['5'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek6'] = $this->agenda_model->cekKegiatan($kegiatan['6'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek7'] = $this->agenda_model->cekKegiatan($kegiatan['7'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek8'] = $this->agenda_model->cekKegiatan($kegiatan['8'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['cek9'] = $this->agenda_model->cekKegiatan($kegiatan['9'],$this->semester,$this->tahun_ajaran)->num_rows();
        $data['kegiatan'] = $kegiatan;
        $data['all'] = $this->agenda_model->tampilAll($this->semester,$this->tahun_ajaran)->row_array();
        // $data['tam'] = $this->agenda_model->tampil($this->semester,$this->tahun_ajaran)->row_array();

        // $data['tgl'] = $tgl;
        // echo print_r($data);
        // echo print_r($kegiatan);
		$this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('agenda/index',$data);
		$this->load->view('templates/footer');
    }

    public function in_tambah($id){
        $data['title'] = 'Agenda';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();    

        if($this->semester=='Ganjil'){
            $ujian = "Pelaksanaan Ujian Tengah Semester Ganjil Tahun $this->tahun_ajaran ";
        }else{
            $ujian = "Pelaksanaan Ujian Akhir Semester Tahun $this->tahun_ajaran ";
        }
        $kegiatan = ['Penyerahan soal sudah <u>diketik sendiri</u> (sesuai format terlampir dan sudah ditandatangani Kaprodi) dikumpulkan di PBM paling lambat.',
        'Penyerahan soal <u>digandakan sendiri</u> paling lambat (bentuk soal tidak boleh lewat internet dan jumlah soal 26 lembar/soal)',
        $ujian,
        'Entri Nilai di SIA',
        'Rapat Evaluasi',
        'Rapat Evaluasi Mahasiswa Tingkat 1,2,3 dan 4',
        'Pengumuman Peserta Uji Ulang I',
        'Pelaksanaan Uji Ulang I',
        'Pengumuman Uji Ulang II',
        'Pelaksanaan Uji Ulang II',
        'Yudisium mahasiswa Tingkat 1,2,3 dan 4'];
        $data['kegiatan'] = $kegiatan[$id];
        $data['kode'] = $id;

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
       
        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('agenda/add',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->agenda_model->tambahData($kegiatan[$id],$this->semester,$this->tahun_ajaran);
            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Panitia Ujian Berhasil Ditambahkan');
            redirect('agenda');
        }
    }
    
    public function edit($id){
        $data['title'] = 'Agenda';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
		$this->session->userdata('nip')])->row_array();    

        if($this->semester=='Ganjil'){
            $ujian = "Pelaksanaan Ujian Tengah Semester Ganjil Tahun $this->tahun_ajaran ";
        }else{
            $ujian = "Pelaksanaan Ujian Akhir Semester Tahun $this->tahun_ajaran ";
        }
        $kegiatan = ['Penyerahan soal sudah <u>diketik sendiri</u> (sesuai format terlampir dan sudah ditandatangani Kaprodi) dikumpulkan di PBM paling lambat.',
        'Penyerahan soal <u>digandakan sendiri</u> paling lambat (bentuk soal tidak boleh lewat internet dan jumlah soal 26 lembar/soal)',
        $ujian,
        'Entri Nilai di SIA',
        'Rapat Evaluasi',
        'Rapat Evaluasi Mahasiswa Tingkat 1,2,3 dan 4',
        'Pengumuman Peserta Uji Ulang I',
        'Pelaksanaan Uji Ulang I',
        'Pengumuman Uji Ulang II',
        'Pelaksanaan Uji Ulang II',
        'Yudisium mahasiswa Tingkat 1,2,3 dan 4'];
        $data['kegiatan'] = $kegiatan[$id];

        $data['kode'] = $id;
        $data['tgl'] = $this->agenda_model->cekKegiatan($kegiatan[$id],$this->semester,$this->tahun_ajaran)->row_array();
        // $tgl = $this->input->post('tgl',TRUE);
        

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
       
        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('agenda/edit',$data);
			$this->load->view('templates/footer');
        }
        else{
            $this->agenda_model->editData($kegiatan[$id],$this->semester,$this->tahun_ajaran);
            // ('nama session', 'isinya apa')
            $this->session->set_flashdata('flash','Panitia Ujian Berhasil Ditambahkan');
            redirect('agenda');
        }
    }
   
}