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
							<a href="#" title="">Daftar Pengampu</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR PENGAMPU</h3>
						<?php if($this->session->userdata('jabatan') != 'Dosen'){ ?>
							<a href="<?= base_url(); ?>pengampu/add" class="btn btn-primary"> Tambah Data</a>
						<a href="<?= base_url(); ?>pengampu/in_tambah" class="btn btn-primary"> Import Data</a>
						<?php }if($this->session->userdata('jabatan') != 'Mahasiswa'){ ?>
							<a href="<?= base_url(); ?>pengampu/export" class="btn btn-primary"> Export Data</a>
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
								<h4><i class="icon-reorder"></i> DAFTAR MATA KULIAH</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable datatable" id="tabel">
									<thead>
										<tr>
											<th width="90">No</th>
											<th>Mata Kuliah</th>
                                            <th>Kelas</th>
                                            <th>Pengampu</th>
                                            <th>Kunci</th>
											<th>Semester</th>
											<th>Tahun Ajaran</th>
											<?php if($this->session->userdata('jabatan') == 'Kajur'){ ?>
											<th width="170">Aksi</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
									<?php $no=1; foreach($pengampu as $m){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $m['makul']; ?></td>
                                            <td><?= $m['kelas']; ?></td>
                                            <td><?= $m['pengampu']; ?></td>
											<td><?= $m['kunci']; ?></td>
											<td><?= $m['semester'] ?></td>
											<td><?= $m['tahun_ajaran'] ?></td>
											<?php if ($this->session->userdata('jabatan') == 'Kajur') { ?>
											<td class="text-center">
												<a href="<?= base_url(); ?>pengampu/edit/<?= $m['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
												<a href="<?= base_url(); ?>pengampu/hapusData/<?= $m['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
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
		<script>
		// $('#tabel').dataTable( {
		// "pageLength": 50
		// } );
</script>