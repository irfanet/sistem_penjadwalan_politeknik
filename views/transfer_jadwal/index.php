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
							<a href="#" title="">Transfer Jadwal</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
            <h3>TRANSFER JADWAL</h3>
            <?php if($this->session->userdata('jabatan') == 'Kajur'){ ?>
					<a href="<?= base_url(); ?>transfer_jadwal/form" class="btn btn-primary"> Upload Excel </a>
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
								<h4><i class="icon-reorder"></i> Transfer Jadwal</h4>
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
                    <th>ID</th>
                    <th>Haritanggal</th>
                    <th>Jam</th>
                    <th>Makul</th>
                    <th>Pengawas</th>
                    <th>Kelas</th>
                    <th>Ruang</th>
                    <th>Kelompok</th>
                  </tr>
                  <tbody>

                  <?php
                  if( ! empty($jadwal)){ 
                    foreach($jadwal as $data){
                      echo "<tr>";
                      echo "<td>".$data->id."</td>";
                      echo "<td>".$data->haritanggal."</td>";
                      echo "<td>".$data->jam."</td>";
                      echo "<td>".$data->makul."</td>";
                      echo "<td>".$data->pengawas."</td>";
                      echo "<td>".$data->kelas."</td>";
                      echo "<td>".$data->ruang."</td>";
                      echo "<td>".$data->kelompok."</td>";

                      echo "</tr>";
                    }
                  }else{
                    echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
                  }
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