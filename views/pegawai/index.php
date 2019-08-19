<div id="content">
	<!-- Flashdata -->
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
	<?php if ($this->session->flashdata('flash')) : ?>

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
					<a href="#" title="">Daftar Dosen & Pegawai</a>
				</li>
			</ul>
		</div>
		<!-- /Breadcrumbs line -->

		<!--=== Page Header ===-->
		<div class="page-header">
			<div class="page-title">
				<h3>DAFTAR DOSEN & PEGAWAI</h3><br>

				<?php if ($this->session->userdata('jabatan') == 'Kajur') { ?>
					<a href="<?= base_url(); ?>pegawai/add" class="btn btn-primary"> Tambah Data Pegawai </a>
					<a href="<?= base_url(); ?>pegawai/in_tambah" class="btn btn-primary"> Import Data Pegawai </a>
					<a href="<?= base_url(); ?>pegawai/export" class="btn btn-primary"> Export Data Pegawai </a>
					

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
						<h4><i class="icon-reorder"></i> DAFTAR DOSEN</h4>
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
									<th>No</th>
									<th>Nip</th>
									<th>Nama</th>
									<th>Program Studi</th>
									<th>Jabatan</th>
									<th>Golongan</th>
									<th>Email</th>
									<th>Status</th>
									<?php if ($this->session->userdata('jabatan') == 'Kajur') { ?>
										<th width="150">Aksi</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($pegawai as $p) { ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $p['nip']; ?></td>
										<td><?= $p['nama_lengkap']; ?></td>
										<td><?= $p['nama_prodi']; ?></td>
										<td><?= $p['jabatan']; ?></td>
										<td><?= $p['golongan']; ?></td>
										<td><?= $p['email']; ?></td>
										<td>
											<?php
											if ($p['is_active'] == 1) {
												echo 'Active';
											} else {
												echo 'Not Active';
											}
											?>
										</td>
										<?php if ($this->session->userdata('jabatan') == 'Kajur') { ?>
											<td class="text-center">
												<a href="<?= base_url(); ?>pegawai/edit/<?= $p['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
												<a href="<?= base_url(); ?>pegawai/hapusData/<?= $p['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
											</td>
										<?php } ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Content -->


		<!--=== Page Content ===-->
		<!--=== Managed Tables ===-->

		<!--=== Normal ===-->
		<div class="row">
			<div class="col-md-12">
				<div class="widget box">
					<div class="widget-header">
						<h4><i class="icon-reorder"></i> DAFTAR PEGAWAI</h4>
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
									<th>No</th>
									<th>Nip</th>
									<th>Nama</th>
									<!-- <th>Program Studi</th> -->
									<th>Jabatan</th>
									<th>Email</th>
									<th>Status</th>
									<?php if ($this->session->userdata('jabatan') == 'Kajur') { ?>
										<th width="150">Aksi</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1;
								foreach ($panitia as $p) { ?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $p['nip']; ?></td>
										<td><?= $p['nama_lengkap']; ?></td>
										<!-- <td><?= $p['nama_prodi']; ?></td> -->
										<td><?= $p['jabatan']; ?></td>
										<td><?= $p['email']; ?></td>
										<td>
											<?php
											if ($p['is_active'] == 1) {
												echo 'Active';
											} else {
												echo 'Not Active';
											}
											?>
										</td>
										<?php if ($this->session->userdata('jabatan') == 'Kajur') { ?>
											<td class="text-center">
												<a href="<?= base_url(); ?>pegawai/edit/<?= $p['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
												<a href="<?= base_url(); ?>pegawai/hapusData/<?= $p['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
											</td>
										<?php } ?>
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