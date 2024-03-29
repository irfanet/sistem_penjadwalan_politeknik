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
							<a href="#" title="">Daftar Mata Kuliah</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR MATA KULIAH</h3>
						<?php if($this->session->userdata('jabatan') != 'Dosen'){ ?>
						<a href="<?= base_url(); ?>matkul/add" class="btn btn-primary"> Tambah Data</a>	
						<a href="<?= base_url(); ?>matkul/in_tambah" class="btn btn-primary"> Import Data</a>
						<?php }if($this->session->userdata('jabatan') != 'Mahasiswa'){ ?>
							<a href="<?= base_url(); ?>matkul/export" class="btn btn-primary"> Export Data</a>
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
											<th>Kelas</th>
											<th>Prodi</th>
											<th>Semester</th>
											<th>Tahun Ajaran</th>
											<th>Status</th>
											<?php if($this->session->userdata('jabatan') == 'Kajur'){ ?>
											<th width="170">Aksi</th>
											<?php } ?>
											<?php if($this->session->userdata('jabatan') == 'Kaprodi'){ ?>
											<th width="170">Aksi</th>
											<?php } ?>
										</tr>
									</thead>
									<!-- <form method="post" action="<?= base_url()?>matkul/update"> -->
									<tbody>
									<?php $no=1; foreach($matkul as $m){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $m['makul']; ?></td>
											<td><?= $m['prodi']; ?></td>
											<td><?= $m['semester'] ?></td>
											<td><?= $m['tahun_ajaran'] ?></td>

											<td align="center">
											<?php if($m['status'] == 1){
																	echo "<span class='label label-info'>Ujian</span>";
																  }else{
																	echo "<span class='label label-default'>Tidak ada Ujian</span>";
																  } 
											?>
											</td>
											<?php if($this->session->userdata('jabatan') == 'Kajur'){ ?>
											<td class="text-center">
													<a href="<?= base_url(); ?>matkul/edit/<?= $m['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
													<a href="<?= base_url(); ?>matkul/hapus/<?= $m['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
											</td>
											<?php } ?>
											<?php if($this->session->userdata('jabatan') == 'Kaprodi'){ ?>
											<td align="center">
													<!-- <a href="<?= base_url(); ?>matkul/edit/<?= $m['id']; ?>" class="btn btn-sm btn-primary">Edit</a> -->

							
                                                <?php if ($m['status']==1){?>
													<a href="<?= base_url()?>matkul/update/<?= $m['id']?>"><button class="btn btn-s btn-primary" ><i class="icon-ok"></i></button></a>
													<a href="<?= base_url()?>matkul/undo/<?= $m['id']?>"><button class="btn btn-s"><i class="icon-remove"></i></button></a>
												<?php } else{?>
													<a href="<?= base_url()?>matkul/update/<?= $m['id']?>"><button class="btn btn-s" ><i class="icon-ok"></i></button></a>
													<a href="<?= base_url()?>matkul/undo/<?= $m['id']?>"><button class="btn btn-s btn-primary"><i class="icon-remove"></i></button></a>
                                                <?php }?>
													<!-- <a href="<?= base_url(); ?>matkul/hapus/<?= $m['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a> -->
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