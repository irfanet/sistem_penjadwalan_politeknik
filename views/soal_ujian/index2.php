<div id="content">
		<!-- Flashdata -->
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>  
		<?php if($this->session->flashdata('flash')): ?>
		
		<?php endif; ?>
		<!-- Akhir Flasdata  -->
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Dashboard</a>
						</li>
						<li class="current">
							<a href="#" title="">Daftar Soal Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR SOAL UJIAN</h3>
						<a href="<?= base_url(); ?>soal_ujian/in_tambah" class="btn btn-primary" style="float:ceter;"> Tambah Data</a>
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>DAFTAR DOSEN BELUM UPLOAD SOAL</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable datatable">
									<thead>
										<tr>
											<th width="90">No</th>
											<th>Nip</th>
											<th>Nama</th>
											<th>Mata Kuliah</th>
											<th>Kelas</th>
											<th>Jabatan</th>
											<!-- <th>Status</th> -->
											<!-- <th>Digandakan</th> -->
										</tr>
									</thead>
									<tbody>
									<?php $no=1; foreach($belumUpload as $n){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $n['nip']; ?></td>
											<td><?= $n['nama_singkat']; ?></td>
											<td><?= $n['makul']; ?></td>
											<td><?= $n['kelas']; ?></td>
											<td><?= $n['jabatan']; ?></td>
											<!-- <td class="text-center">
												<?php 
													$id = $n['id'];
													$tampung = 0;
													foreach($cekk as $c){
														if($c['id_pegawai']==$id){
															$tampung++;
														}
													}

													if($tampung==0){
														echo '<i class="icon-remove" style="color:red"></i>';
													}
													else{
														echo '<i class="icon-ok" style="color:green"></i>';
													}
												?>
											</td> -->
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<table>
									<tr>
										<td><b>Jumlah</b></td>
										<td>: <b><?= $no-1?></b></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>

				<!-- Row 2 -->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>DAFTAR DOSEN YANG SUDAH UPLOAD SOAL</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable datatable">
									<thead>
										<tr>
											<th width="90">No</th>
											<th>Dosen</th>
											<th>Mata Kuliah</th>
											<th>Kelas</th>
											<th>Semester</th>
											<th>Tahun Ajaran</th>
											<th>File</th>
											<th>Penggandaan</th>
											<th width="170">Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php $no=1; foreach($soal as $m){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $m['nama_singkat']; ?></td>
											
											<td><?= $m['matkul'] ?></td>
											<td><?= $m['kelas'] ?></td>
											<td><?= $m['semester'] ?></td>
											<td><?= $m['tahun_ajaran'] ?></td>
											<td><a href="<?= base_url(); ?>soal_ujian/lakukan_download/<?= $m['soal']; ?>"><i class="icon-download-alt"></i>Soal</a></td>
											<td class="text-center"><?php if($m['penggandaan']==0){
													echo '<i class="icon-remove" style="color:red"></i>';
												}
												else{
													echo '<i class="icon-ok" style="color:green"></i>';
												}
											 ?></td>
											<td class="text-center">
													<a href="<?= base_url(); ?>soal_ujian/edit/<?= $m['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
													<a href="<?= base_url(); ?>soal_ujian/hapus/<?= $m['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<table>
									<tr>
										<td><b>Jumlah</b></td>
										<td>: <b><?= $no-1?></b></td>
									</tr>
								</table>
								
							</div>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>