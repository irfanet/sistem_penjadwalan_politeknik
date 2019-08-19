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
							<a href="index.html">Dashboard</a>
						</li>
						<li class="current">
							<a href="pages_calendar.html" title="">My Profile</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>MY PROFILE</h3>
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<div class="row">
					<div class="col-md-12">
                            <!-- Page Heading -->
                            <div class="container-fluid">
                            <div class="card mb-3 col-lg-8">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                <img class="card-img" alt="..." src="<?= base_url(); ?>assets/assets/img/profile.png" width="200" height="250">
                                </div>
                                <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $user['nip']; ?></h4>
                                    <h6 class="card-text"><?= $user['nama_lengkap']; ?></h6>
                                    <h6 class="card-text"><?= $user['jabatan']; ?></h6>
                                    <h6 class="card-text"><?= $user['email']; ?></h6><br><br>
                                    <a href="<?= base_url(); ?>profile/edit" class="btn btn-danger"><span class="icon icon-pencil-square-o"></span>Edit Profile</a> | 
                                    <a href="<?= base_url(); ?>profile/change_password" class="btn btn-danger"><span class="icon icon-pencil-square-o"></span>Change Password</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        
                            </div>
                            <!--  -->
					</div>
				</div>
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>