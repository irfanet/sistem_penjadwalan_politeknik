<?php 

    foreach ($querydosen as $linedosen){
      //printf ("ID: %s  Name: %s<br>", $linedosen[0], $linedosen["nama_singkat"]);
      
  //}
       		       
      	//Beginning Buffer to save PHP variables and HTML tags
      	// ob_start();   	
      	
        //  echo linedosen['nama_lengkap'];
?>

      <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
      <html>
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <title></title>
      </head>

      <body>
      <form>

      <table width="683" height="65" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="125" rowspan="4" align="center"><img src="<?= base_url();?>assets/img/polines2.png" width="97" height="101"></td>
            <td width="395" rowspan="4" align="center"><div class="style1">
              <p><strong>JADWAL PENGAWAS UJIAN AKHIR <br>
      SEMESTER GANJIL <br>
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
      <br><br>  
      <table width="533" height="49" border="0"  cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
        <tr>
          <td width="100" height="24" >Nama</td>
          <td width="25" >:</td>
        
          <td width="300" ><?php echo $linedosen['nama_lengkap']; ?></td>
          <td width="122" align="center">&nbsp;</td>
        </tr>
       
        <tr>
          <td height="23" >Prodi</td>
          <td >:</td>
          <td ><?php echo $linedosen['namaprodi']; ?></td>
          <td >&nbsp;</td>
        </tr>
      </table>
      <h4><?php echo "Detail Jadwal Pengawas :" ?></h4>       
      <table width="687" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF" >
        <tr height="150">
          <td width="32" align="center" bgcolor="#E6E6FA"><b>No</b></td>
          <td width="200" align="center" bgcolor="#E6E6FA"><b>Hari/Tanggal</b> </td>
          <td width="137" align="center" bgcolor="#E6E6FA"><b>Jam </b></td>
          <td width="180" align="center" bgcolor="#E6E6FA"><b>Mata kuliah </b></td>
          <td width="126" align="center" bgcolor="#E6E6FA"><b>Ruang </b></td>
        </tr>        
        <?php
        $no=0;
        foreach ($queryPerDosen as $linePerDosen)  {
          if($linePerDosen['pengawas'] == $linedosen['nama_singkat']){
          $no++;        
      ?>
        <tr fontsize="11px">
          <td width="32" align="center"><?php echo $no; ?></td>
         
          <td width="200"><?php echo $linePerDosen['haritanggal']; ?></td>
          <td width="137" align="center"><?php echo $linePerDosen['jam']; ?></td>
          <td width="180" align="center"><?php echo $linePerDosen['makul']; ?></td>
          <td width="126" align="center"><?php echo $linePerDosen['ruang']; ?></td>
        </tr>
        <?php
          
      } //akhir dari per dosen
    }
        ?>
        
      </table>
      <br>  
      <pagebreak />
      

      
<?php
      // $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
      // ob_end_clean();
  //exit;
  } //akhir dari query dosen

?>

</body>
</html>
