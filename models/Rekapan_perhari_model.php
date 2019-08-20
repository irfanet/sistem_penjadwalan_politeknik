<?php

Class Rekapan_perhari_model extends CI_Model{

    public function tampilGroupByHari($semester,$tahun_ajaran){
        return $this->db->query("select * from jadwal where semester='$semester' and tahun_ajaran='$tahun_ajaran' order by haritanggal asc")->result_array();
    }
}