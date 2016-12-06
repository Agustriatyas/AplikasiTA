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
	<h2>DATA PENGGUNA</h2>
	<div class="info" style="margin_buttom:10px">
		<div class="tip icon-tip">&nbsp</div>
		<div>Klik Tombol Pada Pilihan Aksi Untuk Melakukan Perubahan Data</div>
	</div>
		<table id="dg" title="DATA PENGGUNA" class="easyui-datagrid" style="height:250px" url="data_master/barang/get_barang.php" toolbar="#toolbar" pagination="true" rownumber="true" fitColumns="true" singleSelect="true">
			<thead>
				<tr>
					<th field="no" width="10">NO</th>
					<th field="id_barang" width="45">USERNAME</th>
					<th field="nm_barang" width="55">NAMA</th>
					<th field="id_jenis" width="60">LEVEL</th>
					<th field="nm_jenis" width="55">STATUS</th>
					<th field="hrg_beli" width="30">AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach($data_user as $p): ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $p->username; ?></td>
					<td><?php echo $p->nama; ?></td>
					<td><?php echo $p->level; ?></td>
					<td><?php echo $p->status ?></td>
					<td><!--a href='<?php //echo base_url() ?>index.php/kelola_user/kelola_user/tambah/<?php //echo $p->username ?>' ><img src='../../assets/img/clipboard.png' title="Tambah Data" ></a-->
						<a href='<?php echo base_url() ?>index.php/kelola_user/kelola_user/edit/<?php echo $p->username ?>' ><img src='../../assets/img/property.png' title="Ubah" ></a>
						<a href='<?php echo base_url() ?>index.php/kelola_user/kelola_user/delete/<?php echo $p->username ?>' onclick="return confirm('Anda yakin akan menghapusnya?');"><img src='../../assets/img/cross.png' title="Hapus" ></a>
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

