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
							<a href="#" title="">Tambah Jadwal Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>TAMBAH JADWAL UJIAN</h3>
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
								<h4><i class="icon-reorder"></i> Form Tambah Jadwal Ujian</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post">
									<div class="form-group">
										<label class="col-md-2 control-label">Tanggal Ujian :</label>
										<div class="col-md-8"><input type="date" name="tgl_ujian" title="Tooltip on focus" class="form-control bs-focus-tooltip" required=""></div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Tahun Ajaran :</label>
										<div class="col-md-8"><input type="text" name="tahun_ajaran" title="Tooltip on focus" class="form-control bs-focus-tooltip" required=""></div>
									</div>
									
									<div class="form-group">
											<label class="col-md-2 control-label">Semester :</label>
											<div class="col-md-8">
													<select class="form-control" name="semester" required="">
														<option value="">------- Select -------</option>
                                                            <option value="Ganjil">Ganjil</option>
															<option value="Genap">Genap</option>
													</select>
											</div>
									</div>

									<div class="form-group">
											<label class="col-md-2 control-label">Ruang Kelas :</label>
											<div class="col-md-8">
													<select class="form-control" name="ruang_kelas" required="">
														<option value="">------- Select -------</option>
                                                        <?php $no=1; foreach($ruang_kelas as $r){ ?>
                                                            <option value="<?= $r['id']; ?>"><?= $r['nama']; ?></option>
                                                        <?php } ?>
													</select>
											</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Jam Kelas :</label>
										<div class="col-md-8">
												<select class="form-control" name="jam_kelas" required="">
													<option value="">------- Select -------</option>
													<option value="pagi">Pagi</option>
													<option value="siang">Siang</option>
												</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Mata Kuliah :</label>
										<div class="col-md-8">
												<select class="form-control" name="matkul" required="">
                                                    <option value="">------ Select -------</option>
                                                    <?php $no=1; foreach($matkul as $m){ ?>
                                                        <option value="<?= $m['id']; ?>"><?= $m['nama_matkul']; ?></option>  
                                                    <?php } ?>
												</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Kelas :</label>
										<div class="col-md-8">
												<select class="form-control" name="kelas" required="">
                                                <option value="">------ Select -------</option>
                                                    <?php $no=1; foreach($kelas as $k){ ?>
                                                        <option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>  
                                                    <?php } ?>
												</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">No Absen :</label>
										<div class="col-md-8"><input type="text" name="no_absen" title="Tooltip on focus" class="form-control bs-focus-tooltip" required=""></div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Dosen Pengawas Utama :</label>
										<div class="col-md-8">
												<select class="form-control" name="dosen_pengawas1" required="">
                                                <option value="">------ Select -------</option>
                                                    <?php $no=1; foreach($pegawai as $p){ ?>
                                                        <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>  
                                                    <?php } ?>
												</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">Dosen Pengawas Cadangan :</label>
										<div class="col-md-8">
												<select class="form-control" name="dosen_pengawas2" required="">
                                                <option value="">------ Select -------</option>
                                                    <?php $no=1; foreach($pegawai as $p){ ?>
                                                        <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>  
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