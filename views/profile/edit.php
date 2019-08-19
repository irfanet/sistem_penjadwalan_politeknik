<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>pegawai">Profile</a>
						</li>
						<li class="current">
							<a href="#" title="">Edit Profile</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>EDIT PROFILE</h3>
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
								<h4><i class="icon-reorder"></i> Form Edit Profile</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
									<div class="form-group">
										<label class="col-md-2 control-label">Nip :</label>
										<div class="col-md-8">
											<input type="text" name="nip" class="form-control" required="" value="<?= $user['nip']; ?>" readonly>
											<small class="form-text text-danger"><?= form_error('nip');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Nama :</label>
										<div class="col-md-8">
											<input type="text" name="nama" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= $this->session->userdata('nama_lengkap'); ?>" readonly >
											<small class="form-text text-danger"><?= form_error('nama');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Email :</label>
										<div class="col-md-8">
											<input type="email" name="email" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= $this->session->userdata('email');  ?>" >
											<small class="form-text text-danger"><?= form_error('email');?></small>
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