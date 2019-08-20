<?php 
	       
      	//Beginning Buffer to save PHP variables and HTML tags
      	ob_start();   	
      	
        //  echo linedosen['nama_lengkap'];
?>

      <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
      <html>
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <title>print Cek Kesesuaian Jadwal</title>
      </head>

      <body>
      <form>

      <table width="683" height="65" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="125" rowspan="4" align="center"><img src="<?= base_url();?>assets/img/polines2.png" width="97" height="101"></td>
            <td width="395" rowspan="4" align="center"><div class="style1">
              <p><strong>KESESUAIAN JADWAL <br>
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
      
      <h4>List yang perlu di cek / kurang pas :</h4>
      <ul>
        <li>Cek nama makul di jadwal apakah sudah sesuai dengan tabel pengampu</li>
        <li>Cek spasi</li>
        <li>Hilangkan tanda "&" pada nama matakuliah atao tambahkan fungsi htmlentities untuk menghilangkan tag html</li>
      </ul>

      <table width="687" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF" >
        <tr height="150">
          <td width="32" align="center" bgcolor="#E6E6FA"><b>No</b></td>
          <td width="200" align="center" bgcolor="#E6E6FA"><b>Makul</b> </td>
          <td width="100" align="center" bgcolor="#E6E6FA"><b>Kelas </b></td>
          <td width="180" align="center" bgcolor="#E6E6FA"><b>Pengampu </b></td>
          <td width="126" align="center" bgcolor="#E6E6FA"><b>Kunci </b></td>
        </tr>        
        <?php
      
      // $querydosen = mysql_query("SELECT * FROM `pengampu` where kunci NOT IN (select concat(makul,'-',kelas) as kunci from jadwal)");    
      $no=0;
      // while ($linedosen = mysql_fetch_array($querydosen, MYSQL_BOTH)) {
        foreach($querydosen as $linedosen){
        $no++;

      ?>
        <tr fontsize="11px">
          <td width="32" align="center"><?php echo $no; ?></td>
         
          <td width="200"><?php echo $linedosen['makul']; ?></td>
          <td width="137" align="center"><?php echo $linedosen['kelas']; ?></td>
          <td width="180" align="center"><?php echo $linedosen['pengampu']; ?></td>
          <td width="126" align="center"><?php echo $linedosen['kunci']; ?></td>
        </tr>
      <?php
      }
      ?>
        
      </table>
      <br>  
      

      


</body>
</html>
