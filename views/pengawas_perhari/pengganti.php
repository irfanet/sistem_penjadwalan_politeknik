<?php 



 /* $queryHari = mysql_query("SELECT haritanggal, jam, CONCAT(haritanggal,'+',jam) as harijamtes FROM `jadwal` group by harijamtes ORDER BY jam,jadwal.id ASC");*/
  //$nama_dokumen='Cetak Pengganti Per Hari'; //Beri nama file PDF hasil.          
        //  echo linedosen['nama_lengkap'];
        
      foreach($lHari as $lineHari){  
       		       
        //Beginning Buffer to save PHP variables and HTML tags
        ob_start();   	
?>

      <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
      <html>
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <title>print jadwal per dosen</title>
      </head>

      <body>
      <form>

      <table width="683" height="65" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="125" rowspan="4" align="center"><img src="<?= base_url();?>assets/img/polines2.png" width="97" height="101"></td>
            <td width="395" rowspan="4" align="center"><div class="style1">
              <p><strong>PENGAMBILAN DAN PENYERAHAN<br>
      BERKAS UJIAN OLEH PENGAWAS <br>
      TAHUN AKADEMIK 2018 - 2019
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
          <td ><?php echo $lineHari['haritanggal']; ?></td>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td height="" >Jam</td>
          <td >:</td>
          <td ><?php echo $lineHari['jam']; ?></td>
          <td style="font-weight:bold; font-size:12pt; color:#FFFFFF;background-color:#000000;" align="center">&nbsp;PENGGANTI</td>
        </tr>
      </table>
      <br>  
      <table width="687" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF" style="font-family: Mono; font-size: 10pt; ">
        <tr height="150">
          <td style="font-family: Arial; font-size: 10pt;" width="32" align="center" bgcolor="#E6E6FA"><b>No</b></td>
          <td style="font-family: Arial; font-size: 10pt;" width="170" align="center" bgcolor="#E6E6FA"><b>Nama Pengawas</b> </td>
          <td style="font-family: Arial; font-size: 10pt;" width="250" align="center" bgcolor="#E6E6FA"><b>Mata kuliah </b></td>
          <td style="font-family: Arial; font-size: 10pt;" width="20" align="center" bgcolor="#E6E6FA"><b>Jml Amplop </b></td>
          <td style="font-family: Arial; font-size: 10pt;" width="120" align="center" bgcolor="#E6E6FA"><b>Nama </b></td>
          <td style="font-family: Arial; font-size: 10pt;" width="100" align="center" bgcolor="#E6E6FA"><b>Pengambilan </b></td>
          <td style="font-family: Arial; font-size: 10pt;" width="100" align="center" bgcolor="#E6E6FA"><b>Pengembalian </b></td>
        </tr>        
        <?php
      $sqlPerHari = "SELECT a.id,haritanggal, jam, makul, pengawas, kelas, ruang, kelompok, b.nama_lengkap as nama_lengkap, CONCAT(haritanggal,'+',jam) as harijamtes FROM jadwal a inner join pegawai b on pengawas=nama_singkat  
      WHERE CONCAT(haritanggal,'+',jam)='".$lineHari['harijamtes']."' 
      AND semester='$semester' AND tahun_ajaran='$tahun_ajaran' 
      order by nama_lengkap, a.id";

    
          //$line = mysql_fetch_array($query);
      $no=0;
      $query = $this->db->query($sqlPerHari);
      if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $linePerHari)  
      {
           //printf ("Makul: %s  Kelas: %s<br>", $linePerHari["makul"], $linePerHari["kelas"]);
          //fungsi tapi tidak dipakai menghitung jumlah row span
          /*$sqlCekDuaKelas = "SELECT count(pengawas) as jml, b.nama_lengkap as nama_lengkap, CONCAT(haritanggal,'+',jam) as harijamtes FROM jadwal a inner join dosen b on pengawas=nama_singkat WHERE CONCAT(haritanggal,'+',jam)='".$linePerHari['harijamtes']."' AND pengawas='".$linePerHari['pengawas']."' Order by nama_lengkap, a.id  ";

          $queryCekDuaKelas = mysql_query($sqlCekDuaKelas) or die('Query failed:' . mysql_error());
          $dataCekDuaKelas = mysql_fetch_row($queryCekDuaKelas);
          $jmlRowSpan = $dataCekDuaKelas[0];*/

          

          //if($jmlRowSpan>1){
            if($namaSebelumnya!=$linePerHari['nama_lengkap']){
              $no++;
            ?>
              <tr>
                <td style="height:<?=$tinggiBaris?>px; border-bottom: 0px none white;" width="32" align="center"><?php echo $no; ?></td>        
                <td style="padding-left:5pt;border-bottom: 0px none white;"><?php echo $linePerHari['nama_lengkap']; ?></td>
                <td align="center"><?php echo $linePerHari['makul']." (".$linePerHari['kelas'].")" ?></td>
                <td style="border-bottom: 0px none white" align="center">1</td>
                <td style="border-bottom: 0px none white" align="center"></td>
                <td style="border-bottom: 0px none white" align="center">&nbsp;</td>
                <td style="border-bottom: 0px none white" align="center" align="center">&nbsp;</td>
              </tr>
          <?php
            }else{
              ?>
              <tr>
                <td style="height:<?=$tinggiBaris?>px;border-top: 0px none white"></td>        
                <td style="border-top: 0px none white"></td>
                <td align="center"><?php echo $linePerHari['makul']." (".$linePerHari['kelas'].")" ?></td>
                <td style="border-top: 0px none white" align="center"></td>
                <td style="border-top: 0px none white" align="center"></td>
                <td style="border-top: 0px none white" align="center"></td>
                <td style="border-top: 0px none white" align="center"></td>
              </tr>
          <?php
            }
          //}
      ?>

        
        <?php
        $namaSebelumnya = $linePerHari['nama_lengkap'];
        
      } //akhir dari per dosen
    }
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
    <td width="250">Semarang, <?=explode(',',$lineHari['haritanggal'])[1];?> </td>
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
    
<?php
    //   $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
    //   ob_end_clean();
      // LOAD a stylesheet
      //$stylesheet = file_get_contents('mpdfstyletables.css');
      //$mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
      //Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
     /* $footer = '
        <htmlpagefooter name="myHTMLFooterOdd" style="display:none">
        <div style="background-color:#E6E6FA; font-size:8pt;" align="center"><b>&nbsp;{PAGENO}&nbsp;</b></div>
        </htmlpagefooter>        
        <sethtmlpagefooter name="myHTMLFooterOdd" page="O" value="on" show-this-page="1" />';
      //$mpdf->WriteHTML($footer);
      */
      //$mpdf->WriteHTML('<pagebreak sheet-size="Letter" />');

    //   $mpdf->WriteHTML(utf8_encode($html));
      //$mpdf->WriteHTML('<pagebreak sheet-size="Letter" />');
    //   if($cetakBanyak){
    //     $mpdf->AddPage();
    //   }
        //} //akhir dari while linedosen
      //exit;
  } //akhir dari query dosen

//   $mpdf->Output($nama_dokumen.".pdf" ,'I');
//   mysql_free_result($querydosen);

?>

</body>
</html>
