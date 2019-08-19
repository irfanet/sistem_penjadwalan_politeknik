<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>matkul">Dashboard</a>
						</li>
						<li class="current">
							<a href="#" title="">Edit Mata Kuliah</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>EDIT MATA KULIAH</h3>
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
								<h4><i class="icon-reorder"></i> Form Edit Mata Kuliah</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
								<input type="text" hidden="" name="id" value="<?= $matkul['id'];?>">
									<div class="form-group">
											<label class="col-md-2 control-label">Kelas :</label>
											<div class="col-md-8">
													<select class="form-control" name="kelas" required="">
													<?php foreach($kelas as $j): ?>
														<?php if($j['id'] == $matkul['id_kelas']): ?>
															<option value="<?= $j['id']; ?>" selected><?= $j['nama_kelas']; ?></option>
														<?php else : ?>
															<option value="<?= $j['id']; ?>"><?= $j['nama_kelas']; ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
													</select>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Nama Mata Kuliah :</label>
											<div class="col-md-8"><input type="text" name="nama" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $matkul['nama_matkul']; ?>">
											<small class="form-text text-danger"><?= form_error('nama');?></small>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Jenis Mata Kuliah :</label>
											<div class="col-md-8">
													<select class="form-control" name="jenis_matkul" required="">
													<?php foreach($matkul1 as $j): ?>
														<?php if($j == $matkul['jenis_matkul']): ?>
															<option value="<?= $j; ?>" selected>
															<?php if($j==1){ echo 'Umum'; } else{ echo 'Biasa'; } ?>
															</option>
														<?php else : ?>
															<option value="<?= $j; ?>"><?php if($j==1){ echo 'Umum'; } else{ echo 'Biasa'; } ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
													</select>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label"></label>
											<button type="submit" class="btn btn-primary">Simpan</button>
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