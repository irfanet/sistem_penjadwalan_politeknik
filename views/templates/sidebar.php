<div id="container">
	<div id="sidebar" class="sidebar-fixed">
		<div id="sidebar-content">

			<!-- Search Input -->
			<form class="sidebar-search">
				<div class="input-box">
					<button type="submit" class="submit">
						<i class="icon-search"></i>
					</button>
					<span>
						<input type="text" placeholder="Search...">
					</span>
				</div>
			</form>

			<!-- Search Results -->
			<div class="sidebar-search-results">

				<i class="icon-remove close"></i>
				<!-- Documents -->
				<div class="title">
					Documents
				</div>
				<ul class="notifications">
					<li>
						<a href="javascript:void(0);">
							<div class="col-left">
								<span class="label label-info"><i class="icon-file-text"></i></span>
							</div>
							<div class="col-right with-margin">
								<span class="message"><strong>John Doe</strong> received $1.527,32</span>
								<span class="time">finances.xls</span>
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);">
							<div class="col-left">
								<span class="label label-success"><i class="icon-file-text"></i></span>
							</div>
							<div class="col-right with-margin">
								<span class="message">My name is <strong>John Doe</strong> ...</span>
								<span class="time">briefing.docx</span>
							</div>
						</a>
					</li>
				</ul>
				<!-- /Documents -->
				<!-- Persons -->
				<div class="title">
					Persons
				</div>
				<ul class="notifications">
					<li>
						<a href="javascript:void(0);">
							<div class="col-left">
								<span class="label label-danger"><i class="icon-female"></i></span>
							</div>
							<div class="col-right with-margin">
								<span class="message">Jane <strong>Doe</strong></span>
								<span class="time">21 years old</span>
							</div>
						</a>
					</li>
				</ul>
			</div> <!-- /.sidebar-search-results -->

			<!--=== Navigation ===-->
			<ul id="nav">
			
				<li class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>">
						<i class="icon-dashboard"></i>
						Dashboard
					</a>
				</li>
			
				<?php
				if ($this->session->userdata('jabatan') == 'Dosen' || $this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi' ) { ?>
				<li class="<?php echo $this->uri->segment(1) == 'soal_ujian' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>soal_ujian">
						<i class="icon-bullhorn"></i>
						DISTRIBUSI SOAL UJIAN
						<span class="label label-info pull-right">
							<?php 
							if ($this->session->userdata('jabatan') == 'Dosen'){
							$CI =& get_instance();
							$CI->load->model('soal_ujian_model');
							$total = $CI->soal_ujian_model->count_notif()->num_rows();
							// $nama=$this->session->userdata('nama');
							// $query = $this->db->query("SELECT * FROM pengampu WHERE kelas NOT IN (SELECT kelas FROM soal_ujian) AND pengampu='$nama' GROUP BY makul");
							// echo $query->num_rows();
							echo $total;
							}else{
								$CI =& get_instance();
								$CI->load->model('soal_ujian_model');
								$banyak = $CI->soal_ujian_model->countSoal()->num_rows();
								echo $banyak;								
							}
							?>
						</span>
					</a>
				</li>
				<?php }?>
				<?php
				if ($this->session->userdata('jabatan') == 'Dosen' || $this->session->userdata('jabatan') == 'Kaprodi' || $this->session->userdata('jabatan') == 'Kajur')  { ?>
				<li class="<?php echo $this->uri->segment(1) == 'jadwal_saya' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>jadwal_saya">
						<i class="icon-list-alt"></i>
						JADWAL SAYA
						<span class="label label-info pull-right">
						<?php 
							$CI =& get_instance();
							$CI->load->model('jadwal_ujian_model');
							$banyak = $CI->jadwal_ujian_model->countJadwal()->num_rows();
							echo $banyak;
							?>
						</span>
					</a>
				</li>
				<?php }?>
				<!-- setting controller di config/routes -->
				<li class="<?php echo $this->uri->segment(1) == 'jadwal_ujian' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>jadwal_ujian"> 
						<i class="icon-table"></i>
						JADWAL UJIAN 
					</a>
				</li>
				<li class="<?php echo $this->uri->segment(1) == 'rekapan_perhari' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>rekapan_perhari"> 
						<i class="icon-paste"></i>
						REKAPAN PERHARI 
					</a>
				</li>
				<li class="<?php echo $this->uri->segment(1) == 'agenda' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>agenda">
						<i class=" icon-bell"> </i>
						AGENDA
					</a>
				</li>

				<li class="<?php echo $this->uri->segment(1) == 'panitia_ujian' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>panitia_ujian">
						<i class="icon-edit"></i>
						DAFTAR PANITIA UJIAN
					</a>
				</li>
				<?php
				if ($this->session->userdata('jabatan') == 'Panitia' || $this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi' ) { ?>
				<li class="<?php echo $this->uri->segment(1) == 'absensi' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>absensi">
						<i class="icon-check"></i>
						ABSENSI DOSEN
						<span class="label label-info pull-right">
						<?php 
							$CI =& get_instance();
							$CI->load->model('cetak_model');
							$all = $CI->cetak_model->countJadwalDosen()->num_rows();
							$done = $CI->cetak_model->countDone();
							$total = $all-$done;
							echo $total;
							?>
						</span>
					</a>
				</li>
				<?php }?>
				<?php
				if ($this->session->userdata('jabatan') == 'Petugas') { ?>
				<li class="<?php echo $this->uri->segment(1) == 'notifikasi' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>notifikasi">
						<i class="icon-bell-alt"></i>
						NOTIFIKASI
					</a>
				</li>
				<li class="<?php echo $this->uri->segment(1) == 'penggandaan' ? 'current': '' ?>">
					<a href="<?= base_url(); ?>penggandaan">
						<i class="icon-copy"></i>
						Penggandaan Soal
						<span class="label label-info pull-right">
						<?php 
							$CI =& get_instance();
							$CI->load->model('soal_ujian_model');
							$banyak = $CI->soal_ujian_model->countSoal()->num_rows();
							echo $banyak;
							?>
						</span>
					</a>
				</li>
				<?php }?>
				
				<?php
				if ($this->session->userdata('jabatan') == 'Dosen' || $this->session->userdata('jabatan') == 'Kajur' || $this->session->userdata('jabatan') == 'Kaprodi') { ?>
				<li class="<?php echo $this->uri->segment(1) == 'data_jurusan' ? 'current': '' ?>">
					<a href="javascript:void(0);">
						<i class="icon-book"></i>
						DATA JURUSAN
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->uri->segment(2) == 'pegawai' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>data_jurusan/pegawai">
								<i class="icon-angle-right"></i>
								DAFTAR DOSEN
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(2) == 'prodi' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>data_jurusan/prodi">
								<i class="icon-angle-right"></i>
								DAFTAR PROGDI
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(2) == 'matkul' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>data_jurusan/matkul">
								<i class="icon-angle-right"></i>
								DAFTAR MATA KULIAH
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(2) == 'kelas' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>data_jurusan/kelas">
								<i class="icon-angle-right"></i>
								DAFTAR KELAS
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(2) == 'ruang_kelas' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>data_jurusan/ruang_kelas">
								<i class="icon-angle-right"></i>
								DAFTAR RUANG KELAS
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(2) == 'pengampu' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>data_jurusan/pengampu">
								<i class="icon-angle-right"></i>
								DAFTAR PENGAMPU
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(2) == 'pengawas_cadangan' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>data_jurusan/pengawas_cadangan">
								<i class="icon-angle-right"></i>
								DAFTAR PENGAWAS CADANGAN
							</a>
						</li>
					</ul>
				</li>
				
				<li class="<?php echo $this->uri->segment(1) == 'endtes' ? 'current': '' ?>">
					<a href="javascript:void(0);">
						<i class="icon-download-alt"></i>
						 ENDTES
					</a>
					<ul class="sub-menu">
						<li class="<?php echo $this->uri->segment(2) == 'cari_jadwal' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>endtes/cari_jadwal">
								<i class="icon-angle-right"></i>
								FORM CARI JADWAL
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(2) == 'pengawas_perhari' ? 'current': '' ?>">
							<a href="<?= base_url(); ?>endtes/pengawas_perhari">
								<i class="icon-angle-right"></i>
								FORM PENGAWAS PERHARI
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>cetak/pengampudanjadwal">
								<i class="icon-angle-right"></i>
								PENGAMPU DAN JADWAL
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>cetak/jadwalperdosen">
								<i class="icon-angle-right"></i>
								JADWAL PER DOSEN
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>cetak/honorPerDosen">
								<i class="icon-angle-right"></i>
								HONOR PER DOSEN
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>cetak/pengambilanberkas">
								<i class="icon-angle-right"></i>
								PENGAMBILAN BERKAS
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>cetak/pengawascadanganperhari">
								<i class="icon-angle-right"></i>
								PENGAWAS CADANGAN PERHARI
							</a>
						</li>
						<li>
							<a href="<?= base_url(); ?>cetak/denahruang">
								<i class="icon-angle-right"></i>
								DENAH RUANG
							</a>
						</li>
					</ul>
				</li>
				<?php }?>
				<?php
				if ($this->session->userdata('jabatan') == 'Kajur') { ?>
					<li class="<?php echo $this->uri->segment(1) == 'setting' ? 'current': '' ?>">
						<a href="<?= base_url(); ?>setting">
							<i class="icon-cog"></i>
							Setting
						</a>
					</li>
				<?php } ?>
				<li>
			</ul>
			

			<!-- /Navigation -->
			<div class="sidebar-title">
				<span>Notifications</span>
			</div>
			<div class="sidebar-widget align-center">
				<div class="btn-group" data-toggle="buttons" id="theme-switcher">
					<label class="btn active">
						<input type="radio" name="theme-switcher" data-theme="bright"><i class="icon-sun"></i> Bright
					</label>
					<label class="btn">
						<input type="radio" name="theme-switcher" data-theme="dark"><i class="icon-moon"></i> Dark
					</label>
				</div>
			</div>

		</div>
		<div id="divider" class="resizeable"></div>
	</div>
	<!-- /Sidebar -->