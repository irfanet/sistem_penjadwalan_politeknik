<div id="content">
			<div class="container">
				<!-- Breadcrumbs line -->
				<div class="crumbs">
					<ul id="breadcrumbs" class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="index.html">Dashboard</a>
						</li>
						<li class="current">
							<a href="pages_calendar.html" title="">Daftar Program Studi</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
					<?php if($this->session->userdata('jabatan') == 'Kajur'){ ?>
						<a href="<?= base_url(); ?>panitia_ujian/in_tambah" class="btn btn-primary" style="float:ceter;"> Tambah Data</a>
						<?php } ?>
					</div>
				</div>
				<!-- /Page Header -->

				<!--=== Page Content ===-->
				<!--=== Managed Tables ===-->

				<!--=== Normal ===-->
				<div class="row">
					<!--=== Table Classes ===-->
					<div class="col-md-12">
						<div class="widget box">
							<div class="widget-header">
								<h4><i class="icon-reorder"></i> Daftar Panitia Ujian</h4>
								<div class="toolbar no-padding">
									<div class="btn-group">
										<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
									</div>
								</div>
							</div>
							<div class="widget-content no-padding">
								<table class="table table-hover table-striped table-bordered table-highlight-head">
									<thead>
										<tr>
											<th width="370">Jabatan</th>
											<th>Nama</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Kabid Jurusan</td>
											<td>
												<?= $kabid['nama_lengkap']; ?>
												<?php if($cek1>0 && $this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){ ?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $kabid['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a> <p style="float:right;">|</p> <a href="<?= base_url(); ?>panitia_ujian/edit/<?= $kabid['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php } ?>
											</td>
										</tr>
										<tr>
											<td>Sekretaris</td>
											<td>
												<?= $sekretaris['nama_lengkap']; ?>
												<?php if($cek2>0 && $this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){ ?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $sekretaris['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a> <p style="float:right;">|</p> <a href="<?= base_url(); ?>panitia_ujian/edit/<?= $sekretaris['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php } ?>
											</td>
										</tr>
										<tr>
											<td>Pelaksana Administrasi</td>
											<td>
												<?php $no=1; foreach($pa as $p){ ?>
													<?= $no++; ?>. <?= $p['nama_lengkap']; ?> 
													<?php if ($this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $p['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a>
													<a href="<?= base_url(); ?>panitia_ujian/edit/<?= $p['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a>
													<?php }?>
													<br>
												<?php } ?>
											</td>
										</tr>
										<tr>
											<td>Seksi Tempat</td>
											<td>
												<?= $st['nama_lengkap']; ?>
												<?php if($cek3>0 && $this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){ ?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $st['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a> <p style="float:right;">|</p> <a href="<?= base_url(); ?>panitia_ujian/edit/<?= $st['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php } ?>
											</td>
										</tr>
										<tr>
											<td>Koordinator Seksi Pelaksana dan Jadwal</td>
											<td>
												<?= $k_spdj['nama_lengkap']; ?>
												<?php if($cek4>0 && $this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){ ?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $k_spdj['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a> <p style="float:right;">|</p> <a href="<?= base_url(); ?>panitia_ujian/edit/<?= $k_spdj['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php } ?>
											</td>
										</tr>
										<tr>
											<td>Anggota Seksi Pelaksana dan Jadwal</td>
											<td>
												<?php $no=1; foreach($a1 as $a){ ?>
													<?= $no++; ?>. <?= $a['nama_lengkap']; ?> 
													<?php if ($this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $a['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a>
													<a href="<?= base_url(); ?>panitia_ujian/edit/<?= $a['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a><br>
													<?php }?>
												<?php } ?>
											</td>
										</tr>
										<tr>
											<td>Koordinator Seksi Naskah dan Pengepakan</td>
											<td>
												<?= $k_sndp['nama_lengkap']; ?>
												<?php if($cek5>0 && $this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){ ?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $k_sndp['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a> <p style="float:right;">|</p> <a href="<?= base_url(); ?>panitia_ujian/edit/<?= $k_sndp['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php } ?>
											</td>
										</tr>
										<tr>
											<td>Anggota Seksi Naskah dan Pengepakan</td>
											<td>
												<?php $no=1; foreach($a2 as $aa){ ?>
													<?= $no++; ?>. <?= $aa['nama']; ?>
													<?php if ($this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $aa['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a><a href="<?= base_url(); ?>panitia_ujian/edit/<?= $aa['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a><br>
												<?php }
											} ?>
											</td>
										</tr>
										<tr>
											<td>Pembantu Umum</td>
											<td>
												<?php $no=1; foreach($pu as $p2){ ?>
													<?= $no++; ?>. <?= $p2['nama_lengkap']; ?>
													<?php if ($this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi'){?>
													<a href="<?= base_url(); ?>panitia_ujian/hapus/<?= $p2['id']; ?>" class="tombol-hapus"><i class="icon-trash" style="float:right;"></i></a><a href="<?= base_url(); ?>panitia_ujian/edit/<?= $p2['id']; ?>"><i class="icon-pencil" style="float:right;"></i></a><br>
												<?php }
											} ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!-- /Table Classes -->
					<br><br>
				</div>
				<!-- /Page Content -->
			</div>
			<!-- /.container -->

		</div>