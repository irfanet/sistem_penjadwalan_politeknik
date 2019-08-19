<div id="content">
    <!-- Flashdata -->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <?php if ($this->session->flashdata('flash')) : ?>


    <?php endif; ?>
    <!-- Akhir Flasdata  -->
    <div class="container">
       	<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="<?= base_url(); ?>">Dashboard</a>
						</li>
						<li class="current">
							<a href="#" title="">Import Mata Kuliah</a>
						</li>
					</ul>
				</div>
        <!-- /Breadcrumbs line -->

        <!--=== Page Header ===-->
        <div class="page-header">
            <div class="page-title">
                <h3>IMPORT MATA KULIAH</h3>
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
                        <h4><i class="icon-reorder"></i> Form Import Mata Kuliah</h4>
                    </div>
                    <div class="widget-content">
                        <form class="form-horizontal row-border" method="post" action='<?= base_url("matkul/import") ?>' enctype="multipart/form-data">
                            <?php
                            foreach ($set as $hasil) { ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Semester :</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="semester" required="" disabled>
                                        <option value="" disabled>-- Silahkan Pilih --</option>
                                        <option value=""><?= $hasil->semester ?></option>
                                        <option value="Ganjil">Ganjil</option>
                                        <option value="Genap">Genap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tahun Ajaran :</label>
                                <div class="col-md-4"><input type="text" name="tahun_ajaran" title="Tooltip on focus" value="<?= $hasil->tahun_ajaran ?>" disabled class="form-control bs-focus-tooltip" required="">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label">File Mata Kuliah <span class="required">*</span></label>
                                <div class="col-md-8">
                                    <input type="file" name="file" accept=".csv" class="required" data-style="fileinput" data-inputsize="medium" required=""></small>
                                    <p class="help-block">CSV only (csv/*)</p>
                                    <label for="file" class="has-error help-block" generated="true" style="display:none;"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <button type="submit" name="import" class="btn btn-primary">Simpan</button>
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