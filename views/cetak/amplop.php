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
      <title> </title>
      <style>
        .biru{
          color : #249F9F;
        }
        .margin{
          margin-left: 20px;
        }
        @page {
        padding:10px; // As your need
        }
        .print_area {
          text-decoration: bold;
          border:2px solid #000000;
        }


      </style>
      </head>

      <body>
      <form>
      <div class="print_area">
      <table width="100%" height="140" border="1" cellpadding="5" cellspacing="0"  bordercolor="#000000">
          <tr>
            <td width="125" align="center"><img src="<?= base_url();?>assets/img/logo_polines.png" width="97" height="101">
        <br><strong><h4> POLITKENIK<br>
        NEGRERI SEMARANG</h4></strong></td>
            <td width="395" rowspan="2" align="center"><div class="style1">
              <h2><strong>
      PANITIA <br>
      UJIAN AKHIR <?=$stat?> <?= $stat_tahun?> <br>
      POLITKENIK NEGRERI SEMARANG
              </strong></h2>
              </div></td>
          </tr>
      </table>
      <br>  
      <!-- <div align="right"><h1 class="biru"><?= $lineHari['kelompok']?></h1></div> -->
   
      <div align="center">
      <table width="100%">
        <tr>
          <th width='50%' colspan="2"></th>
          <th width='50%' colspan="2" align="right"><h1 class="biru"><?= $lineHari['kelompok']?></h1></th>
        </tr>
        <tr>
          <td>MATA KULIAH </td>
          <td>: <?= $lineHari['makul']?></td>
          <td>PROGRAM STUDI</td>
          <td>: <span style="color:#249F9F;"><?= $lineHari['nama']?></span></td>
        </tr>
        <tr>
          <td>PENGAMPU </td>
          <td>: <?= $lineHari['pengampu']?></td>
          <td>RUANG</td>
          <td>: <?= $lineHari['ruang']?></td>
        </tr>
        <tr>
          <td>KELAS </td>
          <td>: <?= $lineHari['kelas']?></td>
          <td>PUKUL </td>
          <td>: <?= $lineHari['jam']?></td>
        </tr>
        <tr>
          <td>HARI / TANGGAL </td>
          <td>: <?= $lineHari['haritanggal']?></td>
          <td>PENGAWAS </td>
          <td>: 1. <?= $lineHari['pengawas']?> </td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td>  2. ....................</td>
        </tr>
      </table>
       <br>
       <br>
       <br>
       <table>
        <tr>
          <td>ISI </td>
          <td>: </td>
          <td>1. Soal
          <td>: 12 Lembar
        </tr>
        <tr>
          <td  rowspan="4"></td>
          <td> </td>
          <td>2. Lembar Jawab
          <td>: 12 Lembar
        </tr>
        <tr>
          <td> </td>
          <td>3. Daftar Hadir
          <td>: 1 Lembar
        </tr>
        <tr>
          <td> </td>
          <td>4. Daftar Nilai
          <td>: 1 Lembar
        </tr>
        <tr>
          <td> </td>
          <td>4. Daftar Acara
          <td>: 1 Lembar
        </tr>
      </table>
      </div>
      <br>  
      <!-- <table width="687" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF" style="font-family: Mono; font-size: 10pt; "> -->
    
      <!-- </table> -->
    
      <table>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </table>
</div>
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
