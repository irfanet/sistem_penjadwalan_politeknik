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
				<!-- Row 2 -->
				<div class="row">
					<div class="col-md-12">
					
					<?php foreach($notif as $alert){
						?>
						  

					
					<div class="alert alert-warning fade in">
									<i class="icon-remove close" data-dismiss="alert"></i>
									<strong>Segera Upload Soal ! </strong> <?= $alert->makul.'';?> 
									<p class="pull-right">
									<?php foreach($kelas as $kls) {
							  		 if($kls->makul==$alert->makul){
										  echo ' [ '.$kls->kelas.' ]  ';
									}
								}
									?></p>
									</div>
					<?php }  ?>
					
					<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> DAFTAR SOAL UJIAN</h4>
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
											<td><?= $m['kelas'] ?>
											<!-- <?php
											$makul=$m['matkul'];
											$kls = $m['kelas'];
											$nama=$this->session->userdata('nama');
											$sql = $this->db->query("SELECT kelas as kls FROM pengampu WHERE kelas NOT IN ('$kls') AND makul='$makul' AND pengampu='$nama'");
											foreach ($sql->result() as $row){
											echo '('.$row->kls.') ';
											}
										?> -->
										</td>
											<td><?= $m['semester'] ?></td>
											<td><?= $m['tahun_ajaran'] ?></td>
											<td><a href="<?= base_url(); ?>soal_ujian/lakukan_download/<?= $m['soal']; ?>"><i class="icon-download-alt"></i>Soal</a></td>
											<td class="text-center"><?php if($m['penggandaan']==0){
													echo '<i class="icon-remove"></i>';
												}
												else{
													echo '<i class="icon-ok"></i>';
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
							</div>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>