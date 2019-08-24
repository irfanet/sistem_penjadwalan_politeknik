<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Cetak extends CI_Controller {

    private $semester;
    private $tahun_ajaran;
    private $ujian;
    private $stat;
    private $stat_tahun;
    public function __construct(){
        parent::__construct();
        
        $this->load->model('Cetak_model');
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

        if($semester=='Genap'){
            $this->ujian = "AKHIR";
            $this->stat = "SEMESTER GENAP";
        }else{
            $this->ujian = "AKHIR";
            $this->stat = "SEMESTER GANJIL";
        }
        $tahun = str_replace("/"," - ",$tahun_ajaran);
        $this->stat_tahun = "TAHUN AKADEMIK $tahun";
    }

    public function index()
    {   
            
    }
    public function pengampuDanJadwal(){
        $nama_dokumen = "Pengampu dan Jadwal";
        // $data['ujian'] = $this->ujian;
        $data['stat'] = $this->stat;
        $data['stat_tahun'] = $this->stat_tahun;

        $data['querydosen'] = $this->Cetak_model->prcekpengampudanjadwal();
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('cetak/prcekpengampudanjadwal',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }
    public function jadwalPerDosen(){
        $nama_dokumen = "Cetak Jadwal Per Dosen";
        $data['ujian'] = $this->ujian;
        $data['stat'] = $this->stat;
        $data['stat_tahun'] = $this->stat_tahun;

        $data['querydosen'] = $this->Cetak_model->prjadwalperdosen();
        $data['queryPerDosen'] = $this->Cetak_model->jadwalperdosen();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage();
        $html = $this->load->view('cetak/prjadwalperdosen',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }
    public function pengambilanBerkas(){
        $nama_dokumen = "Cetak Pengambilan Berkas LJU";
        $data['stat_tahun'] = $this->stat_tahun;
        $data['queryPengampu'] = $this->Cetak_model->prpengambilanberkas();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage();
        $html = $this->load->view('cetak/prpengambilanberkas',$data,true);
        $mpdf->WriteHTML($html);
        // $mpdf->setFooter('{PAGENO}');
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }
    public function pengawasCadanganPerHari(){
        error_reporting(E_ALL ^ E_NOTICE);
        $nama_dokumen = "Cetak Pengawas Cadangan Per Hari";
        $data['ujian'] = $this->ujian;
        // $data['stat'] = $this->stat;
        $data['stat_tahun'] = $this->stat_tahun;
        
        $data['queryHari'] = $this->Cetak_model->prpengawascadanganperhari();
        // $data['queryPerHari'] = $this->Cetak_model->pengawascadanganperhari();
        $mpdf = new \Mpdf\Mpdf();
       
        $html = $this->load->view('cetak/prpengawascadanganperhari',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->AddPage();
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }
    public function honorPerDosen(){
        $nama_dokumen = "Cetak Honor Per Dosen";
        $data['ujian'] = $this->ujian;
        $data['stat'] = $this->stat;
        $data['stat_tahun'] = $this->stat_tahun;

        $data['querydosen'] = $this->Cetak_model->prjadwalperdosen();
        $data['queryPerDosen'] = $this->Cetak_model->jadwalperdosen();
        $dosen =  $this->Cetak_model->prjadwalperdosen(); 
        foreach($dosen as $d){
            $id = $d['id'];
            $makul[$id] = $this->Cetak_model->cekSoal($id,$this->semester,$this->tahun_ajaran)->num_rows();
            $kelas[$id] = $this->Cetak_model->cekKelas($id,$this->semester,$this->tahun_ajaran)->num_rows();
        }
        $data['makul'] = $makul;
        $data['kelas'] = $kelas;
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage();
        $html = $this->load->view('cetak/honorjadwalperdosen',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }
    public function denahruang(){
        error_reporting(E_ALL ^ E_NOTICE);
        $nama_dokumen = "Ruang Ujian";
        $data['ujian'] = $this->ujian;
        $data['stat'] = $this->stat;
        $data['stat_tahun'] = $this->stat_tahun;

        $data['queryHari'] = $this->Cetak_model->denahruang();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage();
        $html = $this->load->view('cetak/denahruang',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
    }
    public function indexAmplop(){
        $data['title'] = 'Amplop Ujian';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        $this->load->model('cetak_model');
        $this->load->model('Rekapan_perhari_model');
        $data['perHari'] = $this->Rekapan_perhari_model->getPerhari($this->semester,$this->tahun_ajaran);
        
        // $data['queryHari'] = $this->Cetak_model->getAmplop($this->semester,$this->tahun_ajaran)->result_array();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('cetak/index_amplop', $data);
        $this->load->view('templates/footer');

    }
    public function cetakAmplop(){
        $this->load->model('cetak_model');
        $post = $this->input->post();
        $haritanggal = $post["haritanggal"];

        $nama_dokumen = "Cetak Amplop";
        $data['nama_dokumen'] = $nama_dokumen;
        $data['ujian'] = $this->ujian;
        $data['stat'] = $this->stat;
        $data['stat_tahun'] = $this->stat_tahun;

        
        $data['queryHari'] = $this->Cetak_model->getAmplop($haritanggal,$this->semester,$this->tahun_ajaran)->result_array();
        $html = $this->load->view('cetak/amplop', $data);

        $mpdf = new \Mpdf\mPDF();
        $mpdf->AddPage('L'); // margin footer
        $html = $this->load->view('cetak/amplop', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output($nama_dokumen.".pdf", 'I'); // view in the explorer

        $data['queryHari'] = $this->Cetak_model->getAmplop($haritanggal,$this->semester,$this->tahun_ajaran)->result_array();
        // $this->load->view('cetak/amplop', $data);
    }
    
}
        
    /* End of file  cetak.php */
        
                            