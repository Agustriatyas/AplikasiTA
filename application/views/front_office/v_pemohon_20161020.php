<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/style.css">
	<script type="text/javascript" src="../../assets/jquery_easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../../assets/jquery_easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="../../assets/libs_js/user.js"></script>
	<?php //ambil dari portal ?>
	<link rel='stylesheet' href='<?php echo base_url(); ?>./assets/css/bootstrap.min.css' type='text/css' media='all' />
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
		<form class="form-horizontal" method="POST" role="form" data-toggle="validator" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/front_office/pemohon/insert">
			<div class="col-xs-12">
				<div class="form-group">
					<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Permohonan</label>
					<label class="col-sm-1 control-label">:</label>
					<div class="col-sm-2">
						<select name="jenis_izin" id="jenis_izin" class="form-control" onchange="GetSyarat(this)" required>
							<option value=""></option>
							<?php foreach($jns_permohonan as $p): ?>
								<option value="<?php echo $p->id;?>"><?php echo $p->jenis_permohonan;?></option>
							<?php EndForeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Peruntukan</label>
					<label class="col-sm-1 control-label">:</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="jns_peruntukan" type="varchar" id="jns_peruntukan" required/>
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
									<select name="source"  id="source" class="form-control" required>
										<option></option>
										<option value="KTP">KTP</option>
										<option value="SIM">SIM</option>
										<option value="PASSPORT">PASSPORT</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nomor Identitas</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="no_referensi" id="no_referensi" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">NPWP</label>
								<label for="nama_lengkap" class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control npwp" name="npwp_pemohon" id="npwp" onkeypress="validasi_npwp(event,this)" >
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nama Lengkap</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jenis Kelamin</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<label class="radio-inline">
										<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Pria" required/> Pria
									</label>
									<label class="radio-inline">
										<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Wanita"r equired/> Wanita
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Posisi Pemohon</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<select name="posisi" id="posisi" class="form-control" required>
										<option value=""></option>
										<option value="Direktur">Direktur</option>
										<option value="Pemegang Saham">Pemegang Saham</option>
										<option value="Kuasa">Kuasa</option>
										<option value="Direktur Utama">Direktur Utama</option>
										<option value="Pemilik">Pemilik</option>
										<option value="Ketua">Ketua</option>
										<option value="Karyawan">Karyawan</option>
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
									<input type="text" class="form-control phone" name="no_telp_pemohon" id="no_telp_pemohon1" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Email</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="email_pemohon" id="email" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Alamat Lengkap</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<textarea class="form-control" name="alamat_pemohon" id="alamat" rows="3" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="provinsi" class="col-sm-2 control-label text-left-imp">Provinsi</label>
								<label for="provinsi" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="provinsi_pemohon" id="provinsi_pemohon" class="form-control" required>
										<option value=""></option>
										<?php foreach($propinsi as $p): ?>
											<option value="<?php echo $p->id_prop;?>"><?php echo $p->nama_prop;?></option>
										<?php EndForeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kab_kot" class="col-sm-2 control-label text-left-imp">Kabupaten/ Kota</label>
								<label for="kab_kot" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kabupaten_pemohon" id="kabupaten_pemohon" class="form-control" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kecamatan</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kecamatan_pemohon" id="kecamatan_pemohon" class="form-control" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kelurahan/ Desa</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kelurahan_pemohon" id="kelurahan_pemohon" class="form-control" required>
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
									<input type="text" class="form-control npwp" name="npwp_perusahaan" id="npwp_perusahaan" onkeypress="validasi_npwp(event,this)" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nama Perusahaan</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="n_perusahaan" id="n_perusahaan" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Bidang Usaha</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<select name="bidang_usaha" id="bidang_usaha" class="form-control" required>
										<option value=""></option>
										<option value="Industry">Industry</option>
										<option value="Non Industri">Non Industri</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Status Investasi</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<select name="status_modal" id="status_modal" class="form-control" required>
										<option value=""></option>
										<option value="PMA/FDI">PMA/FDI</option>
										<option value="PMDN/DDI">PMDN/DDI</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Badan Hukum</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-3">
									<select name="badan_hukum" id="badan_hukum" class="form-control" required>
										<option value=""></option>
										<option value="Perseroan Terbatas">Perseroan Terbatas</option>
										<option value="Koperasi">Koperasi</option>
										<option value="Perusahaan Umum">Perusahaan Umum</option>
										<option value="Perusahaan Perseroan">Perusahaan Perseroan</option>
										<option value="Perusahaan Perorangan">Perusahaan Perorangan</option>
										<option value="Persekutuan">Persekutuan</option>
										<option value="Persekutuan Komanditer">Persekutuan Komanditer</option>
										<option value="Persekutuan Perdata">Persekutuan Perdata</option>
										<option value="Yayasan">Yayasan</option>
										<option value="Perusahaan Daerah">Perusahaan Daerah</option>
										<option value="Baitul Maal Wat Tamwil">Baitul Maal Wat Tamwil</option>
										<option value="Perorangan">Perorangan</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nilai Investasi</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="number" class="form-control uang" min="1" name="investasi" id="investasi" placeholder="" required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Jumlah Tenaga Kerja</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-2">
									<input type="number" class="form-control" min="0" name="jumlah_tk" id="jumlah_tk"  />
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Nomor Telepon</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control phone" name="no_telp_perusahaan" id="no_telp_perusahaan" />
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Email</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="email" class="form-control" name="email_perusahaan" id="email"  required/>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Website</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="website" id="webisite" />
								</div>
							</div>
							<div class="form-group">
								<label for="nama_lengkap" class="col-sm-2 control-label text-left-imp">Alamat Lengkap</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<textarea class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" rows="3" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="provinsi" class="col-sm-2 control-label text-left-imp">Provinsi</label>
								<label for="provinsi" class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<select name="provinsi_perusahaan" id="provinsi_perusahaan" class="form-control" required>
										<option value=""></option>
										<?php foreach($propinsi as $p): ?>
											<option value="<?php echo $p->id_prop;?>"><?php echo $p->nama_prop;?></option>
										<?php EndForeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kab_kot" class="col-sm-2 control-label text-left-imp">Kabupaten/ Kota</label>
								<label for="kab_kot" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kabupaten_perusahaan" id="kabupaten_perusahaan" class="form-control" required>
										
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kecamatan</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kecamatan_perusahaan" id="kecamatan_perusahaan" class="form-control" required>
				
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kelurahan/ Desa</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kelurahan_perusahaan" id="kelurahan_perusahaan" class="form-control" required>
										
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
									<select name="provinsi_izin" id="provinsi_izin" class="form-control" required>
										<option value=""></option>
										<?php foreach($propinsi as $p): ?>
											<option value="<?php echo $p->id_prop;?>"><?php echo $p->nama_prop;?></option>
										<?php EndForeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kab_kot" class="col-sm-2 control-label text-left-imp">Kabupaten/ Kota</label>
								<label for="kab_kot" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kabupaten_izin" id="kabupaten_izin" class="form-control" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kecamatan</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kecamatan_izin" id="kecamatan_izin" class="form-control" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="kel_des" class="col-sm-2 control-label text-left-imp">Kelurahan/ Desa</label>
								<label for="kel_des" class="col-sm-1 control-label">:</label>
								<div class="col-sm-4">
									<select name="kelurahan_izin" id="kelurahan_izin" class="form-control" required>
										<option></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="alamat_izin" class="col-sm-2 control-label text-left-imp">Alamat Lengkap</label>
								<label class="col-sm-1 control-label">:</label>
								<div class="col-sm-5">
									<textarea class="form-control" name="alamat_izin" id="alamat" rows="3" required></textarea>
								</div>
							</div>
						</div>


						<div class="tab-pane col-sm-12" id="c" style="padding-top:20px;">
						<!--div class="tab-pane col-sm-12 active" id="c" style="padding-top:20px;display:none;">
							<div class="form-group"-->
								<table border='1' id="mytablesyarat" class="form-group" style="display:none;">
									<thead>
										<tr>
											<td align="center"><label>No.</label></td>
											<td align="center"><label>Syarat<label></td>
											<!--td align="center"><label>ID Syarat<label></td-->
											<td align="center"><label>Terpenuhi<label></td>
										</tr>
									</thead>
								 	<tbody>
								 	</tbody>
								</table>

							<br/>
							<br/>
								<p>Lampiran Persyaratan : </p>
								<input type="file" name="userfile" size="20" />
							<br/>
							<br/>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-6">
									<button id="submit" value="save" name="submit" class="btn btn-primary">Daftar</button>
									<!--input type='submit' value='Daftar'-->
									<a href="<?php echo base_url();?>signin" class="btn btn-default">Reset</a>
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
			var site = "<?php echo base_url();?>";
			$("tbody").children().remove();
			$.ajax({
				url : site+'index.php/front_office/pemohon/send/'+id,
				dataType :'json',
				success : function(data){
					var rows = "";
					$.each(data, function(index, item){
						rows += "<tr>";
							rows += "<td align='center'>"+index+"</td>";
							rows += "<td>"+item['syarat']+"</td>";
							//rows += "<td align='center'>"+item['id']+"</td>";
							rows += "<td align='center'><input type='checkbox' name='checkbox[]' value='"+item['syarat']+"'></td>";
							//rows += "<td><input type='checkbox' onchange='displayResult(this.form)' value='item['id']'></td>";
						rows += "</tr>";
						console.log(item['syarat']);
					});
					$(rows).appendTo("#mytablesyarat tbody");
					document.getElementById('mytablesyarat').style.display="block";
				},
			});
			console.log(elem.value);
		}

		/**
		 * Fungsi ini digunakan untuk menangkap data kabupaten berdasarkan propinsi (ID) yang diambil dari
		 * controllers front_office/pemohon/kabupaten
		 */		
		function GetKabupaten(name){
			$('#provinsi_'+name).change(function(){
				var id = $(this).val();
				$('#kabupaten_'+name+',#kecamatan_'+name+',#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kabupaten/'+id,
					dataType:'html',
					async: false,
					success:function(data){
						$('#kabupaten_'+name).html(data);
					}
				});
			});
		}

		// function GetKel(name){
		// 	$('#provinsi_'+name).change(function(){
		// 		var id = $(this).val();
		// 		$('#kabupaten_'+name+',#kecamatan_'+name+',#kelurahan_'+name).empty();
		// 		$.ajax({
		// 			url: '<?php //echo base_url();?>signin/kec_izin/'+id,
		// 			dataType:'html',
		// 			async: false,
		// 			success:function(data){
		// 				$('#kabupaten_'+name).html(data);
		// 			}
		// 		});
		// 	});
		// }

		/**
		 * Fungsi ini digunakan untuk menangkap data kecamatan berdasarkan kabupaten (ID) yang diambil dari
		 * controllers front_office/pemohon/kecamatan
		 */		
		function GetKecamatan(name){
			$('#kabupaten_'+name).change(function(){
				var id = $(this).val();
				$('#kecamatan_'+name+',#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kecamatan/'+id,
					dataType:'html',
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
		function GetKelurahan(name){
			$('#kecamatan_'+name).change(function(){
				var id = $(this).val();
				$('#kelurahan_'+name).empty();
				$.ajax({
					url: '<?php echo base_url();?>index.php/front_office/pemohon/kelurahan/'+id,
					dataType:'html',
					async: false,
					success:function(data){
						$('#kelurahan_'+name).html(data);
					}
				});
			});
		}
		
		$(document).ready(function(){
			
			GetKabupaten('pemohon');
			GetKabupaten('perusahaan');
			GetKabupaten('izin');
			
			GetKecamatan('pemohon');
			GetKecamatan('perusahaan');
			GetKecamatan('izin');
			
			GetKelurahan('pemohon');
			GetKelurahan('perusahaan');
			GetKelurahan('izin');

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