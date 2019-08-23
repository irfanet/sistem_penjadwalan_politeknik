<?php

Class Soal_ujian_model extends CI_Model
{    
    public $semester;
    public $tahun_ajaran;

    public function addData($pdf){
        $count = $this->input->post('jml');
        // print_r($_POST['kelas']);
        // $count = count($data['count']);
        for($i = 0; $i<$count; $i++){
            $kelas[$i]=$_POST['kelas'][$i];
        }
        for($i = 0; $i<$count; $i++){ 
            $entries[] = array( 
                'id_pegawai' => $this->session->userdata('id'),
                'kelas' => $kelas[$i],
                'matkul' => $this->input->post('matkul'),
                'semester' => $this->input->post('semester'),
                'tahun_ajaran' => $this->input->post('tahun_ajaran'),
                'soal' => $pdf,
                'penggandaan' => 0
            );
         }
    $this->db->insert_batch('soal_ujian', $entries); 


        // $data = array(
        //     'id_pegawai' => $this->session->userdata('id'),
        //     'kelas' => implode(',',$_POST['kelas']),
        //     'matkul' => $this->input->post('matkul'),
        //     'semester' => $this->input->post('semester'),
        //     'tahun_ajaran' => $this->input->post('tahun_ajaran'),
        //     'soal' => $pdf,
        //     'penggandaan' => 0
        // );

        // $this->db->insert('soal_ujian',$data);
    }

    public function tampilSoal($semester,$tahun_ajaran){
       return $this->db->query("select *,a.id, a.kelas, a.matkul, a.semester, a.tahun_ajaran, a.soal, b.nama_singkat from soal_ujian a left join
                                    pegawai b on a.id_pegawai=b.id where semester='$semester' AND tahun_ajaran='$tahun_ajaran' order by a.id desc")->result_array();
    }

    public function countSoal(){
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        return $this->db->query("select *,a.id, a.kelas, a.matkul, a.semester, a.tahun_ajaran, a.soal, b.nama_singkat from soal_ujian a left join
                                     pegawai b on a.id_pegawai=b.id where semester='$semester' AND tahun_ajaran='$tahun_ajaran' AND penggandaan=0 order by a.id desc");
     }

    public function tampilSoal2($semester,$tahun_ajaran,$id){
        return $this->db->query("select *,a.id, a.kelas, a.matkul, a.semester, a.tahun_ajaran, a.soal, b.nama_singkat from soal_ujian a left join
                                     pegawai b on a.id_pegawai=b.id where semester='$semester' AND tahun_ajaran='$tahun_ajaran' AND a.id_pegawai='$id' order by a.id desc")->result_array();
     }

    
     public function getById($id){
        return $this->db->query("select *,a.id, a.kelas, a.matkul, a.semester, a.tahun_ajaran, a.soal, b.nama_singkat from soal_ujian a left join
        pegawai b on a.id_pegawai=b.id where a.id='$id'")->row_array();
     }

     public function ubahData($pdf){
        $data = array(
            'kelas' => $this->input->post('kelas'),
            'matkul' => $this->input->post('matkul'),
            'semester' => $this->input->post('semester'),
            'tahun_ajaran' => $this->input->post('tahun_ajaran'),
            'soal' => $pdf,
            'penggandaan' => $this->input->post('penggandaan')
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('soal_ujian',$data);
    }

    public function hapusData($id){
		$this->db->where('id',$id);
        $query = $this->db->get('soal_ujian');
        $row = $query->row();
   
        if($row->soal != ' '){
            unlink("./assets/upload/$row->soal");
        }
   
        $this->db->delete('soal_ujian', array('id' => $id));
    }
    public function getMatkul(){
        $this->getSet();    
        $nama=$this->session->userdata('nama');
        return $this->db->query("SELECT * FROM pengampu WHERE pengampu='$nama' 
        AND semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'
        GROUP BY makul")->result();
    }
    public function get_kelas($id){
        $this->getSet();
        $nama=$this->session->userdata('nama');
        // $hasil=$this->db->query("SELECT kelas FROM pengampu WHERE makul='$id' AND  pengampu='$nama' ");
        $hasil=$this->db->query("SELECT kelas FROM pengampu WHERE makul='$id' AND pengampu='$nama'
        AND semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' 
        AND kelas NOT IN(SELECT kelas FROM soal_ujian where semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran') ");
        return $hasil->result();
    }
    public function get_notif(){
        $this->getSet();
        $nama=$this->session->userdata('nama');
        return $this->db->query("SELECT * FROM pengampu WHERE kelas NOT IN 
        (SELECT kelas FROM soal_ujian where semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran') 
        AND pengampu='$nama' 
        AND semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'
        GROUP BY makul")->result();        
    }
    public function count_notif(){
        $this->getSet();
        $nama=$this->session->userdata('nama');
        return $this->db->query("SELECT * FROM pengampu WHERE kelas NOT IN 
        (SELECT kelas FROM soal_ujian where semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran') 
        AND pengampu='$nama' 
        AND semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'
        GROUP BY makul ");        
    }
    public function get_notif_kelas(){
        $this->getSet();
        $nama=$this->session->userdata('nama');
        return $this->db->query("SELECT * FROM pengampu WHERE kelas NOT IN 
        (SELECT kelas FROM soal_ujian where semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran') 
        AND semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' 
        AND pengampu='$nama'")->result();          
    }
    // public function get_notif_kelas2(){
    //     $nama=$this->session->userdata('nama');
    //     return $this->db->query("SELECT * FROM pengampu WHERE kelas IN ('$kls') AND pengampu='$nama'  ")->result();        
    // }
    public function getSet()
    {
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->semester = $semester;
        $this->tahun_ajaran = $tahun_ajaran;
        // return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);
    
    }
    public function getNotUploadedYet(){
        $this->getSet();
        return $this->db->query("SELECT * FROM pegawai a 
        INNER JOIN pengampu b ON a.nama_singkat=b.pengampu 
        -- LEFT JOIN soal_ujian c ON a.id = c.id_pegawai
        WHERE b.semester='$this->semester' AND b.tahun_ajaran='$this->tahun_ajaran'
        AND (makul,kelas) NOT IN (SELECT matkul,kelas FROM soal_ujian WHERE semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' )");

    }
    public function getUploaded(){
        $this->getSet();
        return $this->db->query("SELECT * FROM pegawai a 
        INNER JOIN pengampu b ON a.nama_singkat=b.pengampu 
        WHERE b.semester='$this->semester' AND b.tahun_ajaran='$this->tahun_ajaran'
        AND (makul,kelas) IN (SELECT matkul,kelas FROM soal_ujian WHERE semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' )");

    }

}