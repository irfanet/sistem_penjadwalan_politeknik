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
							<a href="#" title="">Daftar Pengawas Cadangan</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR PENGAMPU</h3>
						<?php if($this->session->userdata('jabatan') != 'Dosen'){ ?>
						<a href="<?= base_url(); ?>pengawas_cadangan/in_tambah" class="btn btn-primary"> Import Data</a>
						<?php }if($this->session->userdata('jabatan') != 'Mahasiswa'){ ?>
							<a href="<?= base_url(); ?>pengawas_cadangan/export" class="btn btn-primary"> Export Data</a>
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
								<h4><i class="icon-reorder"></i> DAFTAR PENGAWAS CADANGAN</h4>
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
											<th>NIDN</th>
                                            <th>Nama Singkat</th>
											<th>Semester</th>
											<th>Tahun Ajaran</th>
											<!-- <th>Status</th>
											<?php if($this->session->userdata('jabatan') == 'Kaprodi'){ ?>
											<th width="170">Aksi</th>
											<?php } ?> -->
										</tr>
									</thead>
									<form method="post" action="<?= base_url()?>matkul/update">
									<tbody>
									<?php $no=1; foreach($pengawas_cadangan as $m){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $m['nidn']; ?></td>
                                            <td><?= $m['nama_singkat']; ?></td>
											<td><?= $m['semester'] ?></td>
											<td><?= $m['tahun_ajaran'] ?></td>
<!-- 
											<td align="center">
											<?php if($m['status'] == 1){
																	echo "<span class='label label-info'>Ujian</span>";
																  }else{
																	echo "<span class='label label-default'>Tidak ada Ujian</span>";
																  } 
											?>
											</td>
											<?php if($this->session->userdata('jabatan') == 'Kaprodi'){ ?>
											<td>
													<!-- <a href="<?= base_url(); ?>matkul/edit/<?= $m['id']; ?>" class="btn btn-sm btn-primary">Edit</a> -->

												<input type="hidden" name="ID_makul[]" value="<?php echo $m['id'];?>">
                                                <?php if ($m['status']==1){?>
                                                    <input type="radio" name="status[<?php print $m['id']; ?>]" value="1" checked> Ujian<br>
                                                    <input type="radio" name="status[<?php print $m['id']; ?>]" value="0"> Tidak ada Ujian<br>
                                                <?php } else{?>
                                                    <input type="radio" name="status[<?php print $m['id']; ?>]" value="1"> Ujian<br>
                                                    <input type="radio" name="status[<?php print $m['id']; ?>]" value="0" checked> Tidak ada Ujian<br>
                                                <?php }?>
													<!-- <a href="<?= base_url(); ?>matkul/hapus/<?= $m['id']; ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a> -->
											</td>
											<?php } ?> -->
										</tr>
									<?php } ?>
									<?php if($this->session->userdata('jabatan') == 'Kaprodi'){ ?>
									<tr>
							
										<td colspan="6"></td>
										<td align="center">	<input class="btn btn-primary" type="submit" value="Simpan"></button></td>

								</form></td>
									</tr>
									<?php }?>
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