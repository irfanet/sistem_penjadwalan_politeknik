<?php

use phpDocumentor\Reflection\Types\Array_;

defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_model extends CI_Model
{
    public $semester;
    public $tahun_ajaran;

 
    public function getGolonganByNama($nama){
        return $this->db->query("select golongan from pegawai where nama_singkat='$nama'");
    }
    public function prcekpengampudanjadwal()
    {
        $this->getSet();
        $querydosen =  $this->db->query("SELECT * FROM `pengampu` 
        where kunci NOT IN (select concat(makul,'-',kelas) as kunci from jadwal WHERE semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran')
        AND  semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'");
        return $querydosen->result_array();
    }
    public function prjadwalperdosen()
    {
        $this->getSet();
        $querydosen = $this->db->query("SELECT a.id, a.nama_singkat, a.nama_lengkap,a.golongan, a.id_prodi, c.nama as namaprodi FROM pegawai a left join prodi c on a.id_prodi=c.kode 
        WHERE id_prodi IS NOT NULL 
        -- AND a.semester='$this->semester' AND a.tahun_ajaran='$this->tahun_ajaran' 
        order by c.id, a.nama_lengkap");
        return $querydosen->result_array();
    }
    public function jadwalperdosen()
    {
        $this->getSet();
        $sqlPerDosen = $this->db->query("SELECT *,a.id as id_jadwal FROM jadwal a inner join pegawai b on a.pengawas=b.nama_singkat WHERE a.semester='$this->semester' AND a.tahun_ajaran='$this->tahun_ajaran' order by a.id");
        return $sqlPerDosen->result_array();
    }
    public function prpengambilanberkas()
    {
        $this->getSet();
        $queryPengampu = $this->db->query("SELECT * FROM jadwal inner join pengampu on CONCAT(jadwal.makul,'-',jadwal.kelas) = pengampu.kunci 
    inner join pegawai on pegawai.nama_singkat=pengampu.pengampu 
    WHERE jadwal.semester='$this->semester' AND jadwal.tahun_ajaran='$this->tahun_ajaran'
    order by pegawai.nama_lengkap, jadwal.makul, jadwal.kelas, jadwal.kelompok");
        return $queryPengampu->result_array();
    }
    public function prpengawascadanganperhari()
    {
        $this->getSet();
        $queryHari = $this->db->query("SELECT haritanggal, CONCAT(haritanggal,'+',jam) as harijamtes, jam FROM `jadwal`  WHERE semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' group by harijamtes order by id");
        return $queryHari->result_array();
    }
    public function pengawascadanganperhari()
    {

        $sqlPerHari = $this->db->query("SELECT panitia.nama_singkat, nama_lengkap, id_prodi 
        from pengawas_cadangan panitia inner join pegawai dosen on panitia.nama_singkat=dosen.nama_singkat 
        where panitia.nama_singkat NOT IN 
        (SELECT distinct(pengawas) as nama_singkat, CONCAT(haritanggal,'+',jam) as kunci FROM jadwal inner join pengawas_cadangan on pengawas=nama_singkat 
        inner join pegawai dosen on pengawas=dosen.nama_singkat) LIMIT 12");
        return $sqlPerHari->result_array();


    }
    public function denahruang()
    {
        $sql = $this->db->query('SELECT * FROM ruang_kelas');
        return $sql->result_array();
    }
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

    public function countDone(){
        $this->load->model('cetak_model');
        $data['querydosen'] = $this->cetak_model->prjadwalperdosen();
        $data['queryPerDosen'] = $this->cetak_model->jadwalperdosen();

        $dosen = $this->cetak_model->prjadwalperdosen();
        $jadwal = $this->cetak_model->jadwalperdosen();
        $num=0;
        foreach($dosen as $d){
            $id = $d['id'];
            $nama = $d['nama_singkat'];
            $data['total'][$id] = $this->cetak_model->countAbsensiDosen($nama)->num_rows();
            $data['temp'][$id] = $this->cetak_model->countNullAbsen($nama)->num_rows();
            if(($data['temp'][$id]==0 && $data['total'][$id]==0) || $data['temp'][$id]==0){
                $num++;
            }     
        }
        return $num;
    }
    public function countJadwalDosen()
    {
        // $this->getSet();
        $querydosen = $this->db->query("SELECT a.id, a.nama_singkat, a.nama_lengkap, a.id_prodi, c.nama as namaprodi FROM pegawai a left join prodi c on a.id_prodi=c.kode WHERE id_prodi IS NOT NULL order by c.id, a.nama_lengkap");
        return $querydosen;
    }
    public function countAbsensiDosen($dosen)
    {
        $this->getSet();
        $sqlPerDosen = $this->db->query("SELECT *,a.id as id_jadwal FROM jadwal a inner join pegawai b on a.pengawas=b.nama_singkat WHERE a.semester='$this->semester' AND a.tahun_ajaran='$this->tahun_ajaran'
        AND a.pengawas='$dosen' order by a.id");
        return $sqlPerDosen;
    }
    public function countNullAbsen($dosen)
    {
        $this->getSet();
        $sqlPerDosen = $this->db->query("SELECT *,a.id as id_jadwal FROM jadwal a inner join pegawai b on a.pengawas=b.nama_singkat 
        WHERE a.semester='$this->semester' AND a.tahun_ajaran='$this->tahun_ajaran'
        AND a.pengawas='$dosen' AND a.absensi IS NULL order by a.id");
        return $sqlPerDosen;
    }
}
                        
/* End of file cetak.php */
