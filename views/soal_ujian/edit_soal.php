<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>prodi">Soal Ujian</a>
						</li>
						<li class="current">
							<a href="pages_calendar.html" title="">Edit Soal Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>EDIT SOAL UJIAN</h3>
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
								<h4><i class="icon-reorder"></i> Form Edits Soal Ujian</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post" enctype="multipart/form-data">
								<input type="text" hidden="" name="id" value="<?= $pdf['id'];?>">
								<input type="text" hidden="" name="penggandaan" value="<?= $pdf['penggandaan'];?>">
                                    <div class="form-group">
										<label class="col-md-2 control-label">Mata Kuliah :</label>
										<div class="col-md-8"><input type="text" name="matkul" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $pdf['matkul']; ?>" required="" readonly>
										<small class="form-text text-danger"><?= form_error('matkul');?></small>
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-md-2 control-label">Kelas :</label>
										<div class="col-md-8"><input type="text" name="kelas" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $pdf['kelas']; ?>" required="" readonly>
										<small class="form-text text-danger"><?= form_error('kelas');?></small>
										</div>
									</div>
                                
                                    <div class="form-group">
											<label class="col-md-2 control-label">Semester :</label>
											<div class="col-md-8">
													<select class="form-control" name="semester" required="" readonly>
														<?php foreach($semester as $s){ ?>
                                                            <?php if($s == $pdf['semester']): ?>
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
										<div class="col-md-8"><input type="text" readonly name="tahun_ajaran" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= $pdf['tahun_ajaran']; ?>" required="">
										<small class="form-text text-danger"><?= form_error('tahun_ajaran');?></small>
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-md-2 control-label">File Soal Ujian <span class="required">*</span></label>
										<div class="col-md-8">
											<p><?= $pdf['soal']; ?></p><input type="file" name="pdf" class="required" data-style="fileinput" multiple="multiple" data-inputsize="medium" required="">
											<p class="help-block">Pdf only (pdf/*)</p>
											<label for="file1" class="has-error help-block" generated="true" style="display:none;"></label>
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