<?php 
// error_reporting(E_ALL ^ E_NOTICE);

    if(!$queryHari){
      echo "Data belum ada";
    }else{
    foreach ($queryHari as $lineHari) {

      //printf ("ID: %s  Name: %s<br>", $lineHari[0], $lineHari["nama_singkat"]);
      
  //}
                 
        //Beginning Buffer to save PHP variables and HTML tags
      // ob_start();     
      // $nama_dokumen = "Pengawas Cadangan"
        
        //  echo linedosen['nama_lengkap'];
?>

      <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
      <html>
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <title><?= $nama_dokumen?></title>
      </head>

      <body>
      <form>

      <table width="683" height="65" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="125" rowspan="4" align="center"><img src="<?= base_url();?>assets/img/polines2.png" width="97" height="101"></td>
            <td width="395" rowspan="4" align="center"><div class="style1">
              <p><strong>
      PENGAWAS CADANGAN <br>UJIAN <?= $ujian?> SEMESTER<br>
      <?= $stat_tahun?>
              </strong></p>
              </div></td>
            <td width="71" height="33">No. FPM</td>
            <td width="80">7.5.21/L6</td>
          </tr>
          <tr>
            <td height="32"> Revisi</td>
            <td>2</td>
          </tr>
          <tr>
            <td height="32">Tanggal</td>
            <td>1 Juli 2010 </td>
          </tr>
          <tr>
            <td height="32">Halaman</td>
            <td>1/1</td>
          </tr>
      </table>
      <br>  
      <table width="533" height="49" border="0"  cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
        <tr>
          <td width="100" height="" >Jurusan</td>
          <td width="25" >:</td>
        
          <td width="300" >Teknik Elektro</td>
          <td width="122" align="center">&nbsp;</td>
        </tr>
       
        <tr>
          <td height="" >Hari/Tanggal</td>
          <td >:</td>
          <td ><?php echo $lineHari['semester']; ?></td>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td height="" >Jam</td>
          <td >:</td>
          <td ><?php echo $lineHari['tahun_ajaran']; ?></td>
          <td >&nbsp;</td>
        </tr>
      </table>
      <br>  
      <table width="687" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF" style="font-family: Mono; font-size: 10pt; ">
        <tr height="150">
          <td style="font-family: Arial; font-size: 10pt;height: 50px;" width="32" align="center" bgcolor="#E6E6FA"><b>No</b></td>
          <td style="font-family: Arial; font-size: 10pt;" width="200" align="center" bgcolor="#E6E6FA"><b>Nama Pengawas</b> </td>
          <td style="font-family: Arial; font-size: 10pt;height: 50px;" width="32" align="center" bgcolor="#E6E6FA"><b>Prodi</b></td>
          <td style="font-family: Arial; font-size: 10pt;" width="126" align="center" bgcolor="#E6E6FA"><b>Tanda Tangan </b></td>
        </tr>        
        <?php
      $sqlPerHari = "SELECT panitia.nama_singkat, nama_lengkap, id_prodi 
      from pengawas_cadangan panitia inner join pegawai dosen on panitia.nama_singkat=dosen.nama_singkat 
      where panitia.semester='".$lineHari['semester']."' and panitia.tahun_ajaran='".$lineHari['tahun_ajaran']."'
      and panitia.nama_singkat NOT IN 
      (SELECT distinct(pengawas) as nama_singkat FROM jadwal inner join pengawas_cadangan on pengawas=nama_singkat 
      inner join pegawai dosen on pengawas=dosen.nama_singkat 
      where CONCAT(haritanggal,'+',jam)='".$lineHari['harijamtes']."' 
      and jadwal.semester='".$lineHari['semester']."' and jadwal.tahun_ajaran='".$lineHari['tahun_ajaran']."'
      and pengawas_cadangan.semester='".$lineHari['semester']."' and pengawas_cadangan.tahun_ajaran='".$lineHari['tahun_ajaran']."') LIMIT 12";
      $no=0;
      $queryPerHari = $this->db->query($sqlPerHari);
      if ($queryPerHari->num_rows() > 0) {
		    foreach ($queryPerHari->result_array() as $linePerHari)  {
    
          
          //$line = mysql_fetch_array($query);
    
        $no++;
            ?>
              <tr>
                <td style="height:30px;border-bottom: 0px none white;" width="32" align="center"><?php echo $no; ?></td>        
                <td style="padding-left:5pt;border-bottom: 0px none white;"><?php echo $linePerHari['nama_lengkap']; ?></td>                
                <td style="height:30px;border-bottom: 0px none white;" width="32" align="center"><?=$linePerHari['prodi']?></td>
                <td style="border-bottom: 0px none white" align="center" align="center">&nbsp;</td>
              </tr>

        
        <?php      
        }
      } //akhir dari per harijamtes
        ?>
        
      </table>
      <br>  
      
<?php

?>
<table>
<tr>
<td width="673">&nbsp;</td>
</tr>
</table>
<table width="714" border="0">
  <tr>
    <td width="50">&nbsp;</td>
    <td width="215">&nbsp;</td>
    <td width="150">&nbsp;</td>
    <td width="250"><?=$lineHari['haritanggal'];?> </td>
    <td width="20">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Mengetahui </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Ketua Jurusan Teknik Elektro, </td>
    <td>&nbsp;</td>
    <td>Kabid. Jurusan Teknik Elektro, </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Dr. Amin Suharjono, S.T., M.T.<br>NIP.197210271990031002</td>
    <td>&nbsp;</td>  
    <td>YUSNAN BADRUZZAMAN, S.T., M.Eng.<br>NIP.197503132006041001</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>  
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<pagebreak />
<?php

        //} //akhir dari while linedosen
      //exit;
      
  } //akhir dari query dosen
    }

?>

</body>
</html>
