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
		<form class="form-horizontal" method="POST" role="form" data-toggle="validator" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/back_office/pembuatan_bap/save_bap">
		<?php //echo form_open($action) ?>
			<div class="col-xs-12">
				<div class="nav-tabs-custom col-sm-12 no-padding">
					<div class="tab-content">
						<div class="tab-pane col-sm-12 active" id="a" style="padding-top:20px;">
						<?php $i = 1; ?>
						<?php foreach($detail_bap as $p): ?>
							<div>
							<input type='hidden' name='id_perm' value='<?php echo $id_perm; ?>'>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">No Pendaftaran</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $p->no_pendaftaran; ?></label>
							</div>
							<div>
							<input type='hidden' name='id_perm' value='<?php echo $id_perm; ?>'>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Layanan</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo "Izin Mendirikan Bangunan"; ?></label>
							</div>
							<div>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nama Pemohon</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $p->nama_lengkap; ?></label>
							</div>
							<div>
							<?php 
								$alamat = $p->alamat;
								$kel = $p->kel_pem;
								$kec = $p->kec_pem;
								$kab = $p->kab_pem;
								$prop = $p->prop_pem;
								$alamat_pemohon = $alamat." Kel. ".$kel." Kec. ".$kec." Kab. ".$kab." Prop. ".$prop;
							 ?>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Alamat Pemohon</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $alamat_pemohon; ?></label>
							</div>
							<div>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nama Perusahaan</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $p->nama_perusahaan; ?></label>
							</div>
							<?php
							$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
							$date = $p->tgl_tinjauan;
							$tahun = substr($date, 0, 4);
							$bulan = substr($date, 5, 2);
							$tgl = substr($date, 8, 2);
							$tgl_tinjauan_format = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;
							?>
							<div>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Tanggal Peninjauan</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $tgl_tinjauan_format; ?></label>
							</div>
							<div>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">No BAP</label>
								<label class="col-sm-1 control-label">:</label>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo $p->no_surat_bap; ?></label>
							</div>
							<div>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nilai Retribusi</label>
								<label class="col-sm-1 control-label">:</label>
								<?php
								$retribusi = $p->nilai_retribusi;
								$ret = number_format($retribusi);
								?>
								<label class="ccol-sm-2 control-label text-left-imp"><?php echo "Rp"." ".$ret ?></label>
							</div>
							<div><br/>
							<table border="1">
								<tr>
									<td colspan="2" align="center"><b>Data Berkas Permohonan</b></td>
									<td colspan="2" align="center"><b>Data Tinjauan</b></td>
								</tr>
								<tr>
									<td>Luas Tanah</td>
									<td><?php echo $p->luas_tanah; ?></td>
									<td>Luas Tanah</td>
									<td><?php echo $p->luas_tanah_v; ?></td>
								</tr>
								<tr>
									<td>Status Tanah</td>
									<td><?php echo $p->status_tanah; ?></td>
									<td>Status Tanah</td>
									<td><?php echo $p->status_tanah_v; ?></td>
								</tr>
								<tr>
									<td>Pemilik Tanah</td>
									<td><?php echo $p->pemilik_tanah; ?></td>
									<td>Pemilik Tanah</td>
									<td><?php echo $p->pemilik_tanah_v; ?></td>
								</tr>
								<tr>
									<td>Garis Sempadan Bangunan</td>
									<td><?php echo $p->gsb; ?></td>
									<td>Garis Sempadan Bangunan</td>
									<td><?php echo $p->gsb_v; ?></td>
								</tr>
								<tr>
									<td>Garis Sempadan Pagar</td>
									<td><?php echo $p->gsp; ?></td>
									<td>Garis Sempadan Pagar</td>
									<td><?php echo $p->gsp_v; ?></td>
								</tr>
								<tr>
									<td>No Hak Milik</td>
									<td><?php echo $p->no_hak_milik; ?></td>
									<td>No Hak Milik</td>
									<td><?php echo $p->no_hak_milik_v; ?></td>
								</tr>
								<tr>
									<td>Kelurahan</td>
									<td><?php echo $p->kel_lokasi; ?></td>
									<td>Kelurahan</td>
									<td><?php echo $p->kel_lokasi; ?></td>
								</tr>
								<tr>
									<td>Kecamatan</td>
									<td><?php echo $p->kec_lokasi; ?></td>
									<td>Kecamatan</td>
									<td><?php echo $p->kec_lokasi; ?></td>
								</tr>
								<tr>
									<td>Pekerjaan</td>
									<td><?php echo $p->pekerjaan; ?></td>
									<td>Pekerjaan</td>
									<td><?php echo $p->pekerjaan_v; ?></td>
								</tr>
								<tr>
									<td>Kewarganegaraan</td>
									<td><?php echo $p->kewarganegaraan; ?></td>
									<td>Kewarganegaraan</td>
									<td><?php echo $p->kewarganegaraan_v; ?></td>
								</tr>
								<tr>
									<td>Fungsi Bangunan</td>
									<td><?php echo $p->fungsi_bangunan; ?></td>
									<td>Fungsi Bangunan</td>
									<td><?php echo $p->fungsi_bangunan_v; ?></td>
								</tr>
								<tr>
									<td>Jenis Bangunan</td>
									<td><?php echo $p->jenis_bangunan; ?></td>
									<td>Jenis Bangunan</td>
									<td><?php echo $p->jenis_bangunan_v; ?></td>
								</tr>
								<tr>
									<td>Garis Sempadan Sungai</td>
									<td><?php echo $p->gss; ?></td>
									<td>Garis Sempadan Sungai</td>
									<td><?php echo $p->gss_v; ?></td>
								</tr>
								<tr>
									<td>Garis Sempadan Rel Kereta Api</td>
									<td><?php echo $p->gsr; ?></td>
									<td>Garis Sempadan Rel Kereta Api</td>
									<td><?php echo $p->gsr_v; ?></td>
								</tr>
								<tr>
									<td>Luas Bangunan Tutupan</td>
									<td><?php echo $p->luas_bangunan_tutupan; ?></td>
									<td>Luas Bangunan Tutupan</td>
									<td><?php echo $p->luas_bangunan_tutupan_v; ?></td>
								</tr>
							</table>
							</div>
							<div><br/>
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Catatan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="catatan" id="catatan" required/>
								</div>
							</div>
					<?php $i++; ?>
					<?php EndForeach; ?>
						</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6"><br/>
									<button value="save" name="submit" >Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>	