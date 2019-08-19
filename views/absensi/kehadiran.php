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
							<a href="#" title="">Daftar Kehadiran / Hari</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>DAFTAR KEHADIRAN / HARI</h3>
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
                                    <form method="post" action="<?= base_url()?>absensi/update">
									<tbody>
                                    <?php 
                                        $no=1; foreach($queryPerDosen as $k){ 
                                        if($k['pengawas'] == $nama_singkat){ ?>
										<tr>
											<td><?= $no++?></td>
											<td><?= $k['haritanggal']; ?></td>
                                            <td><?= $k['jam']; ?></td>
                                            <td><?= $k['makul']; ?></td>
											<td><?= $k['ruang']; ?></td>
											<?php if($this->session->userdata('jabatan') != 'Petugas'){ ?>
											<td>
                                                <input type="hidden" name="ID_att[]" value="<?php echo $k['id_jadwal'];?>">
                                                <?php if ($k['absensi']==1){?>
                                                    <input type="radio" name="kehadiran[<?php print $k['id_jadwal']; ?>]" value="1" checked> Hadir<br>
                                                    <input type="radio" name="kehadiran[<?php print $k['id_jadwal']; ?>]" value="0"> Tidak Hadir<br>
                                                <?php } elseif($k['absensi']==NULL){?>
                                                    <input type="radio" name="kehadiran[<?php print $k['id_jadwal']; ?>]" value="1"> Hadir<br>
                                                    <input type="radio" name="kehadiran[<?php print $k['id_jadwal']; ?>]" value="0"> Tidak Hadir<br>
                                                <?php } else{?>
                                                    <input type="radio" name="kehadiran[<?php print $k['id_jadwal']; ?>]" value="1"> Hadir<br>
                                                    <input type="radio" name="kehadiran[<?php print $k['id_jadwal']; ?>]" value="0" checked> Tidak Hadir<br>
                                                <?php }?>
											</td>
											<?php }} ?>
										</tr>
                                    <?php } ?>
                                    <tr>
                                        <!-- <td colspan="5"> </td> -->
                                        <td colspan="6" align="right">
                                        <input class="btn btn-primary" type="submit" value="Simpan"></button></td>
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