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
							<a href="<?= base_url(); ?>ruang_kelas">Program Studi</a>
						</li>
						<li class="current">
							<a href="#" title="">Import Program Studi</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>IMPORT PROGRAM STUDI</h3>
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
								<h4><i class="icon-reorder"></i> Form Tambah Program Studi</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post" action='<?=base_url("prodi/import")?>' enctype="multipart/form-data">
										
									<div class="form-group">
                  <label class="col-md-2 control-label">File Program Studi <span class="required">*</span></label>
										<div class="col-md-8">
                      <input type="file" name="file" accept=".csv" class="required" data-style="fileinput"  data-inputsize="medium" required=""></small>
                      <p class="help-block">CSV only (csv/*)</p>
											<label for="file" class="has-error help-block" generated="true" style="display:none;"></label>
                    </div>
									</div>
									
                    <div class="form-group">
											<label class="col-md-2 control-label"></label>
											<button type="submit" name="import" class="btn btn-primary">Simpan</button>
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
  