<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panitia_ujian extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('Panitia_ujian_model');

        //validasi jika user belum login
        if($this->session->userdata('nip') != TRUE){
            if($this->session->userdata('jabatan') != "Mahasiswa"){
                redirect('auth');
            }
        }
    }


    public function index(){
        $data['title'] = 'Daftar Panitia Ujian';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $data['panitia_ujian'] = $this->Panitia_ujian_model->tampilAll();

        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }

        $cek = $this->db->query("select * from panitia_ujian where semester='$semester' AND tahun_ajaran='$tahun_ajaran'")->num_rows();

        $data['cek1'] = $this->Panitia_ujian_model->tampilKabid($semester,$tahun_ajaran)->num_rows();
        $data['cek2'] = $this->Panitia_ujian_model->tampilSekretaris($semester,$tahun_ajaran)->num_rows();
        $data['cek3'] = $this->Panitia_ujian_model->tampilSeksiTempat($semester,$tahun_ajaran)->num_rows();
        $data['cek4'] = $this->Panitia_ujian_model->tampilKoorSPDJ($semester,$tahun_ajaran)->num_rows();
        $data['cek5'] = $this->Panitia_ujian_model->tampilKoorSNDP($semester,$tahun_ajaran)->num_rows();
        $data['cek6'] = $this->Panitia_ujian_model->tampilPA($semester,$tahun_ajaran)->num_rows();
        $data['cek7'] = $this->Panitia_ujian_model->tampilAnggota1($semester,$tahun_ajaran)->num_rows();
        $data['cek8'] = $this->Panitia_ujian_model->tampilAnggota2($semester,$tahun_ajaran)->num_rows();
        $data['cek9'] = $this->Panitia_ujian_model->tampilPembantu($semester,$tahun_ajaran)->num_rows();


        $data['kabid'] = $this->Panitia_ujian_model->tampilKabid($semester,$tahun_ajaran)->row_array();
        $data['sekretaris'] = $this->Panitia_ujian_model->tampilSekretaris($semester,$tahun_ajaran)->row_array();
        $data['st'] = $this->Panitia_ujian_model->tampilSeksiTempat($semester,$tahun_ajaran)->row_array();
        $data['k_spdj'] = $this->Panitia_ujian_model->tampilKoorSPDJ($semester,$tahun_ajaran)->row_array();
        $data['k_sndp'] = $this->Panitia_ujian_model->tampilKoorSNDP($semester,$tahun_ajaran)->row_array();
        $data['pa'] = $this->Panitia_ujian_model->tampilPA($semester,$tahun_ajaran)->result_array();
        $data['a1'] = $this->Panitia_ujian_model->tampilAnggota1($semester,$tahun_ajaran)->result_array();
        $data['a2'] = $this->Panitia_ujian_model->tampilAnggota2($semester,$tahun_ajaran)->result_array();
        $data['pu'] = $this->Panitia_ujian_model->tampilPembantu($semester,$tahun_ajaran)->result_array();
        

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('panitia_ujian/index2',$data);
        $this->load->view('templates/footer');

    }
    
    public function indexBackup(){
        $data['title'] = 'Daftar Panitia Ujian';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $data['panitia_ujian'] = $this->Panitia_ujian_model->tampilAll();

        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');

        $semester = $this->input->post('semester',TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran',TRUE);

        $cek = $this->db->query("select * from panitia_ujian where semester='$semester' AND tahun_ajaran='$tahun_ajaran'")->num_rows();

        $data['cek1'] = $this->Panitia_ujian_model->tampilKabid($semester,$tahun_ajaran)->num_rows();
        $data['cek2'] = $this->Panitia_ujian_model->tampilSekretaris($semester,$tahun_ajaran)->num_rows();
        $data['cek3'] = $this->Panitia_ujian_model->tampilSeksiTempat($semester,$tahun_ajaran)->num_rows();
        $data['cek4'] = $this->Panitia_ujian_model->tampilKoorSPDJ($semester,$tahun_ajaran)->num_rows();
        $data['cek5'] = $this->Panitia_ujian_model->tampilKoorSNDP($semester,$tahun_ajaran)->num_rows();
        $data['cek6'] = $this->Panitia_ujian_model->tampilPA($semester,$tahun_ajaran)->num_rows();
        $data['cek7'] = $this->Panitia_ujian_model->tampilAnggota1($semester,$tahun_ajaran)->num_rows();
        $data['cek8'] = $this->Panitia_ujian_model->tampilAnggota2($semester,$tahun_ajaran)->num_rows();
        $data['cek9'] = $this->Panitia_ujian_model->tampilPembantu($semester,$tahun_ajaran)->num_rows();

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('panitia_ujian/index',$data);
            $this->load->view('templates/footer');
        }
        else{
            if($cek>0){
                $data['kabid'] = $this->Panitia_ujian_model->tampilKabid($semester,$tahun_ajaran)->row_array();
                $data['sekretaris'] = $this->Panitia_ujian_model->tampilSekretaris($semester,$tahun_ajaran)->row_array();
                $data['st'] = $this->Panitia_ujian_model->tampilSeksiTempat($semester,$tahun_ajaran)->row_array();
                $data['k_spdj'] = $this->Panitia_ujian_model->tampilKoorSPDJ($semester,$tahun_ajaran)->row_array();
                $data['k_sndp'] = $this->Panitia_ujian_model->tampilKoorSNDP($semester,$tahun_ajaran)->row_array();
                $data['pa'] = $this->Panitia_ujian_model->tampilPA($semester,$tahun_ajaran)->result_array();
                $data['a1'] = $this->Panitia_ujian_model->tampilAnggota1($semester,$tahun_ajaran)->result_array();
                $data['a2'] = $this->Panitia_ujian_model->tampilAnggota2($semester,$tahun_ajaran)->result_array();
                $data['pu'] = $this->Panitia_ujian_model->tampilPembantu($semester,$tahun_ajaran)->result_array();
    
                $this->load->view('templates/header',$data);
                $this->load->view('templates/topbar',$data);
                $this->load->view('templates/sidebar');
                $this->load->view('panitia_ujian/index2',$data);
                $this->load->view('templates/footer');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Data tidak ditemukan!</div>');

                    redirect('panitia_ujian');
            }
        }
    }

    public function in_tambah(){
        $data['title'] = 'Add Panitia Ujian';

        $data['user'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata('nip')])->row_array();

        $data['pegawai'] = $this->Panitia_ujian_model->tampilAllPegawai();
        $this->load->model('setting_model');
        $data['set'] = $this->setting_model->getSetting();

        $semester = $this->input->post('semester',TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran',TRUE);
        $pegawai = $this->input->post('pegawai',TRUE);
        $jabatan = $this->input->post('jabatan',TRUE);

        $cek1 = $this->db->query("select * from panitia_ujian where semester='$semester' AND tahun_ajaran = '$tahun_ajaran' AND jabatan='$jabatan'")->num_rows();

        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('pegawai', 'Pegawai', 'required');


        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('panitia_ujian/add_panitia');
			$this->load->view('templates/footer');
        }
        else{
            if($jabatan=='Kabid Jurusan'){
                if($cek1==0){
                    $this->Panitia_ujian_model->tambahData();
                    // ('nama session', 'isinya apa')
                    $this->session->set_flashdata('flash','Panitia Ujian Berhasil Ditambahkan');
                    redirect('panitia_ujian');
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal menambahkan! Jabatan Kabid Jurusan telah terisi.</div>');

                    redirect('panitia_ujian/in_tambah');
                }

            }
            else if($jabatan=='Sekretaris'){
                if($cek1==0){
                    $this->Panitia_ujian_model->tambahData();
                    // ('nama session', 'isinya apa')
                    $this->session->set_flashdata('flash','Panitia Ujian Berhasil Ditambahkan');
                    redirect('panitia_ujian');
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal menambahkan! Jabatan Sekretaris telah terisi.</div>');

                    redirect('panitia_ujian/in_tambah');
                }

            }
            else if($jabatan=='Seksi Tempat'){
                if($cek1==0){
                    $this->Panitia_ujian_model->tambahData();
                    // ('nama session', 'isinya apa')
                    $this->session->set_flashdata('flash','Panitia Ujian Berhasil Ditambahkan');
                    redirect('panitia_ujian');
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal menambahkan! Jabatan Seksi Tempat telah terisi.</div>');

                    redirect('panitia_ujian/in_tambah');
                }

            }
            else if($jabatan=='Koordinator Seksi Pelaksana dan Jadwal'){
                if($cek1==0){
                    $this->Panitia_ujian_model->tambahData();
                    // ('nama session', 'isinya apa')
                    $this->session->set_flashdata('flash','Panitia Ujian Berhasil Ditambahkan');
                    redirect('panitia_ujian');
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal menambahkan! Jabatan Koordinator Seksi Pelaksana dan Jadwal telah terisi.</div>');

                    redirect('panitia_ujian/in_tambah');
                }

            }
            else if($jabatan=='Koordinator Seksi Naskah dan Pengepakan'){
                if($cek1==0){
                    $this->Panitia_ujian_model->tambahData();
                    // ('nama session', 'isinya apa')
                    $this->session->set_flashdata('flash','Panitia Ujian Berhasil Ditambahkan');
                    redirect('panitia_ujian');
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Gagal menambahkan! Jabatan Koordinator Seksi Naskah dan Pengepakan telah terisi.</div>');

                    redirect('panitia_ujian/in_tambah');
                }

            }
            else{
                $this->Panitia_ujian_model->tambahData();
                    // ('nama session', 'isinya apa')
                $this->session->set_flashdata('flash','Panitia Ujian Berhasil Ditambahkan');
                redirect('panitia_ujian');
            }
        }
    }

    public function edit($id){
        $data['title'] = 'Edit Panitia Ujian';

        $data['user'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata('nip')])->row_array();

        $data['pegawai'] = $this->Panitia_ujian_model->tampilAllPegawai();

        $data['panitia'] = $this->Panitia_ujian_model->getPanitiaById($id);
        $data['semester'] = ['Ganjil','Genap'];
        $data['jabatan'] = ['Kabid Jurusan','Sekretaris','Pelaksanaan Administrasi','Seksi Tempat','Koordinator Seksi Pelaksana dan Jadwal','Anggota Seksi Pelaksana dan Jadwal','Koordinator Seksi Naskah dan Pengepakan','Anggota Seksi Naskah dan Pengepakan','Pembantu Umum'];

        $semester = $this->input->post('semester',TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran',TRUE);
        $pegawai = $this->input->post('pegawai',TRUE);
        $jabatan = $this->input->post('jabatan',TRUE);

        $cek = $this->db->query("select * from panitia_ujian where id='$id'")->row_array();

        $cek1 = $this->db->query("select * from panitia_ujian where semester='$semester' AND tahun_ajaran = '$tahun_ajaran' AND jabatan='$jabatan'")->num_rows();

        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('pegawai', 'Pegawai', 'required');


        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
			$this->load->view('templates/topbar',$data);
			$this->load->view('templates/sidebar');
			$this->load->view('panitia_ujian/edit_panitia',$data);
			$this->load->view('templates/footer');
        }
        else{
               if($semester==$cek['semester'] && $tahun_ajaran==$cek['tahun_ajaran'] && $jabatan==$cek['jabatan']){
                    $this->Panitia_ujian_model->editData($id);
                    // ('nama session', 'isinya apa')
                    $this->session->set_flashdata('flash','Panitia Ujian Berhasil Diedit');
                    redirect('panitia_ujian');
               }
               else{
                    if($jabatan=='Kabid Jurusan'){
                        if($cek1==0){
                            $this->Panitia_ujian_model->editData($id);
                            // ('nama session', 'isinya apa')
                            $this->session->set_flashdata('flash','Panitia Ujian Berhasil Diedit');
                            redirect('panitia_ujian');
                        }
                        else{
                            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                                Gagal menambahkan! Jabatan Kabid Jurusan telah terisi.</div>');
                                    
                            redirect('panitia_ujian/edit/'.$id);
                        }

                    }
                    else if($jabatan=='Sekretaris'){
                        if($cek1==0){
                            $this->Panitia_ujian_model->editData($id);
                            // ('nama session', 'isinya apa')
                            $this->session->set_flashdata('flash','Panitia Ujian Berhasil Diedit');
                            redirect('panitia_ujian');
                        }
                        else{
                            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                                Gagal menambahkan! Jabatan Sekretaris telah terisi.</div>');
                                    
                            redirect('panitia_ujian/edit/'.$id);
                        }

                    }
                    else if($jabatan=='Seksi Tempat'){
                        if($cek1==0){
                            $this->Panitia_ujian_model->editData($id);
                            // ('nama session', 'isinya apa')
                            $this->session->set_flashdata('flash','Panitia Ujian Berhasil Diedit');
                            redirect('panitia_ujian');
                        }
                        else{
                            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                                Gagal menambahkan! Jabatan Seksi Tempat telah terisi.</div>');
                                    
                            redirect('panitia_ujian/edit/'.$id);
                        }

                    }
                    else if($jabatan=='Koordinator Seksi Pelaksana dan Jadwal'){
                        if($cek1==0){
                            $this->Panitia_ujian_model->editData($id);
                            // ('nama session', 'isinya apa')
                            $this->session->set_flashdata('flash','Panitia Ujian Berhasil Diedit');
                            redirect('panitia_ujian');
                        }
                        else{
                            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                                Gagal menambahkan! Jabatan Koordinator Seksi Pelaksana dan Jadwal telah terisi.</div>');
                                    
                            redirect('panitia_ujian/edit/'.$id);
                        }

                    }
                    else if($jabatan=='Koordinator Seksi Naskah dan Pengepakan'){
                        if($cek1==0){
                            $this->Panitia_ujian_model->editData($id);
                            // ('nama session', 'isinya apa')
                            $this->session->set_flashdata('flash','Panitia Ujian Berhasil Diedit');
                            redirect('panitia_ujian');
                        }
                        else{
                            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                                                                Gagal menambahkan! Jabatan Koordinator Seksi Naskah dan Pengepakan telah terisi.</div>');
                                    
                            redirect('panitia_ujian/edit/'.$id);
                        }
                    }
               }
        }
    }

    public function hapus($id){
         //Jika bukan kajur, maka di redirect
		if($this->session->userdata('jabatan') != 'Kajur'){
            redirect('panitia_ujian');
		}

        $this->Panitia_ujian_model->hapusData($id);
        $this->session->set_flashdata('flash','Berhasil dihapus');
        redirect('panitia_ujian');
    }
}

