<html>
	<body>
		<table>
			<?php if(count($detail_perm)!=0){ ?>
				<?php $i = 1; ?>
					<?php foreach($detail_perm as $p): ?>
						<tr>
							<td>No Pendaftaran</td>
							<td>:</td>
							<td>
								<input type="hidden" id="idId_perm" name="hdnIdPerm" value="<?php echo $p->id_perm ?>">
								<?php echo $p->no_pendaftaran ?>
							</td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td>:</td>
							<?php 
								$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
								$date = $p->tgl_permohonan;
								$tahun = substr($date, 0, 4);
								$bulan = substr($date, 5, 2);
								$tgl = substr($date, 8, 2);
								$tgl_permohonan_format = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;
							?>
							<td><?php echo $tgl_permohonan_format ?></td>
						</tr>
						<tr>
							<td>Nama Pemohon</td>
							<td>:</td>
							<td><?php echo $p->nama_lengkap ?></td>
						</tr>
						<tr>
							<td>Lokasi</td>
							<td>:</td>
							<td><?php echo $p->alamat ?></td>
						</tr>
						<tr>
							<td>Desa / Kel, Kecamatan</td>
							<td>:</td>
							<td><?php echo $p->nama_kel ?>,<?php echo $p->nama_kec ?></td>
						</tr>
						<tr>
							<td>Fungsi Bangunan Gedung</td>
							<td>:</td>
							<td>
								<?php echo $p->jenis_permohonan ?>
								<input type="hidden" name="hdnJenisPerm" id="idJenisPerm" value="<?php echo $p->jenis_permohonan ?>">
							</td>
						</tr>
						<tr>
							<td>Jenis Bangunan</td>
							<td>:</td>
							<td><?php echo $p->peruntukan ?></td>
						</tr>
					<?php $i++; ?>
					<?php EndForeach; ?>
			<?php }else{ ?>
						<tr>
							<td>No Pendaftaran</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Nama Pemohon</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Lokasi</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Desa / Kel,Kecamatan</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Fungsi Bangunan Gedung</td>
							<td>:</td>
							<td>
							</td>
						</tr>
						<tr>
							<td>Jenis Bangunan</td>
							<td>:</td>
							<td></td>
						</tr>
			<?php } ?>
		</table>

		<form name="frmRetribusi" class="form-horizontal" method="POST" role="form" data-toggle="validator" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/back_office/entry_retribusi/insert">
			<input type="hidden" name="hdnIntRowCount" value="1">
			<input type="hidden" name="idHdnId_perm" id="idHdnId_perm">
			
			<table width="100%">
				<tr>
					<td colspan="8"><hr></td>
				</tr>
				<tr>
					<th colspan="8"># Prasarana Lingkungan</th>
				</tr>
				<tr>
					<td colspan="8">&nbsp;</td>
				</tr>
			</table>
			<table id="idTblRetribusi">
				<tr>
					<th style="width:8px"></th>
					<!--<th>Order</th>-->
					<th colspan="2">Jenis Bangunan</th>
					<th>Luas</th>
					<th>Harga Satuan</th>
					<th colspan="2">Lantai</th>
					<th>Jumlah</th>
				</tr>
				<tr>
					<td>
						<input type="Button" value="+" onclick="addRow(document.frmRetribusi.hdnIntRowCount.value)">
						<input type='Hidden' name='Baris0' value='0'>
					</td>
					<td>
						<select name="selJenisBangunan0" onchange="getTransactionRet(this.value,0,'isbangunan');">
							<option value="">--select--</option>
							<option value="Perusahaan">Perusahaan</option>
							<option value="Rumah Tinggal">Rumah Tinggal</option>
							<option value="Sosial Umum">Sosial Umum</option>
						</select>
					</td>
					<td>
						<input size="5" type="hidden" id="idPersentaseJB0" name="txtPersentaseJB0" disabled> 
					</td>
					<td>
						<input type="text" id="idLuas0" name="txtLuas0" onkeyup="getTransactionRet('',0,'')">
					</td>
					<td>
						Rp <input type="text" id="idHargaSatuan0" name="txtHargaSatuan0" onkeyup="getTransactionRet('',0,'')">
					</td>
					<td>
						<select name="selLantai0" onchange="getTransactionRet(this.value,0,'isnilai');">
							<option value="">--select--</option>
							<option value="lt01">Lantai 1</option>
							<option value="lt02">Lantai 2</option>
							<option value="lt03">Lantai 3</option>
							<option value="lt04">Lantai 4</option>
							<option value="lt05">Lantai 5</option>
						</select>
					</td>
					<td>
						<input size="5" type="hidden" id="idLantai0" name="txtNilaiLantai0" disabled>
					</td>
					<td>
						<input type="text" id="idJmlRetribusi0" name="txtJumlah0">
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<th colspan="6" align="right" width="81.29%">Total Retribusi</th>
					<td align="right"><input type="text" id="totalAll" name="txtTotal"></td>
				</tr>
				<tr>
					<td colspan="7"></td>
				</tr>
				<tr>
					<td colspan="7" align="center">
						<input type="submit" value="Simpan"> &nbsp;
						<input type="button" onclick="history.back()" value="Batal">
					</td>
				</tr>
			</table>
			<input type="Hidden" name="intCounter" value="1">
			<input type="Hidden" name="txtIntID0" value="">
		</form>
		<script>
			function addRow(RowCount){
				var a = document.frmRetribusi.hdnIntRowCount.value = parseInt(RowCount) + 1;
				var tableActive = document.getElementById("idTblRetribusi");
				var newTR = tableActive.insertRow(tableActive.rows.length);
				var newTD = newTR.insertCell(0);
				newTD.innerHTML = "<input type='Button' value='-' onclick='delRow("+RowCount+");'><input type='Hidden' name='Baris"+RowCount+"' value='"+RowCount+"'>";
				newTD.align = "center";
				var newTD = newTR.insertCell(1);
				newTD.innerHTML = '<select name="selJenisBangunan'+RowCount+'" onchange="getTransactionRet(this.value,'+RowCount+',\'isbangunan\');"><option value="">--select--</option><option value="Perusahaan">Perusahaan</option><option value="Rumah Tinggal">Rumah Tinggal</option><option value="Sosial Umum">Sosial Umum</option></select>';
				var newTD = newTR.insertCell(2);
				newTD.innerHTML = "<input type='hidden' size='5' id='idPersentaseJB"+RowCount+"' name='txtPersentaseJB"+RowCount+"' disabled>";
				var newTD = newTR.insertCell(3);
				newTD.innerHTML = '<input type="text" id="idLuas'+RowCount+'" name="txtLuas'+RowCount+'" onkeyup="getTransactionRet(\'\','+RowCount+',\'\')">';
				var newTD = newTR.insertCell(4);
				newTD.innerHTML = 'Rp <input type="text" id="idHargaSatuan'+RowCount+'" name="txtHargaSatuan'+RowCount+'" onkeyup="getTransactionRet(\'\','+RowCount+',\'\')">';
				var newTD = newTR.insertCell(5);
				newTD.innerHTML = '<select name="selLantai'+RowCount+'" onchange="getTransactionRet(this.value,'+RowCount+',\'isnilai\');"><option value="">--select--</option><option value="lt01">Lantai 1</option><option value="lt02">Lantai 2</option><option value="lt03">Lantai 3</option><option value="lt04">Lantai 4</option><option value="lt05">Lantai 5</option></select>';
				var newTD = newTR.insertCell(6);
				newTD.innerHTML = "<input type='hidden'  size='5' name='txtLantai"+RowCount+"' id='idLantai"+RowCount+"' disabled>";
				var newTD = newTR.insertCell(7);
				newTD.innerHTML = "<input type='text' id='idJmlRetribusi"+RowCount+"' name='txtJumlah"+RowCount+"'>";
				/**/
				document.frmRetribusi.intCounter.value = parseInt(document.frmRetribusi.intCounter.value)+1;
			}
			// 
			function delRow(rowdelete) {
				hitungRow = 0;
				var tableActive = document.getElementById("idTblRetribusi");
				for(idx=0; idx<document.frmRetribusi.hdnIntRowCount.value; idx++){
					if(eval("document.frmRetribusi.Baris"+idx)){
						hitungRow += 1;
						if(eval("document.frmRetribusi.Baris"+idx).value == rowdelete){
							break;
						}
					}
				}
				tableActive.deleteRow(hitungRow);
				document.frmRetribusi.intCounter.value = parseInt(document.frmRetribusi.intCounter.value)-1;
				// 
				// getTransactionRet('',rowdelete-1,'');
			}
			// transaksi
			function getTransactionRet(data,idx,flag){
				if(idx=='fix'){
					alert(idx);
				}
				// alert(idx);
				// begin getidperm
				var setId_perm = document.getElementById("idId_perm").value;
				document.getElementById("idHdnId_perm").value=setId_perm;
				// end
				// is setValueNilai
				if(flag == 'isnilai'){
					if(data == 'lt01'){
						document.getElementById("idLantai"+idx).value=1;
					}else if(data == 'lt02'){
						document.getElementById("idLantai"+idx).value=1.090;
					}else if(data == 'lt03'){
						document.getElementById("idLantai"+idx).value=1.120;
					}else if(data == 'lt04'){
						document.getElementById("idLantai"+idx).value=1.135;
					}else if(data == 'lt05'){
						document.getElementById("idLantai"+idx).value=1.162;
					}else{
						document.getElementById("idLantai"+idx).value=0;
					}
				}
				// 
				// 
				if(flag=='isbangunan'){
					if(data == 'Perusahaan'){
						document.getElementById("idPersentaseJB"+idx).value=2.8;
					}else if(data == 'Rumah Tinggal'){
						document.getElementById("idPersentaseJB"+idx).value=1.8;
					}else if(data == 'Sosial Umum'){
						document.getElementById("idPersentaseJB"+idx).value=1.3;
					}
				}
				// 
				
				var idLantai = document.getElementById("idLantai"+idx).value || 0;
				var idLuas = document.getElementById("idLuas"+idx).value || 0;
				var idHargaSatuan = document.getElementById("idHargaSatuan"+idx).value || 0;
				var idPersentaseJB = document.getElementById("idPersentaseJB"+idx).value || 0;
				
				var aJmlRetribusi = (parseFloat(idLuas)*parseFloat(idHargaSatuan)*parseFloat(idLantai)*parseFloat(idPersentaseJB)/100);
				// alert(aJmlRetribusi);
				
				document.getElementById("idJmlRetribusi"+idx).value=aJmlRetribusi;
				var totalAll = 0;
				for(var i=0; i<idx+1;i++){
					var aTotal = document.getElementById("idJmlRetribusi"+i).value || 0;
					totalAll = parseFloat(totalAll)+parseFloat(aTotal);
				}
				// get JenisPermohonan
				var idJenisPerm = document.getElementById("idJenisPerm").value;
				if(idJenisPerm == 'Mendirikan'){
					var setValJenisPerm = 100;
				}else if(idJenisPerm == 'Memperluas'){
					var setValJenisPerm = 100;
				}else if(idJenisPerm == 'Memperbaiki'){
					var setValJenisPerm = 50;
				}
				// 
				var totalPersentaseAll = (parseFloat(totalAll)*setValJenisPerm)/100;
				document.getElementById("totalAll").value=totalPersentaseAll;
			}
		</script>
	</body>
</html>
