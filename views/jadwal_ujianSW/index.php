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
							<a href="#" title="">Daftar Jadwal Ujian</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR JADWAL UJIAN</h3>
						<?php if($mine==0 && $this->session->userdata('jabatan') == 'Kajur'){ ?>
						<!-- <a href="<?= base_url(); ?>jadwal_ujian/in_tambah/<?= $user['id_prodi']; ?>" class="btn btn-primary"> Tambah Data</a> -->
						<a href="<?= base_url(); ?>jadwal_ujian/transfer_jadwal/" class="btn btn-primary"> Tambah Data</a>
						<?php } ?>
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
								<h4><i class="icon-reorder"></i> DAFTAR JADWAL UJIAN</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content">
							<?php if ($mine==1){?>
								<table class="table table-striped table-bordered table-hover table-checkable">
							<?php } else{?>
								<table class="table table-striped table-bordered table-hover table-checkable datatable">
							<?php } ?>
									<thead>
										<tr>
											<th width="70">No</th>
											<th>Haritanggal</th>
											<th>Jam</th>
											<th>Makul</th>
											<th>Pengawas</th>
											<th>Kelas</th>
											<th>Ruang</th>
											<th>Kelompok</th>
											<?php if ($mine==1 || $this->session->userdata('jabatan')=='Kaprodi'){?>
											<th>Kehadiran</th>
											<?php }?>
											<!-- <th width="70">Semester</th> -->
											<!-- <th>Tahun Ajaran</th> -->
										</tr>
									</thead>
									<tbody>
										<?php $no=1; 
										$hadir = 0;
										foreach($jadwal_ujian as $data){ 
										echo "<tr>";
											echo "<td>".$no."</td>";
											echo "<td>".$data->haritanggal."</td>";
											echo "<td>".$data->jam."</td>";
											echo "<td>".$data->makul."</td>";
											echo "<td>".$data->pengawas."</td>";
											echo "<td>".$data->kelas."</td>";
											echo "<td>".$data->ruang."</td>";
											echo "<td>".$data->kelompok."</td>";
											if ($mine==1 || $this->session->userdata('jabatan')=='Kaprodi'){
												if($data->absensi == NULL){
													echo "<td align='center'><i class='icon-time'></i> Menunggu Panitia</td>";
												}else if($data->absensi == 1){
													$hadir++;
													echo "<td align='center'><i class='icon-ok'></i></td>";
												}else{
													echo "<td align='center'><i class='icon-remove'></i></td>";
												}
												
											}
											// echo "<td>".$data->semester.'<br>'.$data->tahun_ajaran."</td>";
											// echo "<td>".$data->tahun_ajaran."</td>";
											$no++; 
										echo "</tr>";
										 ?>

										<?php } ?>
										<?php if($mine==1){
											$gaji=50000;
											$golongan = $this->session->userdata('golongan');
											if($golongan==4){
												$pajak = "15%";
												$pocongan = 0.15*$gaji;
												$penghasilan = ($gaji*$hadir)-($hadir*$pocongan);
											}else{
												$pajak = "5%";
												$pocongan = 0.05*$gaji;
												$penghasilan = ($gaji*$hadir)-($hadir*$pocongan);
											}
											$no--;	
											?>
										<tr>
											<td colspan="8">Kehadiran <?= $hadir.' kali dari '.$no.' jadwal ('.$hadir.' * Rp. 50.000) - '.$pajak.' pajak'?></td>
											<td><?='Rp.' .nominal($penghasilan);?></td>
										</tr>
										<?php }?>
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