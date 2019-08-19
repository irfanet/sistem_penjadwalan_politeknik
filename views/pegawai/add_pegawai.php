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
							<a href="#" title="">Tambah Dosen</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>TAMBAH DOSEN</h3>
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
								<h4><i class="icon-reorder"></i> Form Tambah Dosen</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
									<div class="form-group">
										<label class="col-md-2 control-label">Nip :</label>
										<div class="col-md-8">
											<input type="text" name="nip" class="form-control" required="" value="<?= set_value('nip'); ?>" >
											<small class="form-text text-danger"><?= form_error('nip');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Nama Singkat:</label>
										<div class="col-md-8">
											<input type="text" name="nama_singkat" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('nama'); ?>" >
											<small class="form-text text-danger"><?= form_error('nama_singkat');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Nama Lengkap:</label>
										<div class="col-md-8">
											<input type="text" name="nama_lengkap" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('nama'); ?>" >
											<small class="form-text text-danger"><?= form_error('nama_lengkap');?></small>
										</div>
									</div>


									<div class="form-group">
										<label class="col-md-2 control-label">Email :</label>
										<div class="col-md-8">
											<input type="email" name="email" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('email'); ?>" >
											<small class="form-text text-danger"><?= form_error('email');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Password :</label>
										<div class="col-md-8">
											<input type="password" name="password1" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('password1'); ?>" >
											<small class="form-text text-danger"><?= form_error('password1');?></small>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Retype Password :</label>
										<div class="col-md-8">
											<input type="password" name="password2" title="Tooltip on focus" class="form-control bs-focus-tooltip" required="" value="<?= set_value('password2'); ?>" >
											<small class="form-text text-danger"><?= form_error('password2');?></small>
										</div>
									</div>
									
									<div class="form-group">
											<label class="col-md-2 control-label">Jabatan :</label>
											<div class="col-md-8">
													<select id="jabatan" class="form-control" name="jabatan" required="" >
														<option value="">-- Silahkan Pilih --</option>
														<option value="Kaprodi">Kaprodi</option>
														<option value="Dosen">Dosen</option>
														<option value="Panitia">Panitia</option>
														<option value="Petugas">Petugas Soal</option>
													</select>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Prodi :</label>
											<div class="col-md-8">
													<select id="prodi" class="form-control" disabled name="prodi" required="">
														<option value="">-- Silahkan Pilih --</option>
														<?php foreach($prodi as $p){ ?>
															<option value="<?= $p['kode']; ?>"><?= $p['nama']; ?></option>
														<?php } ?>
													</select>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Golongan :</label>
											<div class="col-md-8">
													<select id="golongan" class="form-control" name="golongan" required="" >
														<option value="">-- Silahkan Pilih --</option>
														<option value="3">3</option>
														<option value="4">4</option>
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
				document.getElementById("prodi").setAttribute("disabled", "disabled");
				document.getElementById("golongan").setAttribute("disabled", "disabled");
				if (this.value == 'Dosen' || this.value =='Kaprodi')
					document.getElementById("prodi").removeAttribute("disabled");
					document.getElementById("golongan").removeAttribute("disabled");
				};
		</script>