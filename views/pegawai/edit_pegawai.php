<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>pegawai">Dosen</a>
						</li>
						<li class="current">
							<a href="#" title="">Edit Dosen</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>EDIT DOSEN</h3>
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
								<h4><i class="icon-reorder"></i> Form Edit Dosen</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
								<input type="text" hidden="" name="id" value="<?= $pegawai['id'];?>">
									<div class="form-group">
											<label class="col-md-2 control-label">Status :</label>
											<div class="col-md-8">
													<select class="form-control" name="status" required="">
													<?php foreach($status as $j): ?>
														<?php if($j == $pegawai['is_active']): ?>
															<option value="<?= $j; ?>" selected>
															<?php if($j==1){ echo 'Active'; } else{ echo 'Not Active'; } ?>
															</option>
														<?php else : ?>
															<option value="<?= $j; ?>"><?php if($j==1){ echo 'Active'; } else{ echo 'Not Active'; } ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
													</select>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Jabatan :</label>
											<div class="col-md-8">
													<select id="jabatan" class="form-control" name="jabatan" required="">
													<option value="<?= $pegawai['jabatan']?>">-- Silahkan Pilih Kembali  --</option>
													<!-- <option value="<?= $pegawai['jabatan']?>" selected><?= $pegawai['jabatan']?></option> -->
													<?php foreach($jabatan as $j): ?>
														<?php if($j == $pegawai['jabatan']): ?>
															<option value="<?= $j; ?>">
																<?= $pegawai['jabatan']; ?>
															</option>
														<?php else : ?>
															<option value="<?= $j; ?>"><?= $j; ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
													</select>
											</div>
									</div>
									<?php 
										if($pegawai['jabatan']!='Dosen' || $pegawai['jabatan']!='Kaprodi'){
											$disable = 'disabled';
										} 
									?>
									<div class="form-group">
											<label class="col-md-2 control-label">Program Studi :</label>
											<div class="col-md-8">
													<select id="prodi" class="form-control" name="prodi" required="" >
													<option value="">-- Silahkan Pilih --</option>
													<?php foreach($prodi as $r){ ?>
                                                            <?php if($r['kode'] == $pegawai['id_prodi']): ?>
                                                                <option value="<?= $r['kode']; ?>" selected><?= $r['nama']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $r['kode']; ?>"><?= $r['nama']; ?></option>
                                                            <?php endif; ?>
                                                    <?php } ?>
													</select>
											</div>
									</div>
									<?php 
										if($pegawai['jabatan']!='Dosen' || $pegawai['jabatan']!='Kaprodi'){
											$disable = 'disabled';
										} 
									?>
									<div class="form-group">
											<label class="col-md-2 control-label">Golongan :</label>
											<div class="col-md-8">
													<select id="golongan" class="form-control"  name="golongan" required="" >
													<option value="">-- Silahkan Pilih --</option>
													<?php foreach($golongan as $j): ?>
														<?php if($j == $pegawai['golongan']): ?>
															<option value="<?= $j; ?>" selected>
															<?php if($j==3){ echo '3'; } else{ echo '4'; } ?>
															</option>
														<?php else : ?>
															<option value="<?= $j; ?>"><?php if($j==4){ echo '4'; } else{ echo '3'; } ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
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
		<script>
				document.getElementById("jabatan").onchange = function () {
				document.getElementById("prodi").setAttribute("disabled", "disabled"),
				document.getElementById("golongan").setAttribute("disabled","disabled");
				if (this.value == 'Dosen' || this.value =='Kaprodi')
					document.getElementById("prodi").removeAttribute("disabled"),
					document.getElementById("golongan").removeAttribute("disabled")
				};
		</script>