<?php

Class Rekapan_perhari_model extends CI_Model{

    public function tampilGroupByHari($haritanggal,$semester,$tahun_ajaran){
        return $this->db->query("select * from jadwal where haritanggal='$haritanggal' and semester='$semester' and tahun_ajaran='$tahun_ajaran' order by haritanggal asc")->result_array();
    }
    public function getPerhari($semester,$tahun_ajaran){
        return $this->db->query("select haritanggal from jadwal where semester='$semester' and tahun_ajaran='$tahun_ajaran' group by haritanggal order by id asc")->result_array();
    }

}