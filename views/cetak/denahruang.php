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
      JADWAL RUANGAN UJIAN AKHIR <br>
      <?= $stat?> <br>
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
          <td height="" >Ruang</td>
          <td >:</td>
          <td ><?php echo $lineHari['nama']; ?></td>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td height="" >Kelompok</td>
          <td >:</td>
          <td ><?php echo $lineHari['kelompok']; ?></td>
          <td >&nbsp;</td>
        </tr>
      </table>
      <br>  
      <!-- <table width="687" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF" style="font-family: Mono; font-size: 10pt; "> -->
        <?php 
        if($lineHari['kelompok']=='1 - 12'){?>
            <img src="<?= base_url();?>assets/img/ruang_ujian/1-12.jpg">
            
        <?php } elseif($lineHari['kelompok']=='13 - 24'){ ?>
            <img src="<?= base_url();?>assets/img/ruang_ujian/13-24.jpg">
        <?php } else{
            echo 'data tidak ditemukan , cek atribut kelompok pada tabel ruang kelas';
        }?>
      <!-- </table> -->
      <br>  
 
<pagebreak />
<?php

        //} //akhir dari while linedosen
      //exit;
      
  } //akhir dari query dosen
    }

?>

</body>
</html>
