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
							<a href="#" title="">Daftar Jadwal Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR JADWAL UJIAN</h3>
						<?php if($this->session->userdata('jabatan') != 'Dosen'){ ?>
						<a href="<?= base_url(); ?>jadwal_ujian/in_tambah/<?= $user['id_prodi']; ?>" class="btn btn-primary"> Tambah Data</a>
						<?php } ?>
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
								<h4><i class="icon-reorder"></i> DAFTAR JADWAL UJIAN</h4>
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
											<th width="70">No</th>
											<th>Haritanggal</th>
											<th>Jam</th>
											<th>Makul</th>
											<th>Pengawas</th>
											<th>Kelas</th>
											<th>Ruang</th>
											<th>Kelompok</th>
											<th>Kehadiran</th>
											<!-- <th width="70">Semester</th> -->
											<!-- <th>Tahun Ajaran</th> -->
											<!-- <?php if($this->session->userdata('jabatan') != 'Dosen'){ ?>
											<th width="70">Aksi</th>
											<?php } ?> -->
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach($jadwal_ujian as $data){ 
										echo "<tr>";
											echo "<td>".$no."</td>";
											echo "<td>".$data->haritanggal."</td>";
											echo "<td>".$data->jam."</td>";
											echo "<td>".$data->makul."</td>";
											echo "<td>".$data->pengawas."</td>";
											echo "<td>".$data->kelas."</td>";
											echo "<td>".$data->ruang."</td>";
											echo "<td>".$data->kelompok."</td>";
											if($data->absensi == NULL){
												echo "<td><i class='icon-time'></i> Menunggu Petugas</td>";
											}else if($data->absensi == 1){
												echo "<td><i class='icon-ok'></i></td>";
											}else{
												echo "<td><i class='icon-remove'></i></td>";
											}
											// echo "<td>".$data->semester.'<br>'.$data->tahun_ajaran."</td>";
											// echo "<td>".$data->tahun_ajaran."</td>";
											$no++;
											if($this->session->userdata('jabatan') != 'Dosen'){ ?>
											<!-- <td class="text-center">
													<a href="<?= base_url(); ?>jadwal_ujian/in_edit/<?= $data->id; ?>" class="btn btn-sm btn-primary">Edit</a>
													<a href="<?= base_url(); ?>jadwal_ujian/hapus/<?= $data->id; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
											</td> -->
											<?php 
										echo "</tr>";
										} ?>
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