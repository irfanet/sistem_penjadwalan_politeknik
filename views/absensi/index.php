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
						<h3>DAFTAR ABSENSI</h3>
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
								<h4><i class="icon-reorder"></i> DAFTAR DOSEN</h4>
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
											<th>Nama </th>
											<th>Program Studi</th>
											
											<th>Status</th>
											<th width="170">Aksi</th>
										
										</tr>
									</thead>
									<tbody>
                  <?php $no=1;
					foreach($querydosen as $k){
					?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $k['nama_lengkap']; ?></td>
											<td><?= $k['namaprodi']; ?></td>
											<?php $id=$k['id'];
											$gap = $total[$id] - $temp[$id];
											?>
											<td align="center"><?php if($temp[$id]==0 && $total[$id]!=0){
												echo "<span class='label label-success'>Absensi Selesai</span>
												<br><span class='label label-success'>Jumlah $total[$id]</span>";
											}else if($temp[$id]==0  && $total[$id]==0){
												echo "<span class='label label-default'>Tidak ada Jadwal</span>";
											}else if($temp[$id]!=$total[$id]){
												echo "<span class='label label-info'>Belum Selesai</span>
												<br><span class='label label-info'>$gap dari $total[$id]</span>";
											}else if($temp[$id]==$total[$id]){
												echo "<span class='label label-warning'>Belum Absensi</span>";
											}; 
											?></td>
											<td class="text-center">
												<?php if ($this->session->userdata('jabatan')=='Panitia'){?>
													<a href="<?= base_url(); ?>absensi/kehadiran/<?= $k['nama_singkat']; ?>" class="btn btn-sm btn-primary">Absensi</a>
												<?php }?>
													<a href="<?= base_url(); ?>absensi/cek/<?= $k['nama_singkat']; ?>" class="btn btn-sm btn-success">Lihat</a>
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
  