<div id="content">
		<!-- Flashdata -->
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>  
		<?php if($this->session->flashdata('flash')): ?>
		
		<?php endif; ?>
		<!-- Akhir Flasdata  -->
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="#">Dashboard</a>
						</li>
						<li class="current">
							<a href="#" title="">Daftar Soal Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR SOAL UJIAN</h3>
					
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<!-- Row 2 -->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> DAFTAR SOAL UJIAN</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable">
									<thead>
										<tr>
											<th width="90">No</th>
											<th>Dosen</th>
											<th>Mata Kuliah</th>
											<th>Kelas</th>
											<th>Semester</th>
											<th>Tahun Ajaran</th>
											<th>File</th>
											<th>Status</th>
											<th width="170">Aksi</th>
										</tr>
                                    </thead>
                                    <form method="post" action="<?= base_url()?>penggandaan/update">
									<tbody>
									<?php $no=1; foreach($soal as $m){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $m['nama_singkat']; ?></td>
											<td><?= $m['kelas'] ?></td>
											<td><?= $m['matkul'] ?></td>
											<td><?= $m['semester'] ?></td>
											<td><?= $m['tahun_ajaran'] ?></td>
											<td><a href="<?= base_url(); ?>soal_ujian/lakukan_download/<?= $m['soal']; ?>"><i class="icon-download-alt"></i>Soal</a></td>
											<td align="center">                                                    
												<?php if($m['penggandaan']==0){?>
													<span class="label label-warning">Belum digandakan</span>
												<?php } else {?>
													<span class="label label-success">Sudah digandakan</span>
												<?php }?>
											</td>
											<td>
                                            <input type="hidden" name="ID_att[]" value="<?php echo $m['id'];?>">
                                                <?php
                                                    if($m['penggandaan']==1){?>
                                                        <input type="radio" name="penggandaan[<?php print $m['id']; ?>]" value="1" checked><span class="btn-success"> Sudah digandakan</span><br>
                                                        <input type="radio" name="penggandaan[<?php print $m['id']; ?>]" value="0"> Belum digandakan<br>
                                                    <?php }else{?>
                                                        <input type="radio" name="penggandaan[<?php print $m['id']; ?>]" value="1"> Sudah digandakan<br>
                                                        <input type="radio" name="penggandaan[<?php print $m['id']; ?>]" value="0" checked><span class="btn-warning">  Belum digandakan</span><br>
                                                    <?php }
                                                
                                                ?>

											</td>
										</tr>
                                    <?php } ?>
                                    <tr>
                                        <!-- <td colspan="7"> </td> -->
                                        <td colspan="9" align="right">
                                            <input class="btn btn-primary" type="submit" value="Simpan"></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>