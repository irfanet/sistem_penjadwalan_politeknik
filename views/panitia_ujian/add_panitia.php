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
							<a href="pages_calendar.html" title="">Tambah Panitia Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>TAMBAH PANITIA UJIAN</h3>
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
								<h4><i class="icon-reorder"></i> Form Panitia Ujian</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
                                
									<div class="form-group">
											<label class="col-md-2 control-label">Pegawai :</label>
											<div class="col-md-8">
													<select class="select2 col-md-12 full-width-fix" name="pegawai" required="">
														<option value=" ">-- Silahkan Pilih --</option>
                                                        <?php foreach($pegawai as $p){ ?>
														    <option value="<?= $p['id']; ?>"><?= $p['nama_lengkap']; ?></option>
                                                        <?php } ?>
													</select>
											</div>
									</div>

                                    <div class="form-group">
											<label class="col-md-2 control-label">Semester :</label>
											<div class="col-md-8">
													<select class="form-control" name="semester" required="" readonly>
													<?php foreach($set as $setting){ ?>
														<option value="<?= $setting->semester?>" selected><?= $setting->semester?></option>
													<?php }?>
													</select>
											</div>
									</div>
										
                                    <div class="form-group">
										<label class="col-md-2 control-label">Tahun Ajaran :</label>
										<?php foreach($set as $setting){ ?>
										<div class="col-md-8"><input type="text" name="tahun_ajaran" title="Tooltip on focus" value="<?= $setting->tahun_ajaran?>" readonly class="form-control bs-focus-tooltip" value="<?= set_value('tahun_ajaran'); ?>" required="">
										<?php }?>
										<small class="form-text text-danger"><?= form_error('tahun_ajaran');?></small>
										</div>
									</div>
                                    
									<div class="form-group">
											<label class="col-md-2 control-label">Jabatan :</label>
											<div class="col-md-8">
													<select class="form-control" name="jabatan" required="">
														<option value="">-- Silahkan Pilih --</option>
														<option value="Kabid Jurusan">Kabid Jurusan</option>
														<option value="Sekretaris">Sekretaris</option>
                                                        <option value="Pelaksana Administrasi">Pelaksana Administrasi</option>
                                                        <option value="Seksi Tempat">Seksi Tempat</option>
                                                        <option value="Koordinator Seksi Pelaksana dan Jadwal">Koordinator Seksi Pelaksana dan Jadwal</option>
                                                        <option value="Anggota Seksi Pelaksana dan Jadwal">Anggota Seksi Pelaksana dan Jadwal</option>
                                                        <option value="Koordinator Seksi Naskah dan Pengepakan">Koordinator Seksi Naskah dan Pengepakan</option>
                                                        <option value="Anggota Seksi Naskah dan Pengepakan">Anggota Seksi Naskah dan Pengepakan</option>
                                                        <option value="Pembantu Umum">Pembantu Umum</option>
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