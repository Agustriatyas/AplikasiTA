<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="../../assets/jquery_easyui/themes/style.css">
	<script type="text/javascript" src="../../assets/jquery_easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../../assets/jquery_easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../assets/libs_js/permohonan.js"></script>
</head>
<body>
	<h2>PENJADWALAN TINJAUAN</h2>
	<div class="info" style="margin_buttom:10px">
		<div class="tip icon-tip">&nbsp</div>
		<div>Klik Tombol Pada Pilihan Aksi Untuk Melakukan Perubahan Data</div>
	</div>
		<table id="dg" title="PENJADWALAN TINJAUAN" class="easyui-datagrid" style="height:250px" url="data_master/barang/get_barang.php" toolbar="#toolbar" pagination="true" rownumber="true" fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="no" width="10">NO</th>
					<th field="id_barang" width="45">NO PENDAFTARAN</th>
					<th field="nm_barang" width="55">ID PEMOHON</th>
					<th field="id_jenis" width="60">PEMOHON</th>
					<th field="nm_jenis" width="55">TANGGAL PERMOHONAN</th>
					<th field="stok" width="77">JENIS PERMOHONAN</th>
					<th field="hrg_beli" width="30">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach($entry_tinjauan as $p): ?>
				<tr>
				<?php
				$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
					$date = $p->tgl_permohonan;
					$tahun = substr($date, 0, 4);
					$bulan = substr($date, 5, 2);
					$tgl = substr($date, 8, 2);

					$tgl_format = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;
					// die($tgl_format);
				?>
					<td><?php echo $i; ?></td>
					<td><?php echo $p->no_pendaftaran; ?></td>
					<td><?php echo $p->no_identitas; ?></td>
					<td><?php echo $p->nama_pemohon; ?></td>
					<td><?php echo $tgl_format; ?></td>
					<td><?php echo $p->jenis_permohonan; ?></td>
					<td><a href='<?php echo base_url() ?>index.php/penjadwalan/jadwal_tinjauan/entry_tinjauan/<?php echo $p->id_perm ?>' ><img src='../../assets/img/doc_page.png' title="Penjadwalan"></a>
					<?php if($p->isdisable == 1): ?>
						<a href='<?php echo base_url() ?>index.php/penjadwalan/jadwal_tinjauan/cetak_sp/<?php echo $p->id_perm ?>' ><img src='../../assets/img/property.png' title="Cetak SP"></a>
					<?php endif ?>
					</td>
				</tr>
				<?php $i++; ?>
				<?php EndForeach; ?>
			</tbody>
		</table>
		<div id="toolbar">
		</div>
</body>
</html>