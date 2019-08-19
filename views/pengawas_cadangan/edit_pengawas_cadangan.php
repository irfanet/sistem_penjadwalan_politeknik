<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>ruang_kelas">Pengawa Cadangan</a>
						</li>
						<li class="current">
							<a href="#" title="">Edit Pengawas Cadangan</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Edit Pengawas Cadangan</h3>
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
								<h4><i class="icon-reorder"></i> Form Edit Pengawas Cadangan</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
                                        
                                <input type="hidden" name="id" value="<?= $id_pengawas['id']?>">
                                <div class="form-group">
											<label class="col-md-2 control-label">NIDN :</label>
											<div class="col-md-8">
                                                <input type="text" name="nidn" value="<?= $id_pengawas['nidn']?>" class="form-control bs-focus-tooltip" required="">
											</div>
                                </div>
                                		
                                		
                                <div class="form-group">
											<label class="col-md-2 control-label">Nama  :</label>
											<div class="col-md-8">
													<select id="nama"  name="nama" class="select2 col-md-12 full-width-fix" required="">
                                                    <option value="<?= $id_pengawas['nama_singkat']?>" selected><?= $id_pengawas['nama_singkat']?></option>
														<?php foreach($pengampu as $p){ 
                                                             if($id_pengawas['nama_singkat']!=$p['nama_singkat']){ ?>  
                                                             <option value="<?= $p['nama_singkat']; ?>"><?= $p['nama_singkat']; ?></option>
														<?php }} ?>
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