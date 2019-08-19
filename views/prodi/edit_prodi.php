<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>prodi">Program Studi</a>
						</li>
						<li class="current">
							<a href="pages_calendar.html" title="">Edit Program Studi</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>EDIT PROGRAM STUDI</h3>
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
								<h4><i class="icon-reorder"></i> Form Edit Prodi</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
								<input type="text" hidden="" name="id" value="<?= $prodi['id'];?>">
								
									<div class="form-group">
										<label class="col-md-2 control-label">Kode :</label>
										<div class="col-md-8"><input type="text" name="kode" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $prodi['kode']; ?>">
										<small class="form-text text-danger"><?= form_error('kode');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Nama :</label>
										<div class="col-md-8"><input type="text" name="nama" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $prodi['nama']; ?>">
										<small class="form-text text-danger"><?= form_error('nama');?></small>
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