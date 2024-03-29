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
        $sqlPerDosen = $this->db->query("SELECT *,a.id as id_jadwal FROM jadwal a 
        inner join pegawai b on a.pengawas=b.nama_singkat 
        inner join matkul c on a.makul=c.makul
        WHERE a.semester='$this->semester' AND a.tahun_ajaran='$this->tahun_ajaran'
        AND c.semester='$this->semester' AND c.tahun_ajaran='$this->tahun_ajaran'
        AND c.status=1 order by a.id");
        return $sqlPerDosen->result_array();
    }
    public function prpengambilanberkas()
    {
        $this->getSet();
        $queryPengampu = $this->db->query("SELECT * FROM jadwal a inner join pengampu b on CONCAT(a.makul,'-',a.kelas) = b.kunci 
        inner join pegawai c on c.nama_singkat=b.pengampu
        inner join matkul d on a.makul=d.makul 
        WHERE a.semester='$this->semester' AND a.tahun_ajaran='$this->tahun_ajaran'
        AND b.semester='$this->semester' AND b.tahun_ajaran='$this->tahun_ajaran'
        AND d.semester='$this->semester' AND d.tahun_ajaran='$this->tahun_ajaran'
        AND d.status = 1
        order by c.nama_lengkap, a.makul, a.kelas, a.kelompok");
        return $queryPengampu->result_array();
    }
    public function prpengambilanberkasBackup()
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
        $queryHari = $this->db->query("SELECT *,haritanggal, CONCAT(haritanggal,'+',jam) as harijamtes, jam FROM `jadwal`  
        WHERE semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' group by harijamtes order by id");
        return $queryHari->result_array();
    }
    public function pengawascadanganperhari()
    {
        $this->getSet();
        $sqlPerHari = $this->db->query("SELECT a.nama_singkat, nama_lengkap, id_prodi 
        from pengawas_cadangan a inner join pegawai b on a.nama_singkat=b.nama_singkat 
        where a.nama_singkat 
        AND a.semester='$this->semester' AND a.tahun_ajaran='$this->tahun_ajaran'
        NOT IN (SELECT distinct(a.pengawas) as nama_singkat, CONCAT(a.haritanggal,'+',a.jam) as kunci FROM jadwal a 
        inner join pengawas_cadangan b on a.pengawas=b.nama_singkat 
        inner join pegawai c on a.pengawas=c.nama_singkat 
        where a.semester!='$this->semester' AND a.tahun_ajaran!='$this->tahun_ajaran'
        AND b.semester!='$this->semester' AND b.tahun_ajaran!='$this->tahun_ajaran' ) LIMIT 12");
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
    public function getAmplop($tgl,$semester,$tahun_ajaran){
        return $this->db->query("SELECT * FROM jadwal a
        INNER JOIN pengampu b ON CONCAT(a.makul,'-',a.kelas) =  b.kunci
        INNER JOIN pegawai c ON b.pengampu = c.nama_singkat
        INNER JOIN prodi d ON c.id_prodi = d.kode
        INNER JOIN matkul e ON a.makul = e.makul 
        WHERE a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' 
        AND b.semester='$semester' AND b.tahun_ajaran='$tahun_ajaran'
        AND e.status=1 
        AND haritanggal='$tgl'");
    }
    public function honorPembuatanSoal($semester,$tahun_ajaran){
        // return $this->db->query("SELECT * FROM pengampu a  
        // INNER JOIN pegawai b ON a.pengampu=b.nama_singkat
        // INNER JOIN soal_ujian c ON b.id=c.id_pegawai
        // INNER JOIN matkul d ON a.makul = d.makul
        // WHERE a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' 
        // AND c.semester='$semester' AND c.tahun_ajaran='$tahun_ajaran'
        // AND d.semester='$semester' AND d.tahun_ajaran='$tahun_ajaran'
        // AND d.status=1
        // GROUP BY b.makul");
        return $this->db->query("SELECT * FROM soal_ujian a
        INNER JOIN pegawai b ON a.id_pegawai=b.id 
        WHERE semester='$semester' AND tahun_ajaran='$tahun_ajaran'");
    }
    public function cekSoal($id,$semester,$tahun_ajaran){
        return $this->db->query("SELECT * FROM soal_ujian 
        WHERE id_pegawai='$id' AND semester='$semester' AND tahun_ajaran='$tahun_ajaran'
        GROUP BY matkul");
    }
    public function cekKelas($id,$semester,$tahun_ajaran){
        return $this->db->query("SELECT * FROM soal_ujian 
        WHERE id_pegawai='$id' AND semester='$semester' AND tahun_ajaran='$tahun_ajaran'");
    }
    public function jadwalPerProdi($prodi,$semester,$tahun_ajaran){
        $this->db->select('*');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'jadwal.makul = matkul.makul');
        $this->db->where('jadwal.semester', $semester)->where('jadwal.tahun_ajaran', $tahun_ajaran)
        ->where('matkul.semester', $semester)->where('matkul.tahun_ajaran', $tahun_ajaran)->where('matkul.status',1);
        return $this->db->get()->result();
    }
}
                        
/* End of file cetak.php */
