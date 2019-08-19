<div id="content">
  	<!-- Flashdata -->
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>  
      <?php if($this->session->flashdata('flash')): ?>
      
		
    <?php endif; ?>
    <?php
     $fields = $this->db->list_fields('ruang_kelas');
     $i=0;
     foreach ($fields as $field)
     {
      //  if($i!=0)
      $desc[$i]=$field;
      //  echo $desc[$i];
       $i++;
     }
    ?>
		<!-- Akhir Flasdata  -->
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>ruang_kelas">Ruang Kelas</a>
						</li>
						<li class="current">
							<a href="#" title="">Import Ruang Kelas</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>IMPORT RUANG KELAS</h3>
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<!--=== Full Size Inputs ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Form Import Ruang Kelas</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post" action='<?=base_url("ruang_kelas/import")?>' enctype="multipart/form-data">
										
									<div class="form-group">
                  <label class="col-md-2 control-label">File Ruang Ujian <span class="required">*</span></label>
										<div class="col-md-8">
                      <input type="file" name="file" accept=".csv" class="required" data-style="fileinput"  data-inputsize="medium" required=""></small>
                      <p class="help-block">CSV only (csv/*)</p>
											<label for="file" class="has-error help-block" generated="true" style="display:none;"></label>
                    </div>
									</div>
									
                    <div class="form-group">
											<label class="col-md-2 control-label"></label>
											<button type="submit" name="import" class="btn btn-primary">Simpan</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--Forms -->
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

    </div>
    <?php
  if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      die; // stop skrip
    }
    
    // Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='".base_url("ruang_kelas/import")."'>";
    
    // Buat sebuah div untuk alert validasi kosong
    echo "<div style='color: red;' id='kosong'>
    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum terisi semua.
    </div>";
    
    echo "<table border='1' cellpadding='8'>
    <tr>
      <th colspan='5'>Preview Data</th>
    </tr>
    <tr>
      <th>NIS</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Alamat</th>
    </tr>";
    
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di csv
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
      // START -->
      // Skrip untuk mengambil value nya
      $cellIterator = $row->getCellIterator();
      $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
      
      $get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
      foreach ($cellIterator as $cell) {
        array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
      }
      // <-- END
      
      // Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
      $nis = $get[0]; // Ambil data NIS
      $nama = $get[1]; // Ambil data nama
      $jenis_kelamin = $get[2]; // Ambil data jenis kelamin
      $alamat = $get[3]; // Ambil data alamat
      
      // Cek jika semua data tidak diisi
      if($nis == "" && $nama == "" && $jenis_kelamin == "" && $alamat == "")
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
      
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
        $jk_td = ( ! empty($jenis_kelamin))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
        $alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
        
        // Jika salah satu data ada yang kosong
        if($nis == "" or $nama == "" or $jenis_kelamin == "" or $alamat == ""){
          $kosong++; // Import 1 variabel $kosong
        }
        
        echo "<tr>";
        echo "<td".$nis_td.">".$nis."</td>";
        echo "<td".$nama_td.">".$nama."</td>";
        echo "<td".$jk_td.">".$jenis_kelamin."</td>";
        echo "<td".$alamat_td.">".$alamat."</td>";
        echo "</tr>";
      }
      
      $numrow++; // Import 1 setiap kali looping
    }
    
    echo "</table>";
    
    // Cek apakah variabel kosong lebih dari 0
    // Jika lebih dari 0, berarti ada data yang masih kosong
    if($kosong > 0){
    ?>  
      <script>
      $(document).ready(function(){
        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
        
        $("#kosong").show(); // Munculkan alert validasi kosong
      });
      </script>
    <?php
    }else{ // Jika semua data sudah diisi
      echo "<hr>";
      
      // Buat sebuah tombol untuk mengimport data ke database
      echo "<button type='submit' name='import'>Import</button> ";
      echo "<a href='".base_url("index.php/Siswa")."'>Cancel</a>";
    }
    
    echo "</form>";
  }
  ?>
</body>
</html>
