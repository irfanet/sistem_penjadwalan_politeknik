<?php

Class Rekapan_perhari_model extends CI_Model{

    public function tampilGroupByHari($haritanggal,$semester,$tahun_ajaran){
        return $this->db->query("select * from jadwal a
        inner join matkul b ON a.makul=b.makul
        where a.haritanggal='$haritanggal' 
        and a.semester='$semester' and a.tahun_ajaran='$tahun_ajaran' 
        and b.semester='$semester' and b.tahun_ajaran='$tahun_ajaran' 
        and b.status = 1
        order by a.id asc")->result_array();
    }
    public function tampilGroupByHariNull($haritanggal,$semester,$tahun_ajaran){
        return $this->db->query("select * from jadwal a
        inner join matkul b ON a.makul=b.makul
        where a.haritanggal='$haritanggal' 
        and a.semester='$semester' and a.tahun_ajaran='$tahun_ajaran' 
        and b.semester='$semester' and b.tahun_ajaran='$tahun_ajaran' 
        and b.status = 1 and a.absensi is null
        order by a.id asc")->result_array();
    }
    public function tampilGroupByHariK($absen,$haritanggal,$semester,$tahun_ajaran){
        return $this->db->query("select * from jadwal a
        inner join matkul b ON a.makul=b.makul
        where a.haritanggal='$haritanggal' 
        and a.semester='$semester' and a.tahun_ajaran='$tahun_ajaran' 
        and b.semester='$semester' and b.tahun_ajaran='$tahun_ajaran' 
        and b.status = 1 and a.absensi = '$absen'
        order by a.id asc")->result_array();
    }
    public function getTgl($haritanggal,$semester,$tahun_ajaran){
        return $this->db->query("select * from jadwal a
        inner join matkul b ON a.makul=b.makul
        where a.haritanggal='$haritanggal' 
        and a.semester='$semester' and a.tahun_ajaran='$tahun_ajaran' 
        and b.semester='$semester' and b.tahun_ajaran='$tahun_ajaran' 
        and b.status = 1
        order by a.id asc");
    }
    public function getPerhari($semester,$tahun_ajaran){
        return $this->db->query("select haritanggal from jadwal where semester='$semester' and tahun_ajaran='$tahun_ajaran' group by haritanggal order by id asc")->result_array();
    }

}