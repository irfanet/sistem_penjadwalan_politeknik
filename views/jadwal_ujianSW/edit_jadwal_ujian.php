<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>jadwal_ujian">Dashboard</a>
						</li>
						<li class="current">
							<a href="#" title="">Edit Jadwal Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>EDIT JADWAL UJIAN</h3>
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
								<h4><i class="icon-reorder"></i> Form Edit Jadwal Ujian</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
									<input type="text" hidden="" name="id" value="<?= $jadwal_ujian['id'];?>">
									<div class="form-group">
										<label class="col-md-2 control-label">Tanggal Ujian :</label>
										<div class="col-md-8"><input type="date" name="tgl_ujian" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $jadwal_ujian['tgl_ujian']; ?>" required=""></div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Tahun Ajaran :</label>
										<div class="col-md-8"><input type="text" name="tahun_ajaran" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $jadwal_ujian['tahun_ajaran'] ?>" required=""></div>
									</div>
									
									<div class="form-group">
											<label class="col-md-2 control-label">Semester :</label>
											<div class="col-md-8">
													<select class="form-control" name="semester" required="">
														<?php foreach($semester as $s){ ?>
                                                            <?php if($s == $jadwal_ujian['semester']): ?>
                                                                <option value="<?= $s; ?>" selected><?= $s; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $s; ?>"><?= $s; ?></option>
                                                            <?php endif; ?>
                                                        <?php } ?>
													</select>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Ruang Kelas :</label>
											<div class="col-md-8">
													<select class="form-control" name="ruang_kelas" required="">
                                                        <?php foreach($ruang_kelas as $r){ ?>
                                                            <?php if($r['id'] == $jadwal_ujian['ruang_kelas']): ?>
                                                                <option value="<?= $r['id']; ?>" selected><?= $r['nama']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?= $r['id']; ?>"><?= $r['nama']; ?></option>
                                                            <?php endif; ?>
                                                        <?php } ?>
													</select>
											</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Jam Kelas :</label>
										<div class="col-md-8">
												<select class="form-control" name="jam_kelas" required="">
													<?php foreach($jam_kelas as $jm){ ?>
														<?php if($jm == $jadwal_ujian['jam_kelas']): ?>
															<option value="<?= $jm; ?>" selected><?= $jm; ?> <option>
														<?php else: ?>
															<option value="<?= $jm; ?>"><?= $jm; ?></option>
														<?php endif; ?>
													<?php } ?>
												</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Mata Kuliah :</label>
										<div class="col-md-8">
												<select class="form-control" name="matkul" required="">
                                                    <?php foreach($matkul as $mk){ ?>
														<?php if($mk['id'] == $jadwal_ujian['matkul']): ?>
                                                                <option value="<?= $mk['id']; ?>" selected><?= $mk['nama_matkul']; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $mk['id']; ?>"><?= $mk['nama_matkul']; ?></option>
                                                        <?php endif; ?>
													<?php } ?>
												</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Kelas :</label>
										<div class="col-md-8">
												<select class="form-control" name="kelas" required="">
													<?php foreach($kelas as $k){ ?>
														<?php if($k['id'] == $jadwal_ujian['kelas']): ?>
															<option value="<?= $k['id']; ?>" selected><?= $k['nama_kelas']; ?></option>
														<?php else : ?>
															<option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>
														<?php endif; ?>
													<?php } ?>
												</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">No Absen :</label>
										<div class="col-md-8"><input type="text" name="no_absen" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $jadwal_ujian['no_absen']; ?>" required=""></div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Dosen Pengawas Utama :</label>
										<div class="col-md-8">
												<select class="form-control" name="dosen_pengawas1" required="">
                                                <?php foreach($pegawai as $pg){ ?>
													<?php if($pg['id'] == $jadwal_ujian['dosen_pengawas1']): ?>
														<option value="<?= $pg['id']; ?>" selected><?= $pg['nama']; ?></option>
													<?php else : ?>
														<option value="<?= $pg['id']; ?>"><?= $pg['nama']; ?></option>
													<?php endif; ?>
												<?php } ?>
												</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Dosen Pengawas Cadangan :</label>
										<div class="col-md-8">
												<select class="form-control" name="dosen_pengawas2" required="">
												<?php foreach($pegawai as $pg){ ?>
													<?php if($pg['id'] == $jadwal_ujian['dosen_pengawas2']): ?>
														<option value="<?= $pg['id']; ?>" selected><?= $pg['nama']; ?></option>
													<?php else : ?>
														<option value="<?= $pg['id']; ?>"><?= $pg['nama']; ?></option>
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