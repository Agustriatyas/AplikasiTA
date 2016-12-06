<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/style.css">
	<script type="text/javascript" src="../../assets/jquery_easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../../assets/jquery_easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="../../assets/libs_js/user.js"></script>
	<?php //ambil dari portal ?>
	<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/bootstrap.min.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/style.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/flexslider.css' type='text/css' media='all' />
	<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/datepicker.css' type='text/css' media='all' />
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery.js'></script>
	<?php //footer ?>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/bootstrap.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/main.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/flexslider.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/validator.js'></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery.mask.min.js'></script>

<h2>EDIT PERMOHONAN</h2>
	<?php
		//load Header (Tag Open Html, Body, css file .etc)
		//$this->load->view('front/templates/layout_header');
		
		$posisi = $this->session->userdata('posisi');
		
		$status_posisi = array();
		$status_posisi['1'] = 'Direktur';
		$status_posisi['2'] = 'Pemegang Saham';
		$status_posisi['3'] = 'Kuasa';
		$status_posisi['4'] = 'Direktur Utama';
		$status_posisi['5'] = 'Pemilik';
		$status_posisi['6'] = 'Ketua';
		$status_posisi['7'] = 'Karyawan';
		
	?>
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-success  alert-dismissable">
			</div>	
		</div>
		<div class="col-xs-12">
			<?php $success_message = $this->session->flashdata('success_message');?>
			<?php if ($success_message):?>
				<div class="alert alert-success  alert-dismissable">
					<i class="fa fa-check"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Sukses - </b> <?php echo $this->session->flashdata('message'); ?>
				</div>
			<?php endif?>
			<?php $error_message = $this->session->flashdata('error_message');?>
				<?php if ($error_message):?>
				<div class="alert alert-danger  alert-dismissable">
					<i class="fa fa-ban"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<?php echo $this->session->flashdata('message'); ?>
				</div>
			<?php endif?>
		</div>
	</div>
	<div>
		<form class="form-horizontal" method="POST" role="form" data-toggle="validator" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/front_office/pemohon/insert">
			<!-- begin jj : id for update-->
			<input type="hidden" name="id_perm" value="<?php echo($data_edit!='' ? $data_edit->id_perm : ''); ?>">
			<input type="hidden" name="id_pemohon" value="<?php echo($data_edit!='' ? $data_edit->id_pemohon : ''); ?>">
			<input type="hidden" name="id_perusahaan" value="<?php echo($data_edit!='' ? $data_edit->id_perusahaan : ''); ?>">
			<input type="hidden" name="id_lokasi" value="<?php echo($data_edit!='' ? $data_edit->id_lokasi : ''); ?>">
			<input type="hidden" name="id_syarat" value="<?php echo($data_edit!='' ? $data_edit->id_syarat : ''); ?>">
			<!--end jj--> 
			<div class="col-xs-12">
				<div class="form-group">
					<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Permohonan</label>
					<label class="col-sm-1 control-label">:</label>
					<div class="col-sm-2">
						<!--select name="jenis_izin" id="jenis_izin" class="form-control" onchange="GetSyarat(this)" required>
							<option value=""></option>
							<?php //foreach($jns_permohonan as $p): ?>
								<option value="<?php //echo $p->id;?>"><?php //echo $p->jenis_permohonan;?></option>
							<?php //EndForeach; ?>
						</select-->

						<select class="form-control" name="id_propinsi" onchange="GetSyarat(this)">
						<?php //$combo = array(
						// 				 ""=>"",
      //                                   "Mendirikan"=>"Mendirikan",
      //                                   "Memperluas"=>"Memperluas",
      //                                   "Memperbaiki"=>"Memperbaiki",
      //                                   "Mendirikan & Memperluas"=>"Mendirikan & Memperluas",
      //                                   "Mendirikan & Memperbaiki"=>"Mendirikan & Memperbaiki",
      //                                   "Memperluas & Memperbaiki"=>"Memperluas & Memperbaiki",
      //                                   "Mendirikan, Memperluas & Memperbaiki"=>"Mendirikan, Memperluas & Memperbaiki",
						// ); 
						?>
	                    <?php if ($combo): ?> 
	                        <?php foreach ($combo as $row): ?> 
	                            <?php if ($row->jenis_permohonan == $data_edit->jenis_permohonan): ?> 
	                                <?php $selected = 'selected="selected"' ?> 
	                            <?php else : ?> 
	                                <?php $selected = '' ?> 
	                            <?php endif; ?> 
	                            <!--option value="<?php //echo $row['jenis_permohonan'] ?>" <?php //echo $selected ?> ><?php //echo $row['jenis_permohonan'] ?></option--> 
	                        	
	                            <option value="<?php echo $row->id; ?>" <?php echo $selected ?> ><?php echo $row->jenis_permohonan; ?></option>
	                        <?php endforeach ?> 
	                    <?php endif ?>
	                </select>
	                <?php //echo form_error('id_propinsi'); ?>

					</div>
					<?php 
						// $jenis_izin1 = array(
						// 				""=>"",
      //                                   "1"=>"Direktur",
      //                                   "2"=>"Pemegang Saham",
      //                                   "3"=>"Kuasa",
      //                                   "4"=>"Direktur Utama",
      //                                   "5"=>"Pemilik",
      //                                   "6"=>"Ketua",
      //                                   "7"=>"Karyawan",
						// 	);

						// // echo form_dropdown('jenis_izin', $jenis_izin, $jenis_izin1);
						// echo form_dropdown('jenis_izin', $jenis_izin, $jenis_izin1);
					 ?>
				</div>
				<div class="form-group">
					<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Peruntukan</label>
					<label class="col-sm-1 control-label">:</label>
					<div class="col-sm-5">
						<input type="text" name="jns_peruntukan" id="jns_peruntukan" required value="<?php echo($data_edit!='' ? $data_edit->peruntukan : ''); ?>"/>
					</div>
				</div>

				<div class="nav-tabs-custom col-sm-12 no-padding">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#a" data-toggle="tab">Data Pemohon</a></li>
						<li><a href="#b" data-toggle="tab">Data Perusahaan</a></li>
						<li><a href="#d" data-toggle="tab">Lokasi Izin</a></li>
						<li><a href="#c" data-toggle="tab">Persyaratan</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane col-sm-12 active" id="a" style="padding-top:20px;">
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Identitas</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-2">
								<?php $selected = 'selected="selected"' ?>	
								
									<select name="source"  id="source" required>
										<option></option>
										<option value="KTP" value="<?php echo($data_edit!='' ? $data_edit->jenis_identitas : ''); ?>" <?php if ($data_edit->jenis_identitas == 'KTP'): ?>  <?php echo $selected ?><?php endif; ?>>KTP</option>
										<option value="SIM" value="<?php echo($data_edit!='' ? $data_edit->jenis_identitas : ''); ?>"<?php if ($data_edit->jenis_identitas == 'SIM'): ?>  <?php echo $selected ?><?php endif; ?>>SIM</option>
										<option value="PASSPORT" value="<?php echo($data_edit!='' ? $data_edit->jenis_identitas : ''); ?>"<?php if ($data_edit->jenis_identitas == 'PASSPORT'): ?>  <?php echo $selected ?><?php endif; ?>>PASSPORT</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nomor Identitas</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" name="no_referensi" id="no_referensi" required value="<?php echo($data_edit!='' ? $data_edit->no_identitas : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">NPWP</label>
								<label for="nama_lengkap" class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" npwp" name="npwp_pemohon" id="npwp" onkeypress="validasi_npwp(event,this)" value="<?php echo($data_edit!='' ? $data_edit->npwp_pemohon : ''); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nama Lengkap</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" name="nama_lengkap" id="nama_lengkap" required value="<?php echo($data_edit!='' ? $data_edit->nama_lengkap : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<!-- begin jj-->
								<?php $checked = 'checked="checked"' ?>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Kelamin</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Pria" required <?php if ($data_edit->jk == 'Pria'): ?> <?php echo $checked ?><?php endif; ?>/> Pria
									</label>
									<label class="radio-inline">
										<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Wanita" required <?php if ($data_edit->jk == 'Wanita'): ?> <?php echo $checked ?><?php endif; ?>/> Wanita
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Posisi Pemohon</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
								<!-- begin jj-->
									<?php $selected = 'selected="selected"' ?> 
								<!-- end jj-->
									<select name="posisi" id="posisi" required>
										<option value=""></option>
										<option value="Direktur" <?php if ($data_edit->posisi_pemohon == 'Direktur'): ?> <?php echo $selected ?><?php endif;?>>Direktur</option>
										<option value="Pemegang Saham" <?php if ($data_edit->posisi_pemohon == 'Pemegang Saham') : ?> <?php echo $selected ?><?php endif; ?>>Pemegang Saham</option>
										<option value="Kuasa" <?php if ($data_edit->posisi_pemohon == 'Kuasa') : ?> <?php echo $selected ?><?php endif; ?>>Kuasa</option>
										<option value="Direktur Utama" <?php if ($data_edit->posisi_pemohon == 'Direktur Utama') : ?> <?php echo $selected ?><?php endif; ?>>Direktur Utama</option>
										<option value="Pemilik" <?php if ($data_edit->posisi_pemohon == 'Pemilik') : ?> <?php echo $selected ?><?php endif; ?>>Pemilik</option>
										<option value="Ketua" <?php if ($data_edit->posisi_pemohon == 'Ketua') : ?> <?php echo $selected ?><?php endif; ?>>Ketua</option>
										<option value="Karyawan" <?php if ($data_edit->posisi_pemohon == 'Karyawan') : ?> <?php echo $selected ?><?php endif; ?>>Karyawan</option>
									</select>
								</div>
							</div>
							<!--div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nomor Handphone</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<input type="text" class="form-control handphone" name="no_hp_pemohon" id="no_hp" required/>
								</div>
							</div-->
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">No Telp / HP</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<input type="text" class="phone" name="no_telp_pemohon" id="no_telp" required value="<?php echo($data_edit!='' ? $data_edit->telp_pemohon : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Email</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" name="email_pemohon" id="email" required value="<?php echo($data_edit!='' ? $data_edit->email : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Alamat Lengkap</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<textarea name="alamat_pemohon" id="alamat" rows="3" required><?php echo($data_edit!='' ? $data_edit->alamat : ''); ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="provinsi" class="col-sm-2 control-label text-left-imp">Provinsi</label>
								<label for="provinsi" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="provinsi_pemohon" id="provinsi_pemohon" required>
										<option value=""></option>
										<?php foreach($propinsi as $p): ?>
											<option value="<?php echo $p->id_prop;?>" <?php if ($p->id_prop == $data_edit->id_prop): ?> selected <?php endif; ?>><?php echo $p->nama_prop;?></option>
										<?php EndForeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kab_kot" class="col-sm-2 control-label text-left-imp">Kabupaten/ Kota</label>
								<label for="kab_kot" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<!-- begin jj-->
									<input type="hidden" name="hdnKabupaten_pemohon" id="hdnKabupaten_pemohon" value="<?php echo $data_edit->id_kab;?>">
									<!-- end jj-->
									<select name="kabupaten_pemohon" id="kabupaten_pemohon" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kecamatan</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
								<!-- begin jj-->
								<input type="hidden" name="hdnKecamatan_pemohon" id="hdnKecamatan_pemohon" value="<?php echo $data_edit->id_kec;?>">
								<!-- end jj-->
									<select name="kecamatan_pemohon" id="kecamatan_pemohon" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kelurahan/ Desa</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
								<!-- begin jj-->
								<input type="hidden" name="hdnKelurahan_pemohon" id="hdnKelurahan_pemohon" value="<?php echo $data_edit->id_kel;?>">
								<!-- end jj-->
									<select name="kelurahan_pemohon" id="kelurahan_pemohon" required>
										<option></option>
									</select>
								</div>
							</div>
						</div>
						<div class="tab-pane col-sm-12" id="b" style="padding-top:20px;">
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nomor NPWP</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="npwp" name="npwp_perusahaan" id="npwp_perusahaan" onkeypress="validasi_npwp(event,this)" required value="<?php echo($data_edit!='' ? $data_edit->npwp_perusahaan : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nama Perusahaan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" name="n_perusahaan" id="n_perusahaan" required value="<?php echo($data_edit!='' ? $data_edit->nama_perusahaan : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Bidang Usaha</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
								<!-- begin jj-->
								<?php if ($data_edit->bid_usaha == 'Industry'): ?> 
										<?php $selected = 'selected="selected"' ?> 
								<?php elseif ($data_edit->bid_usaha == 'Non Industri') : ?> 
									<?php $selected = 'selected="selected"' ?> 
								<?php else : ?> 
									<?php $selected = '' ?> 
								<?php endif; ?>
								<!-- end jj-->
									<select name="bidang_usaha" id="bidang_usaha" required>
										<option value="" <?php echo $selected ?>></option>
										<option value="Industry" <?php echo $selected ?>>Industry</option>
										<option value="Non Industri" <?php echo $selected ?>>Non Industri</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Status Investasi</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
								<!-- begin jj-->
									<?php if ($data_edit->status_investasi == 'PMA/FDI'): ?> 
											<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->status_investasi == 'PMDN/DDI') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php else : ?> 
										<?php $selected = '' ?> 
									<?php endif; ?>
								<!-- end jj-->
									<select name="status_modal" id="status_modal" required>
										<option value="" <?php echo $selected ?>></option>
										<option value="PMA/FDI" <?php echo $selected ?>>PMA/FDI</option>
										<option value="PMDN/DDI" <?php echo $selected ?>>PMDN/DDI</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Badan Hukum</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
								<!-- begin jj-->
									<?php if ($data_edit->badan_hukum == 'Perseroan Terbatas'): ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Koperasi') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Perusahaan Umum') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Perusahaan Perseroan') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Perusahaan Perorangan') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Persekutuan') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Persekutuan Komanditer') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Persekutuan Perdata') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Yayasan') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Perusahaan Daerah') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Baitul Maal Wat Tamwil') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php elseif ($data_edit->badan_hukum == 'Perorangan') : ?> 
										<?php $selected = 'selected="selected"' ?> 
									<?php else : ?> 
										<?php $selected = '' ?> 
									<?php endif; ?>
								<!-- end jj-->
									<select name="badan_hukum" id="badan_hukum" required>
										<option value="" <?php echo $selected ?>></option>
										<option value="Perseroan Terbatas" <?php echo $selected ?>>Perseroan Terbatas</option>
										<option value="Koperasi" <?php echo $selected ?>>Koperasi</option>
										<option value="Perusahaan Umum" <?php echo $selected ?>>Perusahaan Umum</option>
										<option value="Perusahaan Perseroan" <?php echo $selected ?>>Perusahaan Perseroan</option>
										<option value="Perusahaan Perorangan" <?php echo $selected ?>>Perusahaan Perorangan</option>
										<option value="Persekutuan" <?php echo $selected ?>>Persekutuan</option>
										<option value="Persekutuan Komanditer" <?php echo $selected ?>>Persekutuan Komanditer</option>
										<option value="Persekutuan Perdata" <?php echo $selected ?>>Persekutuan Perdata</option>
										<option value="Yayasan" <?php echo $selected ?>>Yayasan</option>
										<option value="Perusahaan Daerah" <?php echo $selected ?>>Perusahaan Daerah</option>
										<option value="Baitul Maal Wat Tamwil" <?php echo $selected ?>>Baitul Maal Wat Tamwil</option>
										<option value="Perorangan" <?php echo $selected ?>>Perorangan</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nilai Investasi</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="number" class="uang" min="1" name="investasi" id="investasi" placeholder="" required value="<?php echo($data_edit!='' ? $data_edit->nilai_investasi : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jumlah Tenaga Kerja</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-2">
									<input type="number" min="0" name="jumlah_tk" id="jumlah_tk"  value="<?php echo($data_edit!='' ? $data_edit->jumlah_tk : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nomor Telepon</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control phone" name="no_telp_perusahaan" id="no_telp" value="<?php echo($data_edit!='' ? $data_edit->telp_perusahaan : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Email</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="email" name="email_perusahaan" id="email"  required value="<?php echo($data_edit!='' ? $data_edit->email_pr : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Website</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" name="website" id="webisite" value="<?php echo($data_edit!='' ? $data_edit->website : ''); ?>"/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Alamat Lengkap</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<textarea name="alamat_perusahaan" id="alamat_perusahaan" rows="3" required><?php echo($data_edit!='' ? $data_edit->alamat_pr : ''); ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="provinsi" class="col-sm-2 control-label text-left-imp">Provinsi</label>
								<label for="provinsi" class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<select name="provinsi_perusahaan" id="provinsi_perusahaan" required>
										<option value=""></option>
										<?php foreach($propinsi as $p): ?>
											<option value="<?php echo $p->id_prop;?>" <?php if ($p->id_prop == $data_edit->id_prop_pr): ?> selected <?php endif; ?>><?php echo $p->nama_prop;?></option>
										<?php EndForeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kab_kot" class="col-sm-2 control-label text-left-imp">Kabupaten/ Kota</label>
								<label for="kab_kot" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
								<!-- begin jj-->
								<input type="hidden" name="hdnKabupaten_perusahaan" id="hdnKabupaten_perusahaan" value="<?php echo $data_edit->id_kab_pr;?>">
								<!-- end jj-->
									<select name="kabupaten_perusahaan" id="kabupaten_perusahaan" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kecamatan</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
								<!-- begin jj-->
								<input type="hidden" name="hdnKecamatan_perusahaan" id="hdnKecamatan_perusahaan" value="<?php echo $data_edit->id_kec_pr;?>">
								<!-- end jj-->
									<select name="kecamatan_perusahaan" id="kecamatan_perusahaan" required>
				
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kelurahan/ Desa</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
								<!-- begin jj-->
								<input type="hidden" name="hdnKelurahan_perusahaan" id="hdnKelurahan_perusahaan" value="<?php echo $data_edit->id_kel_pr;?>">
								<!-- end jj-->
									<select name="kelurahan_perusahaan" id="kelurahan_perusahaan" required>
										
									</select>
								</div>
							</div>
						</div>
						<?php //Lokasi izin ?>

						<div class="tab-pane col-sm-12" id="d" style="padding-top:20px;">
						<div class="form-group">
							<label for="provinsi" class="col-sm-2 control-label text-left-imp">Provinsi</label>
								<label for="provinsi" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="provinsi_izin" id="provinsi_izin" required>
										<option value=""></option>
										<?php foreach($propinsi as $p): ?>
											<option value="<?php echo $p->id_prop;?>" <?php if ($p->id_prop == $data_edit->id_prop_lok): ?> selected <?php endif; ?>><?php echo $p->nama_prop;?></option>
										<?php EndForeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kab_kot" class="col-sm-2 control-label text-left-imp">Kabupaten/ Kota</label>
								<label for="kab_kot" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
								<!-- begin jj-->
								<input type="hidden" name="hdnKabupaten_izin" id="hdnKabupaten_izin" value="<?php echo $data_edit->id_kab_lok;?>">
								<!-- end jj-->
									<select name="kabupaten_izin" id="kabupaten_izin" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kecamatan</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
								<!-- begin jj-->
								<input type="hidden" name="hdnKecamatan_izin" id="hdnKecamatan_izin" value="<?php echo $data_edit->id_kec_lok;?>">
								<!-- end jj-->
									<select name="kecamatan_izin" id="kecamatan_izin" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kelurahan/ Desa</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
								<!-- begin jj-->
								<input type="hidden" name="hdnKelurahan_izin" id="hdnKelurahan_izin" value="<?php echo $data_edit->id_kel_lok;?>">
								<!-- end jj-->
									<select name="kelurahan_izin" id="kelurahan_izin" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="alamat_izin" class="col-sm-2 control-label text-left-imp">Alamat Lengkap</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<textarea name="alamat_izin" id="alamat" rows="3" required><?php echo($data_edit!='' ? $data_edit->alamat_lengkap : ''); ?></textarea>
								</div>
							</div>
						</div>


						<div class="tab-pane col-sm-12" id="c" style="padding-top:20px;">
						<!--div class="tab-pane col-sm-12 active" id="c" style="padding-top:20px;display:none;">
							<div class="form-group"-->
								<!--table border='1' id="mytablesyarat" class="form-group" style="display:none;"-->
								<table border='1' class="form-group">
									<thead>
										<tr>
											<td align="center"><label>No.</label></td>
											<td align="center"><label>Syarat<label></td>
											<!--td align="center"><label>ID Syarat<label></td-->
											<td align="center"><label>Terpenuhi<label></td>
										</tr>
										<tr>
											<td align="center">1</td>
											<td>Formulir permohonan IMBG bermaterai cukup</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
										<tr>
											<td align="center">2</td>
											<td>Foto copy Analisis Mengenai Dampak Lingkungan Hidup (AMDAL) atau Upaya Pengelolaan Lingkungan Hidup dan Upaya Pemantauan Lingkungan Hidup (UKL/UPL) atau Surat Pernyataan Pengelolaan Lingkungan Hidup (SPPL) dari Badan Lingkungan Hidup, kecuali untuk bangunan fungsi keagamaan dan fungsi hunian rumah tinggal tunggal</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
										<tr>
											<td align="center">3</td>
											<td>Surat Pendaftaran Obyek Rettribusi Daerah(SPdORD)</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
										<tr>
											<td align="center">4</td>
											<td>Persetujuan warga yang dilengkapi oleh fotocopy KTP warga yang diketahui RT,RW, Lurah/Kepala Desa dan Camat setempat, kecuali untuk rumah tinggal</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
										<tr>
											<td align="center">5</td>
											<td>Fotocopy sertifikat / Akta Jual Beli / Hibah / Keterangan Kepemilikan Tanah</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
										<tr>
											<td align="center">6</td>
											<td>Gambar Konstruksi Bangunan</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
										<tr>
											<td align="center">7</td>
											<td>Surat Izin Pemakaian Tanah (bagi pendaftar yang menggunakan tanah hak milik orang lain)</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
										<tr>
											<td align="center">8</td>
											<td>Dalam hal pendaftar yang menggunakan tanah negara, tanaha pemerintah / desa dapat diberi izin sepanjang telah mendapatkan izin dari pemilik tanah yang sah</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
										<tr>
											<td align="center">9</td>
											<td>Izin Peruntukan Penggunaan Tanah,penetapan lokasi, dan/atau Izin Lokasi</td>
											<td align="center"><input type="checkbox" checked="checked"></td>
										</tr>
									</thead>
								 	<tbody>
								 	</tbody>
								</table>

							
							<br/>
							<br/>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">
									<button value="save" name="submit">Daftar</button>
									<!--input type='submit' value='Daftar'-->
									<!--<a href="<?php// echo base_url();?>signin" class="btn btn-default">Reset</a>-->
									<!--begin jj-->
									<button type="reset" name="reset">Reset</button>
									<!--end jj-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>	
	<script type="text/javascript">
		/**
		 * Fungsi ini digunakan untuk membuat format NPWP
		 */
		function validasi_npwp(event,e){
			$val = e.value;
			$length = $val.length;
			if (event.keyCode == 8 || event.keyCode == 9) {
			
			}
			else{

				if ($length == 2 || $length == 6 || $length == 10 || $length == 16) {
					e.value += ".";
				};
				if ($length == 12) {
						e.value += "-";
				};
			}
		}

		/**
		 * Fungsi ini digunakan untuk mengambil data data syarat yang akan dilempar ke controllers
		 * front_office /pemohon/send dan menangkap kembali hasilnya
		 */
		function GetSyarat(elem){ 
			var id = elem.value;
			// var site = "<?php echo base_url();?>";
			$("tbody").children().remove();
			$.ajax({
				url : '<?php echo base_url();?>index.php/front_office/pemohon/send/'+id,
				dataType :'json',
				success : function(data){
					var rows = "";
					$.each(data, function(index, item){
						/*if(data[1].stat == 1){
							var checked = "checked";
						}else{
							var checked = "";
						}*/
						rows += "<tr>";
							rows += "<td align='center'>"+index+"</td>";
							rows += "<td>"+item['syarat']+"</td>";
							//rows += "<td align='center'>"+item['id']+"</td>";
							rows += "<td align='center'><input type='checkbox' name='checkbox[]' value='"+item['syarat']+"' ></td>";
							//rows += "<td><input type='checkbox' onchange='displayResult(this.form)' value='item['id']'></td>";
						rows += "</tr>";
						// console.log(item['syarat']);
					});
					$(rows).appendTo("#mytablesyarat tbody");
					document.getElementById('mytablesyarat').style.display="block";
				},
			});
			// console.log(elem.value);
		}

		/**
		 * Fungsi ini digunakan untuk menangkap data kabupaten berdasarkan propinsi (ID) yang diambil dari
		 * controllers front_office/pemohon/kabupaten
		 */		
		function GetProvinsi(name){
			/*begin jj*/
			$(document).ready(function(){
				var id = $('#provinsi_'+name).val();
				var aId_kab = $('#hdnKabupaten_'+name).val();
				
				$('#kabupaten_'+name+',#kecamatan_'+name+',#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kabupaten',
					dataType: "html",
					type: 'POST',
					data: {
						"id"		: id,
						"aId_kab"	: aId_kab
					} ,
					async: false,
					success:function(data){
						$('#kabupaten_'+name).html(data);
					}
				});
			});
			/*end jj*/
			
			// 
			$('#provinsi_'+name).change(function(){
				var id = $(this).val();
				var aId_kab = $('#hdnKabupaten_'+name).val();
				$('#kabupaten_'+name+',#kecamatan_'+name+',#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kabupaten',
					dataType:'html',
					type: 'POST',
					data: {
						"id"		: id,
						"aId_kab"	: aId_kab
					} ,
					async: false,
					success:function(data){
						$('#kabupaten_'+name).html(data);
					}
				});
			});
			// 
		}

		function GetKel(name){
			$('#provinsi_'+name).change(function(){
				var id = $(this).val();
				$('#kabupaten_'+name+',#kecamatan_'+name+',#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>signin/kec_izin/'+id,
					dataType:'html',
					async: false,
					success:function(data){
						$('#kabupaten_'+name).html(data);
					}
				});
			});
		}

		/**
		 * Fungsi ini digunakan untuk menangkap data kecamatan berdasarkan kabupaten (ID) yang diambil dari
		 * controllers front_office/pemohon/kecamatan
		 */		
		function GetKabupaten(name){
			/*begin jj*/
			$(document).ready(function(){
				var id = $('#kabupaten_'+name).val();
				var aId_kec = $('#hdnKecamatan_'+name).val();
				
				$('#kecamatan_'+name+',#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kecamatan',
					dataType:'html',
					type: 'POST',
					data: {
						"id"		: id,
						"aId_kec"	: aId_kec
					} ,
					async: false,
					success:function(data){
						console.log(data);
						$('#kecamatan_'+name).html(data);
					}
				});
			});
			/*end jj*/

			$('#kabupaten_'+name).change(function(){
				var id = $(this).val();
				var aId_kec = $('#hdnKecamatan_'+name).val();
				$('#kecamatan_'+name+',#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kecamatan',
					dataType:'html',
					type: 'POST',
					data: {
						"id"		: id,
						"aId_kec"	: aId_kec
					} ,
					async: false,
					success:function(data){
						$('#kecamatan_'+name).html(data);
					}
				});
			});
		}
		
		/**
		 * Fungsi ini digunakan untuk menangkap data kelurahan berdasarkan kecamatan (ID) yang diambil dari
		 * controllers front_office/pemohon/kecamatan
		 */		
		function GetKecamatan(name){
			/*begin jj*/
			$(document).ready(function(){
				var id = $('#kecamatan_'+name).val();
				var aId_kel = $('#hdnKelurahan_'+name).val();
				$('#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kelurahan',
					dataType:'html',
					type: 'POST',
					data: {
						"id"		: id,
						"aId_kel"	: aId_kel
					} ,
					async: false,
					success:function(data){
						$('#kelurahan_'+name).html(data);
					}
				});
			});

			$('#kecamatan_'+name).change(function(){
				var id = $(this).val();
				var aId_kel = $('#hdnKelurahan_'+name).val();
				$('#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kelurahan',
					dataType:'html',
					type: 'POST',
					data: {
						"id"		: id,
						"aId_kel"	: aId_kel
					} ,
					async: false,
					success:function(data){
						$('#kelurahan_'+name).html(data);
					}
				});
			});
			/*end jj*/
		}
		
		$(document).ready(function(){
			GetProvinsi('pemohon');
			GetProvinsi('perusahaan');
			GetProvinsi('izin');
			
			GetKabupaten('pemohon');
			GetKabupaten('perusahaan');
			GetKabupaten('izin');
			
			GetKecamatan('pemohon');
			GetKecamatan('perusahaan');
			GetKecamatan('izin');

			GetSyarat('jenis_izin');
			GetKel('pe');
		
			$('.datepicker').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true
			});
				
			$("input[class*=datepicker]").datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true
			}).on('changeDate', function(e){
				$(this).datepicker('hide');
			});
			
			$('#click').click(function(){
				$.ajax({
					url: '<?php echo base_url();?>signin/recaptcha',
					dataType: 'html',
					async: false,
					success: function(data){
						$('#img-c').html(data);
					}
				});
			});
		
		});
		
	</script>	
		
	<?php
		//load Footer (javascript file, tag close body .etc )
		//$this->load->view('front/templates/layout_footer');
	?>