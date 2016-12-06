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
		<form class="form-horizontal" method="POST" role="form" data-toggle="validator" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/back_office/entry_data_tinjauan/edit">
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
									<input type="text" class="form-control" name="pemilik_tanah_v" id="pemilik_tanah_v" value="<?php echo($data_perizinan!='' ? $data_perizinan->pemilik_tanah_v : ''); ?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Tahun Lahir</label>
								<label for="nama_lengkap" class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control npwp" name="tahun_lahir_v" id="tahun_lahir_v" value="<?php echo($data_perizinan!='' ? $data_perizinan->thn_lahir_v : ''); ?>" onkeyup="validAngka(this)" onkeypress="validasi_npwp(event,this)" >
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Pekerjaan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="pekerjaan_v" id="pekerjaan_v" value="<?php echo $data_perizinan->pekerjaan_v?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Kewarganegaraan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="kewarganegaraan_v" id="kewarganegaraan_v" value="<?php echo $data_perizinan->kewarganegaraan_v?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Luas Tanah</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="luas_tanah_v" id="luas_tanah_v" value="<?php echo $data_perizinan->luas_tanah_v?>" onkeyup="validAngka(this)" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Status Tanah</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<!-- begin jj-->
									 
								<?php $selected = 'selected="selected"' ?> 
									
								<!-- end jj-->
									<select name="status_tanah_v" id="status_tanah_v" value="<?php echo $data_perizinan->status_tanah_v?>" class="form-control" required>
										<option value=""></option>
										<option value="SHM" <?php if ($data_perizinan->status_tanah_v == 'SHM'): ?><?php echo $selected ?><?php endif; ?>>SHM (Sertifikat Hak Milik)</option>
										<option value="AJB" <?php if ($data_perizinan->status_tanah_v == 'AJB') : ?> <?php echo $selected ?><?php endif; ?>>AJB (Akta Jual Beli)</option>
										<option value="SHJB" <?php if ($data_perizinan->status_tanah_v == 'SHJB') : ?><?php echo $selected ?><?php endif; ?>>SHJB (Surat Hak Guna Bangunan)</option>
										<option value="HGU" <?php if ($data_perizinan->status_tanah_v == 'HGU') : ?> <?php echo $selected ?><?php endif; ?>>HGU (Hak Guna Usaha)</option>
										<option value="Letter" <?php if ($data_perizinan->status_tanah_v == 'Letter') : ?> <?php echo $selected ?><?php endif; ?>>Letter C</option>
										<option value="Girik" <?php if ($data_perizinan->status_tanah_v == 'Girik') : ?> <?php echo $selected ?><?php endif; ?>>Girik</option>
										<option value="Persil" <?php if ($data_perizinan->status_tanah_v == 'Persil') : ?> <?php echo $selected ?><?php endif; ?>>Persil</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nomor Hak Milik</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<input type="text" class="form-control handphone" name="no_hak_milik_v" id="no_hak_milik_v" value="<?php echo $data_perizinan->no_hak_milik_v?>" onkeyup="validAngka(this)" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Garis Sempadan Bangunan (GSB)</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<input type="text" class="form-control phone" name="gsb_v" id="gsb_v" value="<?php echo $data_perizinan->gsb_v?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Garis Sempadan Pagar (GSP)</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="gsp_v" id="gsp_v" value="<?php echo $data_perizinan->gsp_v?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Luas Bangunan/Tutupan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="luas_bangunan_tutupan_v" id="luas_bangunan_tutupan_v" value="<?php echo $data_perizinan->luas_bangunan_tutupan_v?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Fungsi Bangunan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="fungsi_bangunan_v" id="fungsi_bangunan_v" value="<?php echo $data_perizinan->fungsi_bangunan_v?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Bangunan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="jenis_bangunan_v" id="jenis_bangunan_v" value="<?php echo $data_perizinan->jenis_bangunan_v?>" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Garis Sempadan Sungai (GSS)</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="gss_v" id="gss_v" value="<?php echo $data_perizinan->gss_v?>" onkeyup="validAngka(this)" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Garis Sempadan Rel Kereta Api</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="gsr_v" id="gsr_v" value="<?php echo $data_perizinan->gsr_v?>" onkeyup="validAngka(this)" required/>
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