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
							<a href="pages_calendar.html" title="">Tambah Soal Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>TAMBAH SOAL UJIAN</h3>
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
								<h4><i class="icon-reorder"></i> Form Tambah Soal Ujian</h4>
							</div>
							<div class="widget-content">
								<form class="form-horizontal row-border" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
										<label class="col-md-2 control-label">Mata Kuliah :</label>
										<div class="col-md-8">
										<select id="makul" name="matkul" class="select2 col-md-12 full-width-fix">
											<option value="0">-PILIH-</option>>
											<?php foreach($makul as $mapel){ ?>
														<option value="<?= $mapel->makul?>"><?= $mapel->makul?></option>
													<?php }?>
											</select>

										
										<!-- <input type="text" name="matkul" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= set_value('matkul'); ?>" required="">
										<small class="form-text text-danger"><?= form_error('matkul');?></small> -->
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-md-2 control-label">Kelas :</label>
										<div class="col-md-8">
										<select name="kelas[]" id="kelas" class="select2 col-md-12 full-width-fix" multiple >
                           					 <option>-PILIH-</option>
                        				</select>
										<!-- <input type="text" name="kelas" title="Tooltip on focus" class="form-control bs-focus-tooltip" value="<?= set_value('kelas'); ?>" required="">
										<small class="form-text text-danger"><?= form_error('kelas');?></small> -->
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

									<input type="hidden" id="jml" name="jml">
                                    <div class="form-group">
									
										<label class="col-md-2 control-label">Tahun Ajaran :</label>
										<?php foreach($set as $setting){ ?>
										<div class="col-md-8"><input type="text" name="tahun_ajaran" title="Tooltip on focus" class="form-control bs-focus-tooltip" readonly value="<?= $setting->tahun_ajaran; ?>" required="">
										<?php }?>
										<small class="form-text text-danger"><?= form_error('tahun_ajaran');?></small>
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-md-2 control-label">File Soal Ujian <span class="required">*</span></label>
										<div class="col-md-8">
											<input type="file" name="pdf" class="required" data-style="fileinput"  data-inputsize="medium" required="">
											<p class="help-block">Pdf only (pdf/*) Max Size 1MB</p>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#makul').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>index.php/Soal_ujian/get_kelas",
                method : "POST",
                data : {makul: id},
                async : false,
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value'+data[i].kelas+'>'+data[i].kelas+'</option>';
                    }
                    $('#kelas').html(html);
                     
                }
            });
        });
    });

	document.getElementById("makul").onchange = function () {
		// $('#kelas selected').select2("val", "");
		$("#kelas").select2('val', '');
	}
	document.getElementById("kelas").onchange = function () {
	var count = $('#kelas option:selected').length;
	$("#jml").val(count);
	}
</script>