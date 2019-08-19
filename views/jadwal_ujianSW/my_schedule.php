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
							<a href="#" title="">Daftar Panitia Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<hr>
					<?= $this->session->flashdata('message');?><br>
					<div class="text-center">
						<form method="post">
							<div class="form-group">
								<label class="col-md-2 control-label">Semester :</label>
								<div class="col-md-4">
										<select class="form-control" name="semester" required="">
											<option value="">-- Silahkan Pilih --</option>
											<option value="Ganjil">Ganjil</option>
											<option value="Genap">Genap</option>
										</select>
								</div>
							</div>

							<br><br><br>
							<div class="form-group">
								<label class="col-md-2 control-label">Tahun Ajaran :</label>
								<div class="col-md-4"><input type="text" name="tahun_ajaran" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="">
								</div>
							</div>

							<br><br>
							<div class="form-group">
								<label class="col-md-2 control-label"></label>
								<div class="col-md-1"><button type="submit" class="btn btn-primary">Cari</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>