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

	<!-- begin jj -->
	<script language='javascript'>
		function validAngka(a)
		{
			if(!/^[0-9.]+$/.test(a.value))
			{
			a.value = a.value.substring(0,a.value.length-1000);
			}
		}
	</script>
	<!--- end jj -->

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
		<form class="form-horizontal" method="POST" role="form" data-toggle="validator" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/back_office/entry_data/edit">
		<?php //echo form_open() ?>
			<div class="col-xs-12">
				<div class="nav-tabs-custom col-sm-12 no-padding">
					<div class="tab-content">
						<div class="tab-pane col-sm-12 active" id="a" style="padding-top:20px;">
							<div class="form-group">
							<!-- begin jj -->
							<input type='hidden' name='id_perm' value='<?php echo($data_perizinan!='' ? $data_perizinan->id_perm : ''); ?>'>
							<!-- end jj -->
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Pemilik Tanah</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="pemilik_tanah" id="pemilik_tanah" value="<?php echo($data_perizinan!='' ? $data_perizinan->pemilik_tanah : ''); ?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Tahun Lahir</label>
								<label for="nama_lengkap" class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control npwp" name="tahun_lahir" id="tahun_lahir" value="<?php echo($data_perizinan!='' ? $data_perizinan->thn_lahir : ''); ?>" onkeyup="validAngka(this)" onkeypress="validasi_npwp(event,this)" >
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Pekerjaan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $data_perizinan->pekerjaan?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Kewarganegaraan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="kewarganegaraan" id="kewarganegaraan" value="<?php echo $data_perizinan->kewarganegaraan?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Luas Tanah</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="luas_tanah" id="luas_tanah" value="<?php echo $data_perizinan->luas_tanah?>" onkeyup="validAngka(this)" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Status Tanah</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<!-- begin jj-->
									 
								<?php $selected = 'selected="selected"' ?> 
									
								<!-- end jj-->
									<select name="status_tanah" id="status_tanah" value="<?php echo $data_perizinan->status_tanah?>" class="form-control" required>
										<option value=""></option>
										<option value="SHM" <?php if ($data_perizinan->status_tanah == 'SHM'): ?><?php echo $selected ?><?php endif; ?>>SHM (Sertifikat Hak Milik)</option>
										<option value="AJB" <?php if ($data_perizinan->status_tanah == 'AJB') : ?> <?php echo $selected ?><?php endif; ?>>AJB (Akta Jual Beli)</option>
										<option value="SHJB" <?php if ($data_perizinan->status_tanah == 'SHJB') : ?><?php echo $selected ?><?php endif; ?>>SHJB (Surat Hak Guna Bangunan)</option>
										<option value="HGU" <?php if ($data_perizinan->status_tanah == 'HGU') : ?> <?php echo $selected ?><?php endif; ?>>HGU (Hak Guna Usaha)</option>
										<option value="Letter" <?php if ($data_perizinan->status_tanah == 'Letter') : ?> <?php echo $selected ?><?php endif; ?>>Letter C</option>
										<option value="Girik" <?php if ($data_perizinan->status_tanah == 'Girik') : ?> <?php echo $selected ?><?php endif; ?>>Girik</option>
										<option value="Persil" <?php if ($data_perizinan->status_tanah == 'Persil') : ?> <?php echo $selected ?><?php endif; ?>>Persil</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nomor Hak Milik</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<input type="text" class="form-control handphone" name="no_hak_milik" id="no_hak_milik" value="<?php echo $data_perizinan->no_hak_milik?>" onkeyup="validAngka(this)" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Garis Sempadan Bangunan (GSB)</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<input type="text" class="form-control phone" name="gsb" id="gsb" value="<?php echo $data_perizinan->gsb?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Garis Sempadan Pagar (GSP)</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="gsp" id="gsp" value="<?php echo $data_perizinan->gsp?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Luas Bangunan/Tutupan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="luas_bangunan_tutupan" id="luas_bangunan_tutupan" value="<?php echo $data_perizinan->luas_bangunan_tutupan?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Fungsi Bangunan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="fungsi_bangunan" id="fungsi_bangunan" value="<?php echo $data_perizinan->fungsi_bangunan?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Bangunan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="jenis_bangunan" id="jenis_bangunan" value="<?php echo $data_perizinan->jenis_bangunan?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Garis Sempadan Sungai (GSS)</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="gss" id="gss" value="<?php echo $data_perizinan->gss?>" onkeyup="validAngka(this)" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Garis Sempadan Rel Kereta Api</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="gsr" id="gsr" value="<?php echo $data_perizinan->gsr?>" onkeyup="validAngka(this)" required/>
								</div>
							</div>
					
						</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">
									<button value="save" name="submit">Simpan</button>
									<!--input type='submit' value='Daftar'-->
									<!--<a href="<?php //echo base_url();?>signin" class="btn btn-default">Reset</a>-->
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