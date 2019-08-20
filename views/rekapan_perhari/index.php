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
							<a href="<?= base_url()?>">Dashboard</a>
						</li>
						<li class="current">
							<a href="#" title="">Absensi</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>REKAPAN PERHARI</h3>
						<!-- <?php print_r($total)  ;?> -->
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<div class="row">
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Rekapan Per Hari</h4>
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
                                            <th>Haritanggal</th>
											<th>Nama </th>
											<th>Mata Kuliah</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
                                    <?php $no=1;
                                        foreach($rekapan as $k){
                                        ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $k['haritanggal']; ?></td>
											<td><?= $k['pengawas']; ?></td>
											<td><?= $k['makul']; ?></td>
                                                <?php
                                                if($k['absensi'] == NULL){
													echo "<td align='center'><i class='icon-time'></i> Menunggu Panitia</td>";
												}else if($k['absensi']  == 1){
													// $hadir=0;
													echo "<td align='center'><i class='icon-ok'></i></td>";
												}else{
													echo "<td align='center'><i class='icon-remove'></i></td>";
												}?>
											
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
  