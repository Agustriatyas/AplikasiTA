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
		<form class="form-horizontal" method="POST" role="form" data-toggle="validator" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/kasir/pembayaran_retribusi/save_pembayaran">
		<?php //echo form_open($action) ?>
			<div class="col-xs-12">
				<div class="nav-tabs-custom col-sm-12 no-padding">
					<div class="tab-content">
						<div class="tab-pane col-sm-12 active" id="a" style="padding-top:20px;">
						<?php $i = 1; ?>
						<?php foreach($data_bayar as $p): ?>
							<div>
							<input type='hidden' name='id_perm' value='<?php echo $id_perm; ?>'>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">No Pendaftaran</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $p->no_pendaftaran; ?></label>
							</div>
							<div>
							<input type='hidden' name='id_perm' value='<?php echo $id_perm; ?>'>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nama Pemohon</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $p->nama_lengkap; ?></label>
							</div>
							<div>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Perizinan</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo "Izin Mendirikan Bangunan"; ?></label>
							</div>
							<div>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Biaya Retribusi</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $p->nilai_retribusi; ?></label>
							</div>
							<div>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Status Bayar</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp">
								<select name="status_bayar" id="status_bayar" class="form-control" required>
									<option value="Belum Bayar" <?php if ($p->status == 'Belum Bayar'): ?>selected<?php endif; ?>>Belum Bayar</option>
									<option value="Sudah Bayar" <?php if ($p->status == 'Sudah Bayar'): ?>selected<?php endif; ?>>Sudah Bayar</option>
								</select>
								</label>
							</div><br>
					<?php $i++; ?>
					<?php EndForeach; ?>
						</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">
									<button id="submit" value="save" name="submit" class="btn btn-primary">Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>	