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
	<h2>LAPORAN PENDAFTARAN</h2>
	<div class="info" style="margin_buttom:10px">
		<div class="tip icon-tip">&nbsp</div>
		<div>Klik Tombol Pada Datagrid Toolbar Untuk Melakukan Perubahan Data</div>
	</div>
		<table id="dg" title="LAPORAN PENDAFTARAN" class="easyui-datagrid" style="height:250px" url="data_master/barang/get_barang.php" toolbar="#toolbar" pagination="true" rownumber="true" fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="no" width="10">NO</th>
					<th field="id_barang" width="45">NO PENDAFTARAN</th>
					<th field="nm_barang" width="55">TANGGAL PERMOHONAN</th>
					<th field="id_jenis" width="60">PEMOHON</th>
					<th field="nm_jenis" width="55">STATUS PERMOHONAN</th>
					<th field="stok" width="77">WAKTU AKSES</th>
					<!--th field="hrg_beli" width="30">AKSI</th-->
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach($lap_pendaftaran as $p): ?>
				<?php
					$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
					$date = $p->tgl_permohonan;
					$tahun = substr($date, 0, 4);
					$bulan = substr($date, 5, 2);
					$tgl = substr($date, 8, 2);

					$tgl_permohonan = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;
					//echo $cek; 
				 ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $p->no_pendaftaran; ?></td>
					<td><?php echo $tgl_permohonan; ?></td>
					<td><?php echo $p->nama_pemohon; ?></td>
					<td><?php echo $p->status_perm; ?></td>
					<td><?php echo $p->d_entry; ?></td>
					<!--td><a href='<?php //echo base_url() ?>index.php/laporan/laporan_pendaftaran/cetak_lap_pendaftaran/<?php //echo $p->id_perm ?>' ><img src='../../assets/img/doc_page.png'></a>
					</td-->
				</tr>
				<?php $i++; ?>
				<?php EndForeach; ?>
			</tbody>
		</table>
		<div id="toolbar">
			<a href="<?php echo base_url() ?>index.php/laporan/laporan_pendaftaran/cetak_lap_pendaftaran" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Cetak Laporan</a>
			<!--a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editData()">Edit Data</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeData()">Hapus</a-->
		</div>
</body>
</html>