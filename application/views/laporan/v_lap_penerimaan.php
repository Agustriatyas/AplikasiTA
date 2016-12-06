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
	<h2>LAPORAN PENERIMAAN RETRIBUSI</h2>
	<div class="info" style="margin_buttom:10px">
		<div class="tip icon-tip">&nbsp</div>
		<div>Klik Tombol Pada Datagrid Toolbar Untuk Melakukan Perubahan Data</div>
	</div>
		<table id="dg" title="LAPORAN PENERIMAAN RETRIBUSI" class="easyui-datagrid" style="height:250px" url="data_master/barang/get_barang.php" toolbar="#toolbar" pagination="true" rownumber="true" fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="no" width="10">NO</th>
					<th field="id_barang" width="45">NO PENDAFTARAN</th>
					<th field="nm_barang" width="45">ID PEMOHON</th>
					<th field="id_jenis" width="60">PEMOHON</th>
					<th field="nm_jenis" width="45">TANGGAL PERMOHONAN</th>
					<th field="stok" width="60">JENIS PERMOHONAN</th>
					<th field="nilai_ret" width="35">NILAI RETRIBUSI</th>
					<th field="status" width="30">STATUS</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach($lap_penerimaan as $p): ?>
				<?php
					$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
					$date = $p->tgl_permohonan;
					$tahun = substr($date, 0, 4);
					$bulan = substr($date, 5, 2);
					$tgl = substr($date, 8, 2);

					$tgl_permohonan = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;
					//echo $cek; 
					$retribusi = $p->nilai_ret;
					$ret = number_format($retribusi);
				 ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $p->no_pendaftaran; ?></td>
					<td><?php echo $p->no_identitas; ?></td>
					<td><?php echo $p->nama_pemohon; ?></td>
					<td><?php echo $tgl_permohonan; ?></td>
					<td><?php echo $p->jenis_permohonan; ?></td>
					<td><?php echo "Rp. " .$ret; ?></td>
					<td><?php echo $p->status; ?></td>
				</tr>
				<?php $i++; ?>
				<?php EndForeach; ?>
			</tbody>
		</table>
		<div id="toolbar">
			<a href="<?php echo base_url() ?>index.php/laporan/laporan_penerimaan/cetak_lap_penerimaan" class="easyui-linkbutton" iconCls="icon-edit" plain="true">Cetak Laporan</a>
			<!--a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeData()">Hapus</a-->
		</div>
</body>
</html>