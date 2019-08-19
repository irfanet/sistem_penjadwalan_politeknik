<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>prodi">Panitia Ujian</a>
						</li>
						<li class="current">
							<a href="pages_calendar.html" title="">Edit Panitia Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>EDIT PANITIA UJIAN</h3>
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
								<h4><i class="icon-reorder"></i>Form Panitia Ujian</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
                                <input type="text" hidden="" name="id" value="<?= $panitia['id'];?>">

									<div class="form-group">
											<label class="col-md-2 control-label">Pegawai :</label>
											<div class="col-md-8">
													<select class="form-control" name="pegawai" required="">
														<option value="">-- Silahkan Pilih --</option>
                                                        <?php foreach($pegawai as $pg){ ?>
                                                            <?php if($pg['id'] == $panitia['id_pegawai']): ?>
                                                                <option value="<?= $pg['id']; ?>" selected><?= $pg['nama_lengkap']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $pg['id']; ?>"><?= $pg['nama_lengkap']; ?></option>
                                                            <?php endif; ?>
                                                        <?php } ?>
													</select>
											</div>
									</div>

                                    <div class="form-group">
											<label class="col-md-2 control-label">Semester :</label>
											<div class="col-md-8">
													<select class="form-control" name="semester" required="" readonly>
                                                        <?php foreach($semester as $s){ ?>
                                                            <?php if($s == $panitia['semester']): ?>
                                                                <option value="<?= $s; ?>" selected><?= $s; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $s; ?>"><?= $s; ?></option>
                                                            <?php endif; ?>
                                                        <?php } ?>
													</select>
											</div>
									</div>
										
                                    <div class="form-group">
										<label class="col-md-2 control-label">Tahun Ajaran :</label>
										<div class="col-md-8"><input type="text" name="tahun_ajaran" title="Tooltip on focus" class="form-control bs-focus-tooltip" readonly value="<?= $panitia['tahun_ajaran'] ?>" required="">
										<small class="form-text text-danger"><?= form_error('tahun_ajaran');?></small>
										</div>
									</div>
                                    
									<div class="form-group">
											<label class="col-md-2 control-label">Jabatan :</label>
											<div class="col-md-8">
													<select class="form-control" name="jabatan" required="">
                                                      <?php foreach($jabatan as $j){ ?>
                                                            <?php if($j == $panitia['jabatan']): ?>
                                                                <option value="<?= $j; ?>" selected><?= $j; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $j; ?>"><?= $j; ?></option>
                                                            <?php endif; ?>
                                                        <?php } ?>
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