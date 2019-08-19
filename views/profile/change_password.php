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
							<a href="#" title="">Change Password</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>CHANGE PASSWORD</h3>
                        <?= $this->session->flashdata('message');?>
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
								<h4><i class="icon-reorder"></i> Form Change Password</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">

									<div class="form-group">
										<label class="col-md-2 control-label">Current Password :</label>
										<div class="col-md-8">
											<input type="text" name="current_password" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('nama'); ?>" >
											<small class="form-text text-danger"><?= form_error('current_password');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">New Password :</label>
										<div class="col-md-8">
											<input type="text" name="new_password1" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('nama'); ?>" >
											<small class="form-text text-danger"><?= form_error('new_password1');?></small>
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-md-2 control-label">Repeat Password :</label>
										<div class="col-md-8">
											<input type="text" name="new_password2" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('nama'); ?>" >
											<small class="form-text text-danger"><?= form_error('new_password2');?></small>
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