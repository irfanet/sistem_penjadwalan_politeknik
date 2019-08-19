<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>agenda">Agenda</a>
						</li>
						<li class="current">
							<a href="#" title="">Edit Jadwal</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Edit Jadwal</h3>
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
								<h4><i class="icon-reorder"></i> Form Edit Jadwal</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
									<div class="form-group">
										<label class="col-md-2 control-label">Kegiatan:</label>
										<!-- <div class="col-md-8"> -->
                                        <div class="col-md-8"> <?= $kegiatan; ?> 
											<!-- <input type="text" name="kegiatan" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= $kegiatan; ?>" > -->
											<small class="form-text text-danger"><?= form_error('kegiatan');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Tanggal:</label>
										<div class="col-md-8">
											<?php 
												$date = date("d-m-Y", strtotime($tgl['tgl']));
												$date = str_replace('-', '/', $date);
											?>
                                            <input type="text" name="tgl" class="form-control" data-mask="99/99/9999" value="<?= $date?>">
											<!-- <input type="text" name="nama_lengkap" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('nama'); ?>" > -->
											<small class="form-text text-danger"><?= form_error('nama_lengkap');?></small>
										</div>
                                    </div>
                                    <div class="form-group">
										<label class="col-md-2 control-label">Tanggal Akhir (Optional):</label>
										<div class="col-md-8">
										<input type="hidden" id="kode" value="<?=$kode?>">
										<?php 
										if($tgl['tgl_akhir']!=NULL){
												$date2 = date("d-m-Y", strtotime($tgl['tgl_akhir']));
												$date2 = str_replace('-', '/', $date2);
										}else{
											$date2 = "";
										}
											?>
                                            <input type="text" name="tgl_akhir" id="tgl" class="form-control" data-mask="99/99/9999" value="<?= $date2 ?>" disabled>
											<!-- <input type="text" name="nama_lengkap" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('nama'); ?>" > -->
											<small class="form-text text-danger"><?= form_error('nama_lengkap');?></small>
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
		<script>


			if(document.getElementById("kode").value == 2 || document.getElementById("kode").value == 3 || document.getElementById("kode").value == 6  )
 			document.getElementById("tgl").disabled = false;
				
		</script>