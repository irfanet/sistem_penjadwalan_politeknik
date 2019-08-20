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
							<a href="<?= base_url();?>">Dashboard</a>
                        </li>
                        <li>
							<a href="<?= base_url();?>absensi">Absensi</a>
						</li>
						<li class="current">
							<a href="#" title="">Cek Kehadiran / Hari</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>CEK KEHADIRAN / HARI</h3>
						<?php echo '<b>Nama Dosen : '.$nama_singkat.'</b>';?>
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
								<h4><i class="icon-reorder"></i> DAFTAR JADWAL</h4>
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
                                            <th>Hari / Tanggal </th>
                                            <th>Jam</th>
                                            <th>Mata Kuliah</th>
                                            <th>Ruang</th>
											<?php if($this->session->userdata('jabatan') != 'Petugas'){ ?>
											<th width="170">Kehadiran</th>
											<?php } ?>
										</tr>
                                    </thead>
                                    <!-- <form method="post" action="<?= base_url()?>absensi/update"> -->
									<tbody>
									<?php
										$hadir=0;
                                        $no=1; foreach($queryPerDosen as $k){ 
                                        if($k['pengawas'] == $nama_singkat){ ?>
										<tr>
											<td><?= $no++;?></td>
											<td><?= $k['haritanggal']; ?></td>
                                            <td><?= $k['jam']; ?></td>
                                            <td><?= $k['makul']; ?></td>
                                            <td><?= $k['ruang']; ?></td>
                                            <?php 
                                            if($k['absensi'] == NULL){
												echo "<td align='center'><i class='icon-time'></i> Menunggu Panitia</td>";
											}else if($k['absensi'] == 1){
												$hadir++;
												echo "<td align='center'><i class='icon-ok'></i></td>";
											}else{
												echo "<td align='center'><i class='icon-remove'></i></td>";
											}

											} ?>
										</tr>
                                    <?php } ?>
                                    <!-- <tr>
                                        <td colspan="5"> </td>
                                        <td><span class="input-group-btn">
                                        <input type="submit">Simpan</button></td>
									</tr> -->
										<?php 
											$gaji=50000;
											// $golongan = $this->session->userdata('golongan');
											if($golongan['golongan']==4){
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
											<td colspan="5">Kehadiran <?= $golongan['golongan']. $hadir.' kali dari '.$no.' jadwal ('.$hadir.' * Rp. 50.000) - '.$pajak.' pajak'?></td>
											<td><?='Rp.' .nominal($penghasilan);?></td>
										</tr>
									
                                    </tbody>
                                    </form>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

    </div>