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
	<h2>PEMBAYARAN RETRIBUSI</h2>
	<div class="info" style="margin_buttom:10px">
		<div class="tip icon-tip">&nbsp</div>
		<div>Klik Tombol Pada Pilihan Aksi Untuk Melakukan Perubahan Data</div>
	</div>
		<table id="dg" title="PEMBAYARAN RETRIBUSI" class="easyui-datagrid" style="height:250px" url="data_master/barang/get_barang.php" toolbar="#toolbar" pagination="true" rownumber="true" fitColumns="true" singleSelect="true">
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
				<?php foreach($pembayaran_retribusi as $p): ?>
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
					<td><a href='<?php echo base_url() ?>index.php/kasir/pembayaran_retribusi/bayar/<?php echo $p->id_perm ?>' ><img src='../../assets/img/doc_page.png' title="Pembayaran"></a>
						<!--a href='<?php //echo base_url() ?>index.php/penjadwalan/jadwal_tinjauan/cetak_sp/<?php //echo $p->id_perm ?>' ><img src='../../assets/img/property.png'></a>
						<a href='<?php //echo base_url() ?>index.php/penjadwalan/jadwal_tinjauan/cetak_bap/<?php //echo $p->id_perm ?>' ><img src='../../assets/img/property.png'><a-->
					</td>
				</tr>
				<?php $i++; ?>
				<?php EndForeach; ?>
			</tbody>
		</table>
		<div id="toolbar">
			<!--a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newData()">Data Baru</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editData()">Edit Data</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeData()">Hapus</a-->
		</div>
		<!--div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Informasi Barang</div>
			<form id="fm" method="post" novalidate>
				<div class="fitem">
					<label>Id Barang : </label>
					<input name="id_barang" id="id_barang" class="easyui-validatebox" required="true">
				</div>
				<div class="fitem">
					<label>Nama Barang : </label>
					<input name="nm_barang" class="easyui-validatebox" required="true">
				</div>
				<div class="fitem">
					<label>Jenis Barang : </label>
					<select name="id_jenis" id="id_jenis">
						<option></option>
					</select>
				</div>
				<div class="fitem">
					<label>Stok : </label>
					<input name="stok" class="easyui-validatebox" required="true">
				</div>
				<div class="fitem">
					<label>Harga Beli : </label>
					<input name="hrg_beli" class="easyui-validatebox" required="true">
				</div>
				<div class="fitem">
					<label>Harga Jual : </label>
					<input name="hrg_jual" class="easyui-validatebox" required="true">
				</div>
			</form>
		</div>
		<div id="dlg-buttons">
			<a href="#" class="easyui-linkbutton" iconCls="icon_ok" onclick="saveData()">Save</a>
			<a href="#" class="easyui-linkbutton" iconCls="icon_cancel" onclick="javascript:$('#dlg').dialog('close)">Cancel</a>
		</div-->
</body>
</html>