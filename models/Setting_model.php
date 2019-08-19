<?php

Class Setting_model extends CI_Model{

    public function getSetting(){
        $this->db->where('id',1);
        return $this->db->get('setting')->result();
    }
    public function tambahData(){
        $data = array(
            'id' => 1,
            'semester' => $this->input->post('semester',TRUE),
            'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE)
        );

        $this->db->insert('setting',$data);
    }
    public function updateData(){
        $data = array(
            'semester' => $this->input->post('semester',TRUE),
            'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE)
        );

        $this->db->where('id', 1);
        $this->db->update('setting',$data);
    }
    public function getSet()
    {
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);
    
    }

}
