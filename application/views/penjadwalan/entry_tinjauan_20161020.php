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
	<div class="row">
		<form class="form-horizontal" method="POST" role="form" data-toggle="validator" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/penjadwalan/jadwal_tinjauan/insert_tinjauan">
		<?php //echo form_open($action) ?>
			<div class="col-xs-12">
				<div class="nav-tabs-custom col-sm-12 no-padding">
					<div class="tab-content">
						<div class="tab-pane col-sm-12 active" id="a" style="padding-top:20px;">
							<div class="form-group">
							<input type='hidden' name='id_perm' value='<?php echo $id_perm; ?>'>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Tanggal Terima Berkas</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="tgl_terima_berkas" id="tgl_terima_berkas" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Tanggal Peninjauan</label>
								<label for="nama_lengkap" class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control npwp" name="tgl_peninjauan" id="tgl_peninjauan" onkeypress="validasi_npwp(event,this)" >
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">No Surat BAP</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="no_surat_bap" id="no_surat_bap" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Tim Pemeriksa</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<select name="tim_pemeriksa" id="tim_pemeriksa" class="form-control" required>
										<option value=""></option>
										<option value="BUDI HERDIMAN, ST">BUDI HERDIMAN, ST</option>
										<option value="EKA GUMELAR">EKA GUMELAR</option>
										<option value="ELAN SUHERLAN">ELAN SUHERLAN</option>
										<option value="DENI PURBAYA">DENI PURBAYA</option>
										<option value="FIRMAN AHMAD FAUZI">FIRMAN AHMAD FAUZI</option>
									</select>
								</div>
							</div>				
						</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">
									<button id="submit" value="save" name="submit" class="btn btn-primary">Simpan</button>
									<!--input type='submit' value='Daftar'-->
									<a href="<?php echo base_url();?>signin" class="btn btn-default">Batal</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>	