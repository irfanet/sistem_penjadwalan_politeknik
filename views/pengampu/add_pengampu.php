<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>ruang_kelas">Ruang Kelas</a>
						</li>
						<li class="current">
							<a href="#" title="">Tambah Pengampu</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Tambah Pengampu</h3>
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
								<h4><i class="icon-reorder"></i> Form Tambah Pengampu</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
										
                                <div class="form-group">
											<label class="col-md-2 control-label">Mata Kuliah :</label>
											<div class="col-md-8">
													<select id="makul" name="makul" class="select2 col-md-12 full-width-fix" required="">
														<option value="0">-- Silahkan Pilih --</option>
														<?php foreach($makul as $p){ ?>
															<option value="<?= $p['makul']; ?>"><?= $p['makul']; ?></option>
														<?php } ?>
													</select>
											</div>
                                </div>
                                		
                                <div class="form-group">
											<label class="col-md-2 control-label">Kelas :</label>
											<div class="col-md-8">
													<select id="kelas" name="kelas" class="select2 col-md-12 full-width-fix" required="">
														<option value="0">-- Silahkan Pilih --</option>
														<?php foreach($kelas as $p){ ?>
															<option value="<?= $p['nama_kelas']; ?>"><?= $p['nama_kelas']; ?></option>
														<?php } ?>
													</select>
											</div>
                                </div>
                                		
                                <div class="form-group">
											<label class="col-md-2 control-label">Pengampu  :</label>
											<div class="col-md-8">
													<select id="pengampu"  name="pengampu" class="select2 col-md-12 full-width-fix" required="">
														<option value="0">-- Silahkan Pilih --</option>
														<?php foreach($pengampu as $p){ ?>
															<option value="<?= $p['nama_singkat']; ?>"><?= $p['nama_singkat']; ?></option>
														<?php } ?>
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