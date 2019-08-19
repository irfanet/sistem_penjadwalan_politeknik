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
							<a href="index.html">Dashboard</a>
						</li>
						<li class="current">
							<a href="pages_calendar.html" title="">Daftar Kelas</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR KELAS</h3>
						<?php if($this->session->userdata('jabatan') != 'Dosen'){ ?>
						<a href="<?= base_url(); ?>kelas/add" class="btn btn-primary"> Tambah Data</a>
						<a href="<?= base_url(); ?>kelas/in_tambah" class="btn btn-primary"> Import Data</a>
						<?php }if($this->session->userdata('jabatan') != 'Mahasiswa'){ ?>
							<a href="<?= base_url(); ?>kelas/export" class="btn btn-primary"> Export Data</a>
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
								<h4><i class="icon-reorder"></i> DAFTAR KELAS</h4>
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
											<th>Nama Kelas</th>
											<th>Program Studi</th>
											<?php if($this->session->userdata('jabatan') != 'Dosen'){ ?>
											<th width="170">Aksi</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
									<?php $no=1; foreach($kelas as $k){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $k['nama_kelas']; ?></td>
											<td><?= $k['nama_prodi']; ?></td>
											<?php if($this->session->userdata('jabatan') != 'Dosen'){ ?>
											<td class="text-center">
													<a href="<?= base_url(); ?>kelas/edit/<?= $k['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
													<a href="<?= base_url(); ?>kelas/hapusData/<?= $k['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
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