
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
							<a href="#" title="">Amplop Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
				<div class="page-title">
			<h3>AMPLOP UJIAN</h3>
				</div>
					</div>
					<hr>
					<?= $this->session->flashdata('message');?><br>
					<div class="text-center">
						<form method="post" action="<?= base_url();?>cetak/cetakAmplop">
							<div class="form-group">
								<label class="col-md-3 control-label">Sesi Ujian :</label>
								<div class="col-md-4">
										<!-- <select class="form-control" name="hariJamTes" required=""> -->
										<!-- <option value="All">Semua</option> -->
										<?php
										if(!$perHari){
											echo "<select class='form-control' name='haritanggal' id='selek' required disabled>";											
											echo '<option selected>Data Kosong</option>';
										} else{
											echo "<select class='form-control' name='haritanggal' required='' id='selek'>";	
										foreach($perHari as $p){ ?>
											<option value="<?= $p['haritanggal']; ?>"><?= $p['haritanggal']; ?></option>
										<?php } }?>
										</select>
								</div>
							</div>

							<br><br><br>
							<!-- <div class="form-group">
								<label class="col-md-3 control-label">Tinggi per Baris (min. 30) :</label>
								<div class="col-md-4"><input type="text" name="tinggiBaris" placeholder="Minimum 30" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="">
								</div>
							</div> -->

							<br><br>
							<div class="form-group">
								<label class="col-md-3 control-label"></label>
								<?php
									if(!$perHari){
											echo "<div class='col-md-1'><button id='submit' type='submit' class='btn btn-primary' disabled>Proses</button>";
										} else{
											echo "<div class='col-md-1'><button id='submit' type='submit' class='btn btn-primary'>Proses</button>";
										}?>
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