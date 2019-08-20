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
							<a href="pages_calendar.html" title="">Agenda</a>
						</li>
					</ul>
				</div>
				<!-- /Breadcrumbs line -->

				<!--=== Page Header ===-->
				<div class="page-header">
					<div class="page-title">
						<h3>Agenda</h3>
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
								<h4><i class="icon-reorder"></i> Agenda</h4>
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
                                            <th>No</th>
											<th width="370">Kegiatan</th>
											<th>Tanggal</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
                                            <td align="center">1.</td>
											<td><?= $kegiatan[0];?></td>
											<td>
											<?php if(isset($todo0)){
												echo tgl($todo0['tgl']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=0;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek0>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
										</tr>
										<tr>
                                        <td align="center">2.</td>
											<td><?= $kegiatan['1'];?></td>
											<td>
											<?php if(isset($todo1)){
												echo tgl($todo1['tgl']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=1;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek1>0 ){ 
												?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
												
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
										</tr>
										<tr>
                                        <td align="center">3.</td>
											<td><?= $kegiatan['2'];?></td>
											<td>
											<?php if(isset($todo2)){
												echo tgl($todo2['tgl']).' - '.tgl($todo2['tgl_akhir']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=2;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek2>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
										</tr>
										<tr>
                                        <td align="center">4.</td>
											<td><?= $kegiatan['3'];?></td>
											<td>
											<?php if(isset($todo3)){
												echo tgl($todo3['tgl']).' - '.tgl($todo3['tgl_akhir']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=3;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek3>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
										</tr>
										<tr>
                                        <td align="center">5.</td>
											<td><?= $kegiatan['4'];?></td>
											<td>
											<?php if(isset($todo4)){
												echo tgl($todo4['tgl']);	
											} else{
												echo "<center>-</center>";

											}?>
											
												<?php
												$id=4;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek4>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
										</tr>
										<tr>
                                        <td align="center">6.</td>
											<td><?= $kegiatan['5'];?></td>
											<td>
											<?php if(isset($todo5)){
												echo tgl($todo5['tgl']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=5;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek5>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
										</tr>
										<tr>
                                        <td align="center">7.</td>
											<td><?= $kegiatan['6'];?></td>
											<td>
											<?php if(isset($todo6)){
												echo tgl($todo6['tgl']).' - '.tgl($todo6['tgl_akhir']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=6;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek6>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
										</tr>
										<tr>
                                        <td align="center">8.</td>
											<td><?= $kegiatan['7'];?></td>
											<td>
											<?php if(isset($todo7)){
												echo tgl($todo7['tgl']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=7;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek7>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
										</tr>
										<tr>
                                        <td align="center">9.</td>
											<td><?= $kegiatan['8'];?></td>
											<td>
											<?php if(isset($todo8)){
												echo tgl($todo8['tgl']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=8;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek8>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
                                        </tr>
                                        <tr>
                                        <td align="center">10.</td>
											<td><?= $kegiatan['9'];?></td>
											<td>
											<?php if(isset($todo9)){
												echo tgl($todo9['tgl']);	
											} else{
												echo "<center>-</center>";

											}?>
												<?php
												$id=9;
												if( $this->session->userdata('jabatan') == 'Kajur'){

												
												if($cek9>0 ){ ?>
													<a href="<?= base_url(); ?>agenda/edit/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }else{ ?>
													<a href="<?= base_url(); ?>agenda/in_tambah/<?= $id; ?>"><i class="icon-pencil" style="float:right;"></i></a>
												<?php }} ?>
											</td>
											<td align="center"><button class="btn btn-primary" >Ingatkan !</button></td>
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