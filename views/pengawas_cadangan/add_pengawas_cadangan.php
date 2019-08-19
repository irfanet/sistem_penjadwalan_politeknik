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
							<a href="#" title="">Tambah Pengawas Cadangan</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Tambah Pengawas Cadangan</h3>
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
								<h4><i class="icon-reorder"></i> Form Tambah Pengawas Cadangan</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
										
                                <div class="form-group">
											<label class="col-md-2 control-label">NIDN :</label>
											<div class="col-md-8">
                                                <input type="text" name="nidn" class="form-control bs-focus-tooltip" required="">
											</div>
                                </div>
                                		
                                <div class="form-group">
											<label class="col-md-2 control-label">Nama  :</label>
											<div class="col-md-8">
													<select id="nama"  name="nama" class="select2 col-md-12 full-width-fix" required="">
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