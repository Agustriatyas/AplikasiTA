<?php 	
	// session_start();
	// if(empty($_SESSION['id_user'])&&empty($_SESSION['nm_level'])){
	// 	header("location:login.php");
	// }else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>BPPTPM Kab.Ciamis</title>
	<script>
		function addTab(title, url){
			if($('#tt').tabs('exists',title)){
				$('#tt').tabs('select',title);
			}else{
				var content = '<iframe scrolling="auto" frameborder="0" src="'+url+'" style="width:100%;height:100%;"></iframe>';
				//var content = '<iframe scrolling="auto" frameborder="0" src='<?php echo site_url('front_office/pemohon/index');?>' style="width:100%;height:100%;"></iframe>';
				$('#tt').tabs('add',{
					title:title,
					content:content,
					closable:true
				});
			}
		}
	</script>
	<link rel="stylesheet" type="text/css" href="../assets/mycss/index.css">
	<link rel="stylesheet" type="text/css" href="../assets/jquery_easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="../assets/jquery_easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="../assets/jquery_easyui/themes/panel.css">
	<script type="text/javascript" src="../assets/jquery_easyui/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/jquery_easyui/jquery.easyui.min.js"></script>

</head>
<body>
	<div id="header"></div>
	<div id="navigasi">
		<div style="width:200px;height:auto;padding:5px;float:left;margin-right:10px;background:#7190E0;">
			<?php //PENDAFTARAN ?>
			<div class="easyui-panel" title="FRONT OFFICE" collapsed="true" collapsible="true" style="width:200px;height:auto;padding:10px;">
				<a href="#" class="easyui-linkbutton" iconCls="icon-user" plain="true" onClick="addTab('Permohonan Izin','<?php echo site_url('front_office/pemohon');?>')">Permohonan Izin</a><br/>
				<a href="#" class="easyui-linkbutton" iconCls="icon-shop" plain="true" onClick="addTab('Data Permohonan','<?php echo site_url('front_office/pemohon/permohonan');?>')">Data Permohonan</a><br/>
				<!--a href="#" class="easyui-linkbutton" iconCls="icon-supplier" plain="true" onClick="addTab('Data Lokasi Izin','supplier.php')">Data Lokasi Izin</a><br/>
				<a href="#" class="easyui-linkbutton" iconCls="icon-box" plain="true" onClick="addTab('Persyaratan','jenis_barang.php')">Persyaratan</a><br/-->
				<!--a href="#" class="easyui-linkbutton" iconCls="icon-box-fill" plain="true" onClick="addTab('Data Barang','barang.php')">Data Barang</a><br/-->
			</div><br/>
			<?php //KASUBID ?>
			<div class="easyui-panel" title="KASUBID" collapsed="true" collapsible="true" style="width:200px;height:auto;padding:10px;">
				<a href="#" class="easyui-linkbutton" iconCls="icon-user" plain="true" onClick="addTab('Approval Kasubid','<?php echo site_url('kasubid/kasubid');?>')">Approval Kasubid</a><br/>
			</div><br/>
			<?php //BACK OFFICE ?>
			<div class="easyui-panel" title="BACK OFFICE" collapsed="true" collapsible="true" style="width:200px;height:auto;padding:10px;" >
				<a href="#" class="easyui-linkbutton" iconCls="icon-trolly" plain="true" onClick="addTab('Entry Data Perizinan','<?php echo site_url('back_office/entry_data');?>')">Entry Data Perizinan</a><br/>
				<a href="#" class="easyui-linkbutton" iconCls="icon-truck" plain="true" onClick="addTab('Penjadwalan Tinjauan','<?php echo site_url('penjadwalan/jadwal_tinjauan');?>')">Penjadwalan Tinjauan</a><br/>
				<a href="#" class="easyui-linkbutton" iconCls="icon-stack-f" plain="true" onClick="addTab('Entry Hasil Tinjauan','<?php echo site_url('back_office/entry_data_tinjauan');?>')">Entry Hasil Tinjauan</a><br/>
				<a href="#" class="easyui-linkbutton" iconCls="icon-stack-f" plain="true" onClick="addTab('Perhitungan Retribusi','<?php echo site_url('back_office/retribusi');?>')">Perhitungan Retribusi</a><br/>
				<a href="#" class="easyui-linkbutton" iconCls="icon-stack-e" plain="true" onClick="addTab('Pembuatan Berita Acara Pemeriksaan','<?php echo site_url('back_office/pembuatan_bap');?>')">Pembuatan Berita Acara Pemeriksaan</a><br/>
				<a href="#" class="easyui-linkbutton" iconCls="icon-stack-e" plain="true" onClick="addTab('Pembuatan Izin','<?php echo site_url('back_office/pembuatan_izin');?>')">Pembuatan Izin</a><br/>
			</div><br/>
			<?php //KABID ?>
			<div class="easyui-panel" title="KABID" collapsed="true" collapsible="true" style="width:200px;height:auto;padding:10px;">
				<a href="#" class="easyui-linkbutton" iconCls="icon-user" plain="true" onClick="addTab('Penetapan Izin','<?php echo site_url('kabid/penetapan_izin');?>')">Penetapan Izin</a><br/>
			</div><br/>
			<?php //KASIR ?>
			<div class="easyui-panel" title="KASIR" collapsed="true" collapsible="true" style="width:200px;height:auto;padding:10px;">
				<a href="#" class="easyui-linkbutton" iconCls="icon-user" plain="true" onClick="addTab('Pembayaran Retribusi','<?php echo site_url('kasir/pembayaran_retribusi');?>')">Pembayaran Retribusi</a><br/>
			</div><br/>
			<?php //KELOLA USER ?>
			<!--div class="easyui-panel" title="KELOLA USER" collapsed="true" collapsible="true" style="width:200px;height:auto;padding:10px;">
				<a href="#" class="easyui-linkbutton" iconCls="icon-user" plain="true" onClick="addTab('Kelola User','<?php //echo site_url('kelola_user/kelola_user');?>')">Kelola User</a><br/>
			</div><br/-->
			<?php //LAPORAN ?>
			<div class="easyui-panel" title="LAPORAN" collapsed="true" collapsible="true" style="width:200px;height:auto;padding:10px;">
				<a href="#" class="easyui-linkbutton" iconCls="icon-user" plain="true" onClick="addTab('Laporan Pendaftaran','<?php echo site_url('laporan/laporan_pendaftaran');?>')">Laporan Pendaftaran</a><br/>
				<a href="#" class="easyui-linkbutton" iconCls="icon-user" plain="true" onClick="addTab('Laporan Penerimaan','<?php echo site_url('laporan/laporan_penerimaan');?>')">Laporan Penerimaan Retribusi</a><br/>
			</div><br/>
			<div class="easyui-panel" title="AKSES" collapsible="true" style="width:200px;height:auto;padding:10px;">
				<!--a href="akses/logout.php" class="easyui-linkbutton" iconCls="icon-logout" plain="true">Logout</a-->
				<?php echo anchor(base_url().'index.php/c_login/logout/', 'Logout'); ?>
				<br/>
			</div>
		</div>
	</div>
	<div id="isi">
		<div id="tt" class="easyui-tabs" style="height:500px">
			<div title="Home" style="padding-top:20px;text_align:center;background-image:url(../assets/mycss/images/home.jpg);background-repeat:no-repeat;background-color:#FFF;">
			</div>
		</div>
	</div>
	<div id="footer"> BPPTPM-CIAMIS-2016-AW
	</div>
</body>
</html>

<?php //} ?>