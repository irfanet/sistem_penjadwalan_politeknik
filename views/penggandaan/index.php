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
								<h4><i class="icon-reorder"></i> DAFTAR SOAL UJIAN MASUK</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable datatable">
									<thead>
										<tr>
											<th width="90">No</th>
											<th>Dosen</th>
											<th>Mata Kuliah</th>
											<th>Kelas</th>
											<!-- <th>Semester</th>
											<th>Tahun Ajaran</th> -->
											<th>File</th>
											<th>Status</th>
											<th width="170">Penggandaan ?</th>
										</tr>
                                    </thead>
                                    <!-- <form method="post" action="<?= base_url()?>penggandaan/update"> -->
									<tbody>
									<?php $no=1; foreach($soal as $m){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $m['nama_singkat']; ?></td>
											<td><?= $m['kelas'] ?></td>
											<td><?= $m['matkul'] ?></td>
											<!-- <td><?= $m['semester'] ?></td>
											<td><?= $m['tahun_ajaran'] ?></td> -->
											<td><a href="<?= base_url(); ?>soal_ujian/lakukan_download/<?= $m['soal']; ?>"><i class="icon-download-alt"></i>Soal</a></td>
											<td align="center">                                                    
												<?php if($m['penggandaan']==0){?>
													<span class="label label-warning">Belum digandakan</span>
												<?php } else {?>
													<span class="label label-success">Sudah digandakan</span>
												<?php }?>
											</td>
											<td align="center">
                                            <!-- <input type="hidden" name="ID_att[]" value="<?php echo $m['id'];?>"> -->
											<a href="<?= base_url()?>penggandaan/update/<?= $m['id']?>"><button class="btn btn-s"><i class="icon-ok"></i></button>

											</td>
										</tr>
                                    <?php } ?>
                                   
                                    </tbody>
                                    
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /Page Content -->

								<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<!-- Row 2 -->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> DAFTAR SOAL YANG SUDAH DIGANDAKAN</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
								<table class="table table-striped table-bordered table-hover table-checkable datatable">
									<thead>
										<tr>
											<th width="90">No</th>
											<th>Dosen</th>
											<th>Mata Kuliah</th>
											<th>Kelas</th>
											<!-- <th>Semester</th>
											<th>Tahun Ajaran</th> -->
											<th>File</th>
											<th>Status</th>
											<th width="170">Undo </th>
										</tr>
                                    </thead>
                                    <!-- <form method="post" action="<?= base_url()?>penggandaan/update"> -->
									<tbody>
									<?php $no=1; foreach($penggandaan as $m){ ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $m['nama_singkat']; ?></td>
											<td><?= $m['kelas'] ?></td>
											<td><?= $m['matkul'] ?></td>
											<!-- <td><?= $m['semester'] ?></td>
											<td><?= $m['tahun_ajaran'] ?></td> -->
											<td><a href="<?= base_url(); ?>soal_ujian/lakukan_download/<?= $m['soal']; ?>"><i class="icon-download-alt"></i>Soal</a></td>
											<td align="center">                                                    
												<?php if($m['penggandaan']==0){?>
													<span class="label label-warning">Belum digandakan</span>
												<?php } else {?>
													<span class="label label-success">Sudah digandakan</span>
												<?php }?>
											</td>
											<td align="center">
                                            <!-- <input type="hidden" name="ID_att[]" value="<?php echo $m['id'];?>"> -->
											<a href="<?= base_url()?>penggandaan/undo/<?= $m['id']?>"><button class="btn btn-s"><i class="icon-remove"></i></button>

											</td>
										</tr>
                                    <?php } ?>
                                   
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