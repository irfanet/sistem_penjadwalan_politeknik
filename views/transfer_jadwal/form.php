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
							<a href="#" title="">Upload Excel</a>
						</li>
					</ul>
				</div>
                <!-- /Breadcrumbs line -->
                <!--=== Page Header ===-->
				<div class="page-header">
                <div class="page-title">
                        <h3>Upload Excel</h3>
                </div>
                    
				</div>
					<?= $this->session->flashdata('message');?><br>
					<div class="text-center">
						<form method="post" action="<?php echo base_url();?>transfer_jadwal/form"  enctype="multipart/form-data">
						<?php
						foreach ($set as $hasil) { ?>
							<div class="form-group">
								<label class="col-md-2 control-label">Semester :</label>
                						<div class="col-md-4">
										<select class="form-control" name="semester" required="" disabled>
											<option value="" disabled>-- Silahkan Pilih --</option>
											<option value=""><?=$hasil->semester?></option>
											<option value="Ganjil">Ganjil</option>
											<option value="Genap">Genap</option>
										</select>
								</div>
							</div>

                            <br><br>
                            <br>
                            <div class="form-group">
								<label class="col-md-2 control-label">Tahun Ajaran :</label>
								<div class="col-md-4"><input type="text" name="tahun_ajaran" title="Tooltip on focus" value="<?= $hasil->tahun_ajaran?>" disabled class="form-control bs-focus-tooltip" required="">
								</div>
			  </div>
			  <?php }?>
              <br>
			  <br>

			  <div class="form-group">
										<label class="col-md-2 control-label">File <span class="required">*</span></label>
										<div class="col-md-4">
											<input type="file" name="file" class="required" accept="application/vnd.ms-excel" data-style="fileinput" data-inputsize="medium">
											<p class="help-block">Excel only (.xls)</p>
											<label for="file" class="has-error help-block" generated="true" style="display:none;"></label>
										</div>
									</div>
		
              <br>
              <br>

							<div class="form-group">
								<!-- <label class="col-md-2 control-label"></label> -->
								<div class="col-md-1"><button type="submit" name="upload" value="upload" class="btn btn-primary">Upload</button>
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

 
</body>
</html>