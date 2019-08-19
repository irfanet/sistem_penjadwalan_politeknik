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
					<a href="#">Dashboard</a>
				</li>
				<li class="current">
					<a href="#" title="">Daftar Jadwal Dosen</a>
				</li>
			</ul>
		</div>
		<!-- /Breadcrumbs line -->

		<!--=== Page Header ===-->
		<div class="page-header">
			<div class="page-title">
				<h3>DAFTAR DOSEN</h3><br>
				Hasil pencarian kata kunci : <i> <?= $nama_dosen." (".count($lPerDosen).")"; ?> </i>
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
						<table class="table table-striped table-bordered table-hover table-checkable">
							<thead>
								<tr>
									<th>No</th>
									<th>Hari / Tanggal</th>
									<th>Jam</th>
									<th>Mata Kuliah</th>
									<th>Ruang</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 0; $awal=1;
								$lastFrom = null;
								foreach ($lPerDosen as $linePerDosen) { ?>
									<?php
									

									if ($awal == 1) {
										?>
										<tr>
											<td colspan="5" style="height: 40px; font-weight: bold;">
											<?= "Ditemukan : " . $linePerDosen['nama_lengkap']; ?></td>
										</tr>

									<?php
									} else if ($linePerDosen['nama_lengkap'] == $lastFrom) {
										// print_r($linePerDosen);
									}
									else {

										$no=0;
									?>
										<tr>
											<td colspan="5" style="height: 40px; font-weight: bold;">
											<?= "Ditemukan : " . $linePerDosen['nama_lengkap']; ?></td>
										</tr>
									<?php
									}
									// $no=0;
										$awal=0;
										$no++;
										$lastFrom = $linePerDosen['nama_lengkap'];
									?>
								


									
									<tr fontsize="10px">
										<td width="32" align="center"><?php echo $no; ?></td>

										<td width="200"><?php echo $linePerDosen['haritanggal']; ?></td>
										<td width="137" align="center"><?php echo $linePerDosen['jam']; ?></td>
										<td width="180" align="center"><?php echo $linePerDosen['makul']; ?></td>
										<td width="126" align="center"><?php echo $linePerDosen['ruang']; ?></td>
									</tr>
								<?php
								} //akhir dari per dosen
								?>

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