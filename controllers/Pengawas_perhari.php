<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Pengawas_perhari extends CI_Controller {
    private $stat_tahun;
    private $semester;
    private $tahun_ajaran;
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Pengawas_perhari_model');
        $this->load->model('setting_model');

        //validasi jika user belum login
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

        // if($semester=='Genap'){
        //     $this->ujian = "AKHIR";
        //     $this->stat = "SEMESTER GENAP";
        // }else{
        //     $this->ujian = "TENGAH";
        //     $this->stat = "SEMESTER GANJIL";
        // }
        $tahun = str_replace("/"," - ",$tahun_ajaran);
        $this->stat_tahun = "TAHUN AKADEMIK $tahun";
    }
    public function index()
    {
        $data['title'] = 'Pengawas Per Hari';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();
        
        // $this->load->model('Prodi_model');
        $data['jdwl'] = $this->Pengawas_perhari_model->opt_jadwal();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('pengawas_perhari/index',$data);
        $this->load->view('templates/footer');
    }
    public function hasil()
    {
        $post = $this->input->post();
        $tinggiBaris = 40;
        $jenis = $post["keperluan"];
        $hariJamTes = $post["hariJamTes"];  
        $data['tinggiBaris'] = $tinggiBaris;
        $data['stat_tahun'] = $this->stat_tahun;
        // $this->load->model('setting_model');
        // $set = $this->setting_model->getSetting();
        // foreach($set as $hasil){
        //   $semester = $hasil->semester;
        //   $tahun_ajaran = $hasil->tahun_ajaran;
        // }

        $data['semester']=$this->semester;
        $data['tahun_ajaran']=$this->tahun_ajaran;
        if($jenis=="pengawas"){
            $data['lHari'] = $this->Pengawas_perhari_model->filterPengawas();
            $alamat = 'pengawas_perhari/pengawas';
            if($hariJamTes=="All"){
                $cetakBanyak = True;
                $nama_dokumen='Cetak Pengawas Per Hari';
            }else{
                $cetakBanyak = False;
                $nama_dokumen='Cetak Pengawas Per Hari - '.$hariJamTes.' ( Pengawas )';
            }
        }else{
            $data['lHari'] = $this->Pengawas_perhari_model->filterPengganti();
            $alamat = 'pengawas_perhari/pengganti';
            if($hariJamTes=="All"){
                $cetakBanyak = True;
                $nama_dokumen='Cetak Pengawas Per Hari';
            }else{
                $cetakBanyak = False;
                $nama_dokumen='Cetak Pengawas Per Hari - '.$hariJamTes.' ( Pengganti )';
            }
        }
        
         // $data['lHari'] = $this->Pengawas_perhari_model->filterPengawas();
         $mpdf = new \Mpdf\Mpdf();
         if($cetakBanyak){
            $mpdf->AddPage();
          }
         $html = $this->load->view($alamat,$data,true);
         $mpdf->WriteHTML($html);
         $mpdf->Output($nama_dokumen.".pdf" ,'I');

    }
    
             
            
}
            
    /* End of file  Pengawas_perhari.php */
        
                            