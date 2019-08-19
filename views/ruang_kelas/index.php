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
							<a href="<?= base_url(); ?>ruang_kelas" title="">Daftar Ruang Kelas</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR RUANG KELAS</h3>
						<?php if($this->session->userdata('jabatan') == 'Kajur'){ ?>
						<a href="<?= base_url(); ?>ruang_kelas/in_tambah" class="btn btn-primary"> Import Data</a>
						<?php }if($this->session->userdata('jabatan') != 'Mahasiswa'){ ?>
							<a href="<?= base_url(); ?>ruang_kelas/export" class="btn btn-primary"> Export Data</a>
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
											<th>Nama Ruang</th>
											<th>Kelompok</th>
											<?php if($this->session->userdata('jabatan') == 'Kajur'){ ?>
											<th width="170">Aksi</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php $no=1; foreach($ruang_kelas as $p){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $p['nama']; ?></td>
											<td><?= $p['kelompok']; ?></td>
											<?php if($this->session->userdata('jabatan') == 'Kajur'){ ?>
											<td class="text-center">
													<a href="<?= base_url(); ?>ruang_kelas/edit/<?= $p['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
													<a href="<?= base_url(); ?>ruang_kelas/hapus/<?= $p['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>	
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