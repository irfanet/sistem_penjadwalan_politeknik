<?php 


class Agenda_model extends CI_Model {
    public function tampilAll($semester,$tahun_ajaran){
        // return $this->db->get('agenda');
         return $this->db->query("select * from agenda where semester='Ganjil' AND tahun_ajaran='2019/2020'");
    }
    public function getAgenda($tgl){
         return $this->db->query("select * from agenda where tgl='$tgl'");
    }

    public function tambahData($kegiatan,$semester,$tahun_ajaran){
        $tgl = $this->input->post('tgl',TRUE);
        $date = str_replace('/', '-', $tgl );
        $tgl = date("Y-m-d", strtotime($date));

        $tgl2 = $this->input->post('tgl_akhir',TRUE);
        $date2 = str_replace('/', '-', $tgl2 );
        $tgl2 = date("Y-m-d", strtotime($date2));
        $data = array(
            'kegiatan' => $kegiatan,
            'tgl' => $tgl,
            'tgl_akhir' => $tgl2,
            'semester' => $semester,
            'tahun_ajaran' => $tahun_ajaran  
        );

        $this->db->insert('agenda',$data);
    }

    public function editData($kegiatan,$semester,$tahun_ajaran){
        $tgl = $this->input->post('tgl',TRUE);
        $date = str_replace('/', '-', $tgl );
        $tgl = date("Y-m-d", strtotime($date));

        $tgl2 = $this->input->post('tgl_akhir',TRUE);
        $date2 = str_replace('/', '-', $tgl2 );
        $tgl2 = date("Y-m-d", strtotime($date2));

        $data = array(
            'kegiatan' => $kegiatan,
            'tgl' => $tgl,
            'tgl_akhir' => $tgl2,
            'semester' => $semester,
            'tahun_ajaran' => $tahun_ajaran  
        );

        $this->db->where('kegiatan', $kegiatan);
        $this->db->update('agenda',$data);
    }
    public function cekKegiatan($kegiatan,$semester,$tahun_ajaran){
        return $this->db->query("select * from agenda where kegiatan='$kegiatan' AND semester='$semester' AND tahun_ajaran='$tahun_ajaran'");
    }
    public function tampil($kegiatan,$semester,$tahun_ajaran){
        return $this->db->query("select * from agenda where semester='$semester' AND tahun_ajaran='$tahun_ajaran'")->row_array();
        
    }


}