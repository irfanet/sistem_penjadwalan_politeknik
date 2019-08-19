<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_ujian extends CI_Controller {

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
        $data['title'] = 'My Schedule';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
        $data['mine'] = 1;

        $data['jadwal_ujian'] = $this->Jadwal_ujian_model->tampilJadwalSaya();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('jadwal_ujian/index',$data);
        $this->load->view('templates/footer');
    }

    public function indexBackup(){
        $data['title'] = 'Daftar Jadwal Ujian';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $data['jadwal_ujian'] = $this->Jadwal_ujian_model->tampilJadwalSaya();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('jadwal_ujian/index',$data);
        $this->load->view('templates/footer');
    }

    public function getAll(){
        $data['title'] = 'Daftar Jadwal Ujian';
           
        if($this->session->userdata('jabatan')=='mahasiswa'){
            $data['jadwal_ujian'] = $this->Jadwal_ujian_model->tampilJadwalKelas($this->session->userdata('kelas'));
        }else{
            $data['jadwal_ujian'] = $this->Jadwal_ujian_model->tampilAll();
        }
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
        $data['mine'] = 0;


        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('jadwal_ujian/index',$data);
        $this->load->view('templates/footer');
    }


    public function index_myschedule($id){
        $data['title'] = 'My Schedule';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');

        $semester = $this->input->post('semester',TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran',TRUE);
        $nama = $this->session->userdata('nama');

        $cek = $this->db->query("select * from jadwal where semester='$semester' AND tahun_ajaran='$tahun_ajaran' AND pengawas='$nama'")->num_rows();
        $data['cek'] = $this->db->query("select * from jadwal where semester='$semester' AND tahun_ajaran='$tahun_ajaran' AND pengawas='$nama'")->num_rows();

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('jadwal_ujian/my_schedule',$data);
            $this->load->view('templates/footer');
        }
        else{
            if($cek>0){
                $data['jadwal_ujian'] = $this->Jadwal_ujian_model->tampilJadwalSaya();

                $this->load->view('templates/header',$data);
                $this->load->view('templates/topbar',$data);
                $this->load->view('templates/sidebar');
                $this->load->view('jadwal_ujian/my_schedule2',$data);
                $this->load->view('templates/footer');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Data tidak ditemukan!</div>');

                redirect('jadwal_ujian/index_myschedule/'.$id);
            }
        }
    }

    public function in_tambah($id){
         //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('jadwal_ujian');
		}

        $data['title'] = 'Tambah Jadwal Ujian';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $user = $this->db->get_where('pegawai', ['nip' =>$this->session->userdata('nip')])->row_array();

        // Get Ruang Kelas
        $this->load->model('Ruang_kelas_model');
        $data['ruang_kelas'] = $this->Ruang_kelas_model->tampilAll();  

        //  Get mata Kuliah
        $this->load->model('Matkul_model');
        $data['matkul'] = $this->Matkul_model->tampilAllMatkul();

        //  Get Kelas
        $this->load->model('Kelas_model');
        $data['kelas'] = $this->Kelas_model->tampilAllKelas();

        // Get dosen
        if($user['jabatan']=='Kajur'){
            $data['pegawai'] = $this->Jadwal_ujian_model->tampilAllPegawai();
        }
        else{
            $data['pegawai'] = $this->Jadwal_ujian_model->tampilPegawaiById($id);
        }
        
    
        // ('nama input','alias','rules')
        $this->form_validation->set_rules('no_absen', 'No Absen', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('jadwal_ujian/add_jadwal_ujian',$data);
            $this->load->view('templates/footer');
        }
        else{
            $tanggal = $this->input->post('tgl_ujian',TRUE);
            $dsn1 = $this->input->post('dosen_pengawas1',TRUE);
            $dsn2 = $this->input->post('dosen_pengawas2',TRUE);
            $jam_kelas = $this->input->post('jam_kelas',TRUE);
            
            $cek_utama_ngawas1 = $this->db->query("select * from jadwal_ujian where tgl_ujian = '$tanggal' AND jam_kelas = '$jam_kelas' AND dosen_pengawas1 = '$dsn1' ")->num_rows();
            $cek_cadangan_ngawas1 = $this->db->query("select * from jadwal_ujian where tgl_ujian = '$tanggal' AND jam_kelas = '$jam_kelas' AND dosen_pengawas2 = '$dsn1' ")->num_rows();

            $cek_utama_ngawas2 = $this->db->query("select * from jadwal_ujian where tgl_ujian = '$tanggal' AND jam_kelas = '$jam_kelas' AND dosen_pengawas1 = '$dsn2' ")->num_rows();
            $cek_cadangan_ngawas2 = $this->db->query("select * from jadwal_ujian where tgl_ujian = '$tanggal' AND jam_kelas = '$jam_kelas' AND dosen_pengawas2 = '$dsn2' ")->num_rows();


            if($dsn1 == $dsn2){
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                           Gagal menambahkan! Tidak boleh memasukan nama pengawas yang sama di satu waktu.</div>');
                            
                redirect('jadwal_ujian/in_tambah/'.$id);
            }
            else{
                if($cek_utama_ngawas1<1){
                    if($cek_cadangan_ngawas1<1){
                        if($cek_utama_ngawas2<1){
                            if($cek_cadangan_ngawas2<1){
                                $this->Jadwal_ujian_model->tambahData();
                                $this->session->set_flashdata('flash','Jadwal Ujian Berhasil Ditambahkan');
                                
                                redirect('jadwal_ujian');
                            }
                            else{
                                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                               Gagal menambahkan! Jadwal pengawas cadangan bentrok dengan jam yang anda pilih.</div>');
                                
                                redirect('jadwal_ujian/in_tambah/'.$id);
                            }
                        }
                        else{
                            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                               Gagal menambahkan! Jadwal pengawas cadangan bentrok dengan jam yang anda pilih.</div>');
                        
                            redirect('jadwal_ujian/in_tambah/'.$id);
                        }
                       
                    }
                    else{
                        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                        Gagal menambahkan! Jadwal pengawas utama bentrok dengan jam yang anda pilih.</div>');
    
                        redirect('jadwal_ujian/in_tambah/'.$id);
                    }
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal menambahkan! Jadwal pengawas utama bentrok dengan jam yang anda pilih.</div>');
    
                    redirect('jadwal_ujian/in_tambah/'.$id);
                }
            }
            
        }
  }

    public function in_edit($id){
         //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('jadwal_ujian');
		}

        $data['title'] = 'Edit Jadwal Ujian';

        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $data['jadwal_ujian'] = $this->Jadwal_ujian_model->getDataById($id);
        $data['semester'] = array('Ganjil','Genap');
        $data['jam_kelas'] = array('pagi','siang');
        $kd_jadwal_ujian = $this->input->post('id',TRUE);

        // Get Ruang Kelas
        $this->load->model('Ruang_kelas_model');
        $data['ruang_kelas'] = $this->Ruang_kelas_model->tampilAll();  

        //  Get mata Kuliah
        $this->load->model('Matkul_model');
        $data['matkul'] = $this->Matkul_model->tampilAllMatkul();

        //  Get Kelas
        $this->load->model('Kelas_model');
        $data['kelas'] = $this->Kelas_model->tampilAllKelas();

        // Get 
        $this->load->model('Pegawai_model');
        $data['pegawai'] = $this->Pegawai_model->tampilAllPegawai();
        

        // ('nama input','alias','rules')
        $this->form_validation->set_rules('no_absen', 'No Absen', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('jadwal_ujian/edit_jadwal_ujian',$data);
            $this->load->view('templates/footer');
        }
        else{
            $tanggal = $this->input->post('tgl_ujian',TRUE);
            $dsn1 = $this->input->post('dosen_pengawas1',TRUE);
            $dsn2 = $this->input->post('dosen_pengawas2',TRUE);
            $jam_kelas = $this->input->post('jam_kelas',TRUE);

            $cek_utama_ngawas1 = $this->db->query("select * from jadwal_ujian where tgl_ujian = '$tanggal' AND jam_kelas = '$jam_kelas' AND dosen_pengawas1 = '$dsn1' ")->num_rows();
            $cek_cadangan_ngawas1 = $this->db->query("select * from jadwal_ujian where tgl_ujian = '$tanggal' AND jam_kelas = '$jam_kelas' AND dosen_pengawas2 = '$dsn1' ")->num_rows();

            $cek_utama_ngawas2 = $this->db->query("select * from jadwal_ujian where tgl_ujian = '$tanggal' AND jam_kelas = '$jam_kelas' AND dosen_pengawas1 = '$dsn2' ")->num_rows();
            $cek_cadangan_ngawas2 = $this->db->query("select * from jadwal_ujian where tgl_ujian = '$tanggal' AND jam_kelas = '$jam_kelas' AND dosen_pengawas2 = '$dsn2' ")->num_rows();


            if($dsn1 == $dsn2){
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                           Gagal menambahkan! Tidak boleh memasukan nama pengawas yang sama di satu waktu.</div>');
                            
                redirect('jadwal_ujian/in_edit/'.$id);
            }
            else{
                if($cek_utama_ngawas1<1){
                    if($cek_cadangan_ngawas1<1){
                        if($cek_utama_ngawas2<1){
                            if($cek_cadangan_ngawas2<1){
                                $this->Jadwal_ujian_model->editData($id);
                                $this->session->set_flashdata('flash','Jadwal Ujian Berhasil Ditambahkan');
                                
                                redirect('jadwal_ujian');
                            }
                            else{
                                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                               Gagal menambahkan! Jadwal pengawas cadangan bentrok dengan jam yang anda pilih.</div>');
                                
                                redirect('jadwal_ujian/in_edit/'.$id);
                            }
                        }
                        else{
                            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                               Gagal menambahkan! Jadwal pengawas cadangan bentrok dengan jam yang anda pilih.</div>');
                        
                                redirect('jadwal_ujian/in_edit/'.$id);
                        }
                       
                    }
                    else{
                        $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                        Gagal menambahkan! Jadwal pengawas utama bentrok dengan jam yang anda pilih.</div>');
    
                        redirect('jadwal_ujian/in_edit/'.$id);
                    }
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal menambahkan! Jadwal pengawas utama bentrok dengan jam yang anda pilih.</div>');
    
                    redirect('jadwal_ujian/in_edit/'.$id);
                }
            }
        }
    }

  public function hapus($id){
     //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') == 'Dosen'){
            redirect('jadwal_ujian');
		}

    $this->Jadwal_ujian_model->hapusData($id);
    $this->session->set_flashdata('flash','Berhasil dihapus');
    redirect('jadwal_ujian');
  }

}