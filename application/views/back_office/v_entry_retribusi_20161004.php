<script type="text/javascript">

	$(document).ready(function(){
		$("#dialog").hide();
		$("#dialog").dialog({autoOpen: false, width:'auto',modal: true});
		$('.Button').button();
		$('#FRincian').submit(function(){
			var hasil = hitung_index();
			var grid = $('#grid_name').val();
			$('#'+grid+' #index_integrasi').val(hasil);
			$('#'+grid+' .b').val(hasil);
			$.ajax({
				url: '<?php echo base_url();?>/imb/perhitungan/save_integrasi',
				type: 'POST',
				async: false,
				dataType:'html',
				data: $(this).serialize(),
				success: function(data){
					$('#'+grid+' .c').val(data);
					$('#dialog').dialog('close');
				}, 
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					
				},
				timeout: 5000
			});
			return false;	
		});
	});
	
	var deleteRow = function (link,x,y) {
		 var  SUM  = isNaN($('#total').val())?0:parseFloat($('#total').val());
		 var jum_sebelumnya = isNaN($('#jumlah'+y).val())?0:parseFloat($('#jumlah'+y).val());
		 TEMP = SUM - jum_sebelumnya;
		 $('#total').val(TEMP);

		 var row = link.parentNode.parentNode;
		 var table = row.parentNode; 
		
		 table.removeChild(row);
		 // hitung_retribusi_perbaris(x,y);
	 }
	
	function sempadan_data(){
		var value = '';
		$.ajax({
			url : '<?php echo base_url();?>imb/perhitungan/sempadan',
			dataType : 'html',
			async: false,
			success: function(data){
				value = data;
			}
		});
		return value;
	}
	
	function list_prasarana(){
		var value = '';
		$.ajax({
			url : '<?php echo base_url();?>imb/perhitungan/prasarana',
			dataType : 'html',
			async: false,
			success: function(data){
				value = data;
			}
		});
		return value;
	}

	function hitung_retribusi_perbaris(table,row){
		data = new Array();
		data[0] = $("#grid"+table+" #val_luas"+row).val()==""?0:parseFloat($("#grid"+table+" #val_luas"+row).val()); 
		data[1] = $("#grid"+table+" #val_hrg_satuan"+row).val()==""?0:parseInt($("#grid"+table+" #val_hrg_satuan"+row).val()); 
		data[2] = $("#grid"+table+" #val_jns_bangunan"+row).val()==""?0:parseFloat($("#grid"+table+" #val_jns_bangunan"+row).val()); 
		data[3] = $("#grid"+table+" #val_tggi_bangunan"+row).val()==""?0:parseFloat($("#grid"+table+" #val_tggi_bangunan"+row).val()); 
		data[4] = $("#grid"+table+" #lantai"+row).val()==""?0:$("#grid"+table+" #lantai"+row).val(); 
		if(data[4] == 'Lantai 1'){
			if(data[3] > 5){
				data[5] = parseFloat(1.090);
			}else{
				data[5] = parseFloat(1);
			}	
		}else if(data[4] == 'Lantai 2'){
			data[5] = parseFloat(1.090);	
		}else if(data[4] == 'Lantai 3'){
			data[5] = parseFloat(1.120);	
		}else if(data[4] == 'Lantai 4'){
			data[5] = parseFloat(1.135);	
		}else if(data[4] == 'Lantai 5'){
			data[5] = parseFloat(1.162);	
		}
		//data[4] = $("#grid"+table+" #lantai"+row).val();
		//data[4] = document.getElementById('lantai').value;
		//alert(data[4]);
		var  SUM  = isNaN($('#total').val())?0:parseFloat($('#total').val());
		var jum_sebelumnya = isNaN($('#jumlah'+row).val())?0:parseFloat($('#jumlah'+row).val());
		if (jum_sebelumnya > 0) {
			SUM = SUM - jum_sebelumnya;
		};
		//var result = data[0]*data[1]*data[2]*data[3];
		var result = data[0]*data[1]*data[2]*data[5];
		if(isNaN(result) || result==0){
			$('#jumlah'+row).val(0);
		}else{
			$('#jumlah'+row).val(result);
		}
		TEMP = (SUM) + result;
		
		$('#total').val(TEMP);
	}

	function hitung_retribusi_perbaris1(table,row){
		data = new Array();
		data[0] = $("#grid1"+table+" #val_luas1"+row).val()==""?0:parseFloat($("#grid1"+table+" #val_luas1"+row).val()); 
		data[1] = $("#grid1"+table+" #val_hrg_satuan1"+row).val()==""?0:parseInt($("#grid1"+table+" #val_hrg_satuan1"+row).val()); 
		data[2] = $("#grid1"+table+" #val_jns_bangunan1"+row).val()==""?0:parseFloat($("#grid1"+table+" #val_jns_bangunan1"+row).val()); 
		data[3] = $("#grid1"+table+" #val_tggi_bangunan1"+row).val()==""?0:parseFloat($("#grid1"+table+" #val_tggi_bangunan1"+row).val()); 
		data[4] = $("#grid1"+table+" #lantai1"+row).val()==""?0:$("#grid1"+table+" #lantai1"+row).val(); 
		if(data[4] == 'Lantai 1'){
			if(data[3] > 5){
				data[5] = parseFloat(1.090);
			}else{
				data[5] = parseFloat(1);
			}	
		}else if(data[4] == 'Lantai 2'){
			data[5] = parseFloat(1.090);	
		}else if(data[4] == 'Lantai 3'){
			data[5] = parseFloat(1.120);	
		}else if(data[4] == 'Lantai 4'){
			data[5] = parseFloat(1.135);	
		}else if(data[4] == 'Lantai 5'){
			data[5] = parseFloat(1.162);	
		}
		//alert(data[5]);
		var  SUM  = isNaN($('#total1').val())?0:parseFloat($('#total1').val());
		// data[0] = parseFloat($("#grid1"+table+" #val_luas1"+row).val()); 
		// alert(data[0]);
		var jum_sebelumnya = isNaN($('#jumlah1'+row).val())?0:parseFloat($('#jumlah1'+row).val());
		if (jum_sebelumnya > 0) {
			SUM = SUM - jum_sebelumnya;
		};
		var result = data[0]*data[1]*data[2]*data[5];
		if(isNaN(result) || result==0){
			$('#jumlah1'+row).val(0);
		}else{
			$('#jumlah1'+row).val(result);
		}
		TEMP = (SUM) + result;
		
		$('#total1').val(TEMP);
	}

	function hitung_retribusi_perbaris2(table,row){
		data = new Array();
		data[0] = $("#grid2"+table+" #val_luas2"+row).val()==""?0:parseFloat($("#grid2"+table+" #val_luas2"+row).val()); 
		data[1] = $("#grid2"+table+" #val_hrg_satuan2"+row).val()==""?0:parseInt($("#grid2"+table+" #val_hrg_satuan2"+row).val()); 
		data[2] = $("#grid2"+table+" #val_jns_bangunan2"+row).val()==""?0:parseFloat($("#grid2"+table+" #val_jns_bangunan2"+row).val()); 
		data[3] = $("#grid2"+table+" #val_tggi_bangunan2"+row).val()==""?0:parseFloat($("#grid2"+table+" #val_tggi_bangunan2"+row).val()); 
		data[4] = $("#grid2"+table+" #lantai2"+row).val()==""?0:$("#grid2"+table+" #lantai2"+row).val(); 
		if(data[4] == 'Lantai 1'){
			if(data[3] > 5){
				data[5] = parseFloat(1.090);
			}else{
				data[5] = parseFloat(1);
			}	
		}else if(data[4] == 'Lantai 2'){
			data[5] = parseFloat(1.090);	
		}else if(data[4] == 'Lantai 3'){
			data[5] = parseFloat(1.120);	
		}else if(data[4] == 'Lantai 4'){
			data[5] = parseFloat(1.135);	
		}else if(data[4] == 'Lantai 5'){
			data[5] = parseFloat(1.162);	
		}
		//alert(data[4]);
		var  SUM  = isNaN($('#total2').val())?0:parseFloat($('#total2').val());
		// data[0] = parseFloat($("#grid1"+table+" #val_luas1"+row).val()); 
		// alert(data[0]);
		var jum_sebelumnya = isNaN($('#jumlah2'+row).val())?0:parseFloat($('#jumlah2'+row).val());
		if (jum_sebelumnya > 0) {
			SUM = SUM - jum_sebelumnya;
		};
		var result = data[0]*data[1]*data[2]*data[5];
		if(isNaN(result) || result==0){
			$('#jumlah2'+row).val(0);
		}else{
			$('#jumlah2'+row).val(result);
		}
		TEMP = (SUM) + result;
		
		$('#total2').val(TEMP);
	}

	function hitung_retribusi(table,row){
		data = new Array();
		data[0] = parseFloat($("#grid"+table+" #val_luas"+row).val()); 
		data[1] = parseInt($("#grid"+table+" #val_hrg_satuan"+row).val()); 
		data[2] = parseFloat($("#grid"+table+" #val_jns_bangunan"+row).val()); 
		data[3] = parseFloat($("#grid"+table+" #val_tggi_bangunan"+row).val()); 
		// data[4] = parseFloat($("#grid"+table+" #lant"+row).val()); 
		// //alert(data[4]);
		// var lant = document.getElementById('lant').value;
		// alert(lant);
		var result = data[0]*data[1]*data[2]*data[3];
		//document.getElementById('jumlah').value = result;
		if(isNaN(result) || result==0){
			$('#jumlah'+row).val(0);
		}else{
			result.toFixed(2);
			var SUM = $('#jumlah'+row).val();
			TEMP = parseFloat(SUM);
			TEMP += result;
			$('#jumlah'+row).val(TEMP);
		}

		//--
			var tampung_jumlah = $('#jumlah'+row).val(TEMP);
			var jumlah_total = parseFloat(tampung_jumlah) + parseFloat(tampung_jumlah);

			var to = document.getElementById('total').value;
			to = parseFloat(to);

			if(jumlah_total != ""){
			 if(!isNaN(to)){
				 // alert(to);	
				 // alert(TEMP);
				//var jum = parseFloat(TEMP) + parseFloat(to);
				var jum = parseFloat(TEMP+to);
				//$('#total').val(jum);
			 }if(isNaN(to)){
			 	var to = 0;
			 	var jum = parseFloat(TEMP+to);
			 	//$('#total').val(TEMP);
			 }
			}

			$('#total').val(TEMP);
	}

	function hitung_retribusi1(table,row){
		data = new Array();
		data[0] = parseFloat($("#grid1"+table+" #val_luas1"+row).val()); 
		data[1] = parseInt($("#grid1"+table+" #val_hrg_satuan1"+row).val()); 
		data[2] = parseFloat($("#grid1"+table+" #val_jns_bangunan1"+row).val()); 
		data[3] = parseFloat($("#grid1"+table+" #val_tggi_bangunan1"+row).val()); 
		// data[4] = parseFloat($("#grid"+table+" #lant"+row).val()); 
		// //alert(data[4]);
		// var lant = document.getElementById('lant').value;
		// alert(lant);
		var result = data[0]*data[1]*data[2]*data[3];
		//document.getElementById('jumlah').value = result;
		if(isNaN(result) || result==0){
			$('#jumlah1'+row).val(0);
		}else{
			result.toFixed(2);
			var SUM = $('#jumlah1'+row).val();
			TEMP = parseFloat(SUM);
			TEMP += result;
			$('#jumlah1'+row).val(TEMP);
		}

		//--
			var tampung_jumlah = $('#jumlah1'+row).val(TEMP);
			var jumlah_total = parseFloat(tampung_jumlah) + parseFloat(tampung_jumlah);

			var to = document.getElementById('total1').value;
			to = parseFloat(to);

			if(jumlah_total != ""){
			 if(!isNaN(to)){
				 // alert(to);	
				 // alert(TEMP);
				//var jum = parseFloat(TEMP) + parseFloat(to);
				var jum = parseFloat(TEMP+to);
				//$('#total').val(jum);
			 }if(isNaN(to)){
			 	var to = 0;
			 	var jum = parseFloat(TEMP+to);
			 	//$('#total').val(TEMP);
			 }
			}

			$('#total1').val(TEMP);
	}

	function total_retribusi(){
		data = new Array();
		data[0] = parseInt($("#grid"+table+" #jumlah"+row).val());

		document.getElementById('tot').value = data[0];
	}

	//====
	
	function add(i,prasarana){
		//alert("OKK ADD");
		var row = $("#grid"+i+" tbody tr").length;
		var lan = row;

		var html = '<tr class="row-grid'+i+' cacingrow_'+row+'" style="border: 1px solid #000;">';
		if(prasarana){
			var sempadan = list_prasarana();
		}else{
			var sempadan = sempadan_data();
		}
		var a = $('#grid'+i+' #t_bangunan').val();
		html += '<td align="center"><input type="text" name="lantai[]" id="lantai'+row+'" onchange="hitung_retribusi_perbaris('+i+','+row+')" value="Lantai '+ (row+1)+'" style="width:95%;" class="input-wrc required" required readonly/></td>';
		//}
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris('+i+','+row+')" name="val_luas[]" id="val_luas'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris('+i+','+row+')" name="val_hrg_satuan[]" id="val_hrg_satuan'+row+'" class="input-wrc required" required/></td>';
		//html += '<td align="center"><input type="text" onchange="hitung_retribusi('+i+','+row+')" name="val_jns_bangunan[]" id="val_jns_bangunan'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><select  onchange="hitung_retribusi_perbaris('+i+','+row+')" style="width:90%;" id="val_jns_bangunan'+row+'" name="val_jns_bangunan[]" class="input-select-wrc required" required>'+index_kegiatan1()+'</select></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris('+i+','+row+')" name="val_tggi_bangunan[]" id="val_tggi_bangunan'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><input type="text" name="jumlah_ret[]" id="jumlah'+row+'" class="input-wrc required" required readonly/></td>';

		html += '<td align="center" style="border-right: 1px solid #000;"><a onClick="javascript:deleteRow(this,'+i+','+row+'); return false;" href="javascript:void(0)"><img src="<?php echo base_url();?>/assets/images/icon/cross.png"/></a>'+Tambahan(a)+'</td>';
		html += '</tr>';
		$('#grid'+i).append(html);
		
		var it = $('#grid'+i+' #index_integrasi').val();
		$('#grid'+i+'  .b').val(it);
		var c = $('#grid'+i+'  .c').val();
	    $('#grid'+i+'  .c').val(c);

	}

	function add3(i,prasarana){
		//alert("OKK ADD 3");
		var row = $("#grid3"+i+" tbody tr").length;

		var lan = row;
		var html = '<tr class="row-grid'+i+' cacingrow_'+row+'" style="border: 1px solid #000;">';
		if(prasarana){
			var sempadan = list_prasarana();
		}else{
			var sempadan = sempadan_data();
		}
		var a = $('#grid3'+i+' #t_bangunan3').val();
		html += '<td align="center"><input type="text" name="lantai3[]" id="lantai3'+row+'" onchange="hitung_retribusi_perbaris3('+i+','+row+')" value="Lantai '+ (row+1)+'" style="width:95%;" class="input-wrc required" required readonly/></td>';
		//}
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris3('+i+','+row+')" name="val_luas3[]" id="val_luas3'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris3('+i+','+row+')" name="val_hrg_satuan3[]" id="val_hrg_satuan3'+row+'" class="input-wrc required" required/></td>';
		//html += '<td align="center"><input type="text" onchange="hitung_retribusi('+i+','+row+')" name="val_jns_bangunan[]" id="val_jns_bangunan'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><select  onchange="hitung_retribusi_perbaris3('+i+','+row+')" style="width:90%;" id="val_jns_bangunan3'+row+'" name="val_jns_bangunan3[]" class="input-select-wrc required" required>'+index_kegiatan1()+'</select></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris3('+i+','+row+')" name="val_tggi_bangunan3[]" id="val_tggi_bangunan3'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><input type="text" name="jumlah_ret3[]" id="jumlah3'+row+'" class="input-wrc required" required readonly/></td>';

		html += '<td align="center" style="border-right: 1px solid #000;"><a onClick="javascript:deleteRow(this,'+i+','+row+'); return false;" href="javascript:void(0)"><img src="<?php echo base_url();?>/assets/images/icon/cross.png"/></a>'+Tambahan(a)+'</td>';
		html += '</tr>';
		$('#grid3'+i).append(html);
		
		var it = $('#grid3'+i+' #index_integrasi').val();
		$('#grid3'+i+'  .b').val(it);
		var c = $('#grid3'+i+'  .c').val();
	    $('#grid3'+i+'  .c').val(c);

	}

	function hitung_retribusi_perbaris3(table,row){
		data = new Array();
		data[0] = $("#grid3"+table+" #val_luas3"+row).val()==""?0:parseFloat($("#grid3"+table+" #val_luas3"+row).val()); 
		data[1] = $("#grid3"+table+" #val_hrg_satuan3"+row).val()==""?0:parseInt($("#grid3"+table+" #val_hrg_satuan3"+row).val()); 
		data[2] = $("#grid3"+table+" #val_jns_bangunan3"+row).val()==""?0:parseFloat($("#grid3"+table+" #val_jns_bangunan3"+row).val()); 
		data[3] = $("#grid3"+table+" #val_tggi_bangunan3"+row).val()==""?0:parseFloat($("#grid3"+table+" #val_tggi_bangunan3"+row).val()); 
		data[4] = $("#grid3"+table+" #lantai3"+row).val()==""?0:$("#grid3"+table+" #lantai3"+row).val(); 
		if(data[4] == 'Lantai 1'){
			if(data[3] > 5){
				data[5] = parseFloat(1.090);
			}else{
				data[5] = parseFloat(1);
			}	
		}else if(data[4] == 'Lantai 2'){
			data[5] = parseFloat(1.090);	
		}else if(data[4] == 'Lantai 3'){
			data[5] = parseFloat(1.120);	
		}else if(data[4] == 'Lantai 4'){
			data[5] = parseFloat(1.135);	
		}else if(data[4] == 'Lantai 5'){
			data[5] = parseFloat(1.162);	
		}
		//alert(data[5]);
		var  SUM  = isNaN($('#total3').val())?0:parseFloat($('#total3').val());
		var jum_sebelumnya = isNaN($('#jumlah3'+row).val())?0:parseFloat($('#jumlah3'+row).val());
		if (jum_sebelumnya > 0) {
			SUM = SUM - jum_sebelumnya;
		};
		var result = data[0]*data[1]*data[2]*data[5];
		if(isNaN(result) || result==0){
			$('#jumlah3'+row).val(0);
		}else{
			$('#jumlah3'+row).val(result);
		}
		TEMP = (SUM) + result;
		
		$('#total3').val(TEMP);
	}



	function add1(i,prasarana){
		//alert("OK ADD 1");
		var row = $("#grid1"+i+" tbody tr").length;
		//alert(row);
		var lan = row;
		var html = '<tr class="row-grid'+i+' cacingrow_'+row+'" style="border: 1px solid #000;">';
		if(prasarana){
			var sempadan = list_prasarana();
		}else{
			var sempadan = sempadan_data();
		}
		var a = $('#grid1'+i+' #t_bangunan1').val();
		//alert(a);
		html += '<td align="center"><input type="text" name="lantai1[]" id="lantai1'+row+'" onchange="hitung_retribusi_perbaris1('+i+','+row+')" value="Lantai '+ (row+1)+'" style="width:95%;" class="input-wrc required" required readonly/></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris1('+i+','+row+')" name="val_luas1[]" id="val_luas1'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris1('+i+','+row+')" name="val_hrg_satuan1[]" id="val_hrg_satuan1'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><select  onchange="hitung_retribusi_perbaris1('+i+','+row+')" style="width:90%;" id="val_jns_bangunan1'+row+'" name="val_jns_bangunan1[]" class="input-select-wrc required" required>'+index_kegiatan_cacing()+'</select></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris1('+i+','+row+')" name="val_tggi_bangunan1[]" id="val_tggi_bangunan1'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><input type="text" name="jumlah_ret1[]" id="jumlah1'+row+'" class="input-wrc required" required readonly/></td>';

		html += '<td align="center" style="border-right: 1px solid #000;"><a onClick="javascript:deleteRow(this,'+i+','+row+'); return false;" href="javascript:void(0)"><img src="<?php echo base_url();?>/assets/images/icon/cross.png"/></a>'+Tambahan(a)+'</td>';
		html += '</tr>';
		$('#grid1'+i).append(html);
		
		var it = $('#grid1'+i+' #index_integrasi').val();
		$('#grid1'+i+'  .b').val(it);
		var c = $('#grid1'+i+'  .c').val();
	    $('#grid1'+i+'  .c').val(c);

	}

	function index_kegiatan_cacing(thuglife){
		var html = '<option></option>';
			
		if(thuglife == "perbaiki"){
			html += '<option value="0.014">Perusahaan</option>';
			html += '<option value="0.009">Rumah Tinggal</option>';
			html += '<option value="0.0065">Sosial/Umum</option>';
			return html;
		}else{
				var html = '<option></option>';
				html += '<option value="0.028">Perusahaan</option>';
				html += '<option value="0.018">Rumah Tinggal</option>';
				html += '<option value="0.013">Sosial/Umum</option>';
				return html;				
		}
	}

	//mendirikan & memperbaiki
	function add2(i,prasarana){
		//alert("OK ADD 2");
		var row = $("#grid2"+i+" tbody tr").length;
		//alert(row);
		var lan = row;
		var html = '<tr class="row-grid'+i+' cacingrow_'+row+'" style="border: 1px solid #000;">';
		if(prasarana){
			var sempadan = list_prasarana();
		}else{
			var sempadan = sempadan_data();
		}
		var a = $('#grid2'+i+' #t_bangunan2').val();
		//alert(a);
		html += '<td align="center"><input type="text" name="lantai2[]" id="lantai2'+row+'" onchange="hitung_retribusi_perbaris2('+row+','+row+')" value="Lantai '+ (row+1)+'" style="width:95%;" class="input-wrc required" required readonly/></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris2('+i+','+row+')" name="val_luas2[]" id="val_luas2'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris2('+i+','+row+')" name="val_hrg_satuan2[]" id="val_hrg_satuan2'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><select  onchange="hitung_retribusi_perbaris2('+i+','+row+')" style="width:90%;" id="val_jns_bangunan2'+row+'" name="val_jns_bangunan2[]" class="input-select-wrc required" required>'+index_kegiatan_cacing("perbaiki")+'</select></td>';
		html += '<td align="center"><input type="text" onchange="hitung_retribusi_perbaris2('+i+','+row+')" name="val_tggi_bangunan2[]" id="val_tggi_bangunan2'+row+'" class="input-wrc required" required/></td>';
		html += '<td align="center"><input type="text" name="jumlah_ret2[]" id="jumlah2'+row+'" class="input-wrc required" required readonly/></td>';

		html += '<td align="center" style="border-right: 1px solid #000;"><a onClick="javascript:deleteRow(this,'+i+','+row+'); return false;" href="javascript:void(0)"><img src="<?php echo base_url();?>/assets/images/icon/cross.png"/></a>'+Tambahan(a)+'</td>';
		html += '</tr>';
		$('#grid2'+i).append(html);
		
		var it = $('#grid2'+i+' #index_integrasi').val();
		$('#grid2'+i+'  .b').val(it);
		var c = $('#grid2'+i+'  .c').val();
	    $('#grid2'+i+'  .c').val(c);

	}

	
	function Tambahan(a){
		return "<input type='hidden' name='a[]' value='"+a+"'/><input type='hidden' class='b' name='b[]'/><input type='hidden' class='c' name='c[]'/>";
	}

	function index_kegiatan(){
		var html = '<option></option>';
		html += '<option value="1.00">1.00</option>';
		html += '<option value="0.30">0.30</option>';
		html += '<option value="0.45">0.45</option>';
		html += '<option value="0.65">0.65</option>';
		return html;
	}

	function index_kegiatan1(){
		
		var id_perm = document.getElementById('id_perm').value;
		if(id_perm == 28){
			var html = '<option></option>';
			html += '<option value="0.014">Perusahaan</option>';
			html += '<option value="0.009">Rumah Tinggal</option>';
			html += '<option value="0.0065">Sosial/Umum</option>';
			return html;

		}else{
			var html = '<option></option>';
			html += '<option value="0.028">Perusahaan</option>';
			html += '<option value="0.018">Rumah Tinggal</option>';
			html += '<option value="0.013">Sosial/Umum</option>';
			return html;	
		}
	}
	
	function harga(i,row,index){
		$.ajax({
			url : '<?php echo base_url();?>imb/perhitungan/get_harga_satuan/'+index,
			dataType : 'html',
			async: false,
			success: function(data){
				$('#grid'+i+' #harga_satuan'+row).val(data);
				set_jumlah(i,row);
			}
		});
	}
	
	function calc(i){
		var grid = $('#grid'+i+' tbody tr').length;
		$("#FRincian").trigger('reset');
		$('#grid_name').val('grid'+i);
		$("#dialog #grid_name").val('grid'+i);
		$('#dialog').dialog('open');
	}
	
	function hitung_index(){
		var hasil = parseFloat(0.00);
		var fungsi = parseFloat($('#fungsi').val());	
		var waktu = parseFloat($('#waktu').val());			
		var parameter = new Array();
		parameter[0] = parseFloat($('#parameter1').val());
		parameter[1] = parseFloat($('#parameter2').val());
		parameter[2] = parseFloat($('#parameter3').val());
		parameter[3] = parseFloat($('#parameter4').val());
		parameter[4] = parseFloat($('#parameter5').val());
		parameter[5] = parseFloat($('#parameter6').val());
		parameter[6] = parseFloat($('#parameter7').val());
		var jml_paramater = parseFloat(0.00);
		for(i=0;i<parameter.length;i++){
			jml_paramater+=parameter[i];
		}
		hasil = fungsi * jml_paramater * waktu;
		return hasil.toFixed(3);
	}	
	
	
	function set_jumlah(table,row){
		data = new Array();
		data[0] = $("#grid"+table+" #index_integrasi").val(); 
		data[1] = parseInt($("#grid"+table+" #harga_satuan"+row).val()); 
		data[2] = parseInt($("#grid"+table+" #luas"+row).val()); 
		data[3] = $("#grid"+table+" #index_kegiatan"+row).val(); 
		var result = data[0]*data[1]*data[2]*data[3];
		if(isNaN(result) || result==0){
			$('#SUM').val(0);
		}else{
			result.toFixed(2);
			var SUM = $('#SUM').val();
			TEMP = parseInt(SUM);
			TEMP += result;
			$('#SUM').val(TEMP);
		}
		
	}
	
</script>

<div id="content">
    <div class="post">
        <div class="title">
            <h2><?php echo //$page_name; ?></h2>
        </div>
		<?php
			if($id_perm == 1 || $id_perm == 26 || $id_perm == 27 || $id_perm == 28){
				echo form_open('imb/perhitungan/save');
			}else if($id_perm == 29 || $id_perm == 30 || $id_perm == 31 || $id_perm == 32){
				echo form_open('imb/perhitungan/save_dua');
			}
			echo form_hidden('jumlah', $jumlah);
			echo form_hidden('id_permohonan', $id_permohonan);


			echo "<input type='hidden' name='id_perm' id='id_perm' value=$id_perm>";
			//echo "<input type='text' name='mendirikan_memperbaiki' id='mendirikan_memperbaiki' value=$mendirikan_memperbaiki>";
			
			$rincian = new trrinci_bangunan_imb();
			$rincian->where('tmpermohonan_id',$id_permohonan);
			$rincian->group_by('type_bangunan');
			$rincian->get();
					
			$data_type = array();
			$i = 0;	
			if($rincian->exists()){
				foreach($rincian as $r){
					$data_type[$i] = $r->type_bangunan;			
					$i++;
				}
			}
			
		?>
		<div class="entry">
			<table cellpadding="0" cellspacing="0" border="0" class="display" style="padding-top:10px; margin-bottom:10px;">
				 <input type="hidden" id="SUM" value="0"/>
				 <tr style="border: 1px solid #000; background-color: #CED9FE;">
					<td style="width:20%" align="left">No Pendaftaran</td> 	 
					<td>:</td>
					<td align="left" style="width:80%"><?php echo $no_pendaftaran;?></td> 		
				 </tr>
				 <tr style="border: 1px solid #000; background-color: #CED9FE;">
					<td style="width:20%" align="left">Tanggal</td> 	 
					<td>:</td>
					<td align="left" style="width:80%"><?php echo $tgl_daftar;?></td> 	
				 </tr>
				 <tr style="border: 1px solid #000; background-color: #CED9FE;">
					<td style="width:20%" align="left">Nama Pemohon</td> 	 
					<td>:</td>
					<td align="left" style="width:80%"><?php echo $nama_pemohon;?></td> 		
				 </tr>
				 <tr style="border: 1px solid #000; background-color: #CED9FE;">
					<td style="width:20%" align="left">Lokasi</td> 	 
					<td>:</td>
					<td align="left" style="width:80%"><?php echo $lokasi;?></td> 		
				 </tr>
				 <tr style="border: 1px solid #000; background-color: #CED9FE;">
					<td style="width:20%" align="left">Desa / Kel, Kecamatan </td> 	 
					<td>:</td>
					<td align="left" style="width:80%"><?php echo $desa;?></td> 		
				 </tr>
				 <tr style="border: 1px solid #000; background-color: #CED9FE;">
					<td style="width:20%" align="left">Fungsi Bangunan Gedung</td> 	 
					<td>:</td>
					<td align="left" style="width:80%">-</td> 	
				 </tr>
				 <tr style="border: 1px solid #000; background-color: #CED9FE;">
					<td style="width:20%" align="left">Jenis Bangunan</td> 	 
					<td>:</td>
					<td align="left" style="width:80%">-</td> 	
				 </tr>
			</table>
		</div>
		<?php if($id_perm == 1 || $id_perm == 26 || $id_perm == 27 || $id_perm == 28){ ?>
        <div class="entry">
			<?php 
				
				for($i=1;$i<=$jumlah;$i++): 
				
			?>
            <table cellpadding="0" cellspacing="0" border="0" class="display" style="padding-top:10px; margin-bottom:40px;" id="grid<?php echo$i;?>">
                <thead>
					<tr style="border: 1px solid #000; background-color: #CED9FE;">
						<?php
							 if(!empty($data_type)){
								 $value = $data_type[$i-1];
							 }else{
								 $value = null;
							 }
							 
							 //$a = new trretribusi_imb();
							 $a = new trretribusi_imb_ciamis();
							 $a->where('tmpermohonan_id',$id_permohonan);
							 //$a->where('type_bangunan',$value);
							 //$a->group_by('type_bangunan')->get();
							 
							 if($a->index_terintegrasi==null){
								$ik = null;
							 }else{
								$ik =$a->index_terintegrasi;
							 }
							 
							 
							 
							 
						?>
						<td colspan="5">
							<b>#<?php echo $i;?></b>,  Type : <input type="text" id="t_bangunan" readonly="true" value="<?php echo $value;?>" name="type[]" class="type input-wrc required" required/>
						</td>
						<td colspan="4" align="right">
							<a href="javascript:void(0)" title="Hitung Index" alt="Hitung Index" onClick="calc(<?php echo $i;?>)">
								<img src="<?php echo base_url() . 'assets/images/icon/calculator.png'; ?>"/>
							</a>
							<a href="javascript:void(0)" title="Tambah Data" alt="Tambah Data" onClick="add(<?php echo $i;?>)">
								<img src="<?php echo base_url() . 'assets/images/icon/plus.png'; ?>"/>
							</a>
						</td>
					</tr>
					<tr>
						<td colspan="7" align="left" style="border: 1px solid #000; background-color: #CED9FE;">
							<b>Index Terintgrasi</b> : <input style="width:5%;"  value="<?php echo $ik;?>" id="index_integrasi" type="text" readonly="true" name="index_integrasi[]" class="index_integrasi type input-wrc required" required/>
						</td>
					</tr>
                    <tr style="border: 1px solid #000; background-color: #eee">
						<th>Lantai</th>
                        <th>Luas</th>
						<th>Harga Satuan</th>
						<th>Jenis Bangunan</th>
						<th>Tinggi Bangunan</th>
						<th>Jumlah</th>
                        <th style='border-right: 1px solid #000;'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
					<?php
						
						// $xs = new trretribusi_imb();
						// $data = $xs->where('type_bangunan',$value)->where('tmpermohonan_id', $id_permohonan)->get();
						$xs = new trretribusi_imb_ciamis();
						$data = $xs->where('tmpermohonan_id', $id_permohonan)->get();
						$rows = 1;
						if($data->exists()){
							foreach($data as $row){
								
								
								$sempadan = '<select id="sempadan'.$rows.'" name="sempadan[]" class="input-select-wrc required" onchange="harga('.$i.','.$rows.',this.value)" required>';
								$x = new tmharsat_retribusi_imb();
								$x->where('c_type !=','1');
								$x->get();
								foreach($x as $x){
									if($x->id==$row->tmharsat_retribusi_imb_id){
										$sempadan  .= "<option value='".$x->id."' selected>".$x->jenis."</option>";
									}else{
										$sempadan  .= "<option value='".$x->id."' >".$x->jenis."</option>";
									}
								}
								$sempadan  .= "</select>";
								
								$index_kegiatan = array(1.00,0.30,0.45,0.65);
								$i_k = '<select id="index_kegiatan'.$rows.'" class="input-select-wrc required" name="index_kegiatan[]" style="width:70%;" onchange="set_jumlah('.$i.','.$rows.')" required>';
								for($a=0;$a<count($index_kegiatan);$a++){
									if($index_kegiatan[$a]==$row->index_kegiatan){
										$i_k  .= "<option value='".$index_kegiatan[$a]."' selected>".$index_kegiatan[$a]."</option>";
									}else{
										$i_k  .= "<option value='".$index_kegiatan[$a]."' >".$index_kegiatan[$a]."</option>";
									}
								}
								$i_k .= '</select>';

								//$index_kegiatan1 = array('','Perusahaan','Rumah Tinggal','Sosial/Umum');
								
								$index_kegiatan1 = array('',0.028,0.018,0.013);

								$view_index = array('','Perusahaan','Rumah Tinggal','Sosial/Umum');
								$i_k1 = '<select id="val_jns_bangunan'.$rows.'" class="input-select-wrc required" name="val_jns_bangunan[]" style="width:90%;" onchange="hitung_retribusi('.$i.','.$rows.')" required>';
								for($a=0;$a<count($index_kegiatan1);$a++){
									if($index_kegiatan1[$a]==$row->jenis_bangunan){
										$i_k1  .= "<option value='".$index_kegiatan1[$a]."' selected>".$view_index[$a]."</option>";
									}else{
										$i_k1  .= "<option value='".$index_kegiatan1[$a]."' >".$view_index[$a]."</option>";
									}
								}
								$i_k1 .= '</select>';
								
								echo "<tr class='row-grid".$i."' style='border: 1px solid #000;'>";
								// echo "<td align='center'>".$sempadan."</td>";
								// echo "<td align='center'><input type='text' name='nama_sempadan[]' value='".$row->n_simpadan."' class='input-wrc required' required/></td>";
								// echo "<td align='center'><input value='".$row->luas_bangunan."' onchange='set_jumlah(".$i.",".$rows.")' style='width:55%;' min='0' type='number'  id='luas".$rows."' name='luas[]' class='input-wrc required' required/></td>";
								// echo "<td align='center'>".$i_k."</td>";
								// echo "<td align='center'><input id='harga_satuan".$rows."' value='".$row->harga_satuan."' style='width:55%;' readonly='true' type='text' name='harga_satuan[]' class='input-wrc required' required/></td>";
								// echo "<td align='center'><input value=".$row->jumlah_bangunan." onchange='set_jumlah(".$i.",".$rows.")' style='width:55%;' min='0' type='number' id='jumlah_bangunan".$rows."' name='jumlah_bangunan[]' class='input-wrc required' required/></td>";
								
								echo "<td align='center'><input type='text' name='lantai[]' class='input-wrc required' required readonly/></td>";
								echo "<td align='center'><input type='text' name='val_luas[]' onchange='hitung_retribusi(".$i.",".$rows.")' class='input-wrc required' required /></td>";
								echo "<td align='center'><input type='text' name='val_hrg_satuan[]' onchange='hitung_retribusi(".$i.",".$rows.")' class='input-wrc required' required /></td>";
								//echo "<td align='center'><input type='text' name='val_jns_bangunan[]' onchange='hitung_retribusi(".$i.",".$rows.")' class='input-wrc required' required /></td>";
								echo "<td align='center'>".$i_k1."</td>";
								echo "<td align='center'><input type='text' name='val_tggi_bangunan[]' onchange='hitung_retribusi(".$i.",".$rows.")' class='input-wrc required' required /></td>";
								echo "<td align='center'><input type='hidden' name='jumlah_ret[]' onchange='hitung_retribusi(".$i.",".$rows.")' class='input-wrc required' required /></td>";

								echo "
									<td align='center' style='border-right: 1px solid #000; '>
										<a onClick='javascript:deleteRow(this,".$i.",".$rows."); return false;' href='javascript:void(0)'>
											<img src='".base_url()."assets/images/icon/cross.png'/>
										</a>
										<input type='hidden' name='a[]' value='".$row->type_bangunan."'/>
										<input type='hidden' class='b' value='".$ik."' name='b[]'/>
										<input type='hidden' class='c' value='".$row->trindex_terintegrasi_imb_id."' name='c[]'/>
									</td>";
								echo "</tr>";
								$rows++;
								
							}	
						}
						
					?>
                </tbody> 
            </table>
			<?php EndFor; ?>
			 <table cellpadding="0" cellspacing="0" border="0" class="display" style="padding-top:10px; margin-bottom:40px;" id="grid<?php echo $i;?>">
				<thead>
					<tr style="border: 1px solid #000; background-color: #CED9FE;">
						<td colspan="5">
							<b># Prasarana Lingkungan</b>
						</td>
						<td colspan="4" align="right">
							<a href="javascript:void(0)" title="Tambah Data" alt="Tambah Data" onClick="add(<?php echo $i;?>,true)">
								<img src="<?php echo base_url() . 'assets/images/icon/plus.png'; ?>"/>
							</a>
							<input type="hidden" id="t_bangunan" readonly="true" name="type[]" class="type input-wrc required" required/>
						</td>
					</tr>
					<tr style="border: 1px solid #000; background-color: #eee">
						<th>Lantai</th>
                        <th>Luas</th>
						<th>Harga Satuan</th>
						<th>Jenis Bangunan</th>
						<th>Tinggi Bangunan</th>
						<th>Jumlah</th>
                        <th style='border-right: 1px solid #000;' colspan="2">Aksi</th>
                    </tr>
				</thead>
				<tbody>
					<?php
						
						//UPDATE JIKA SUDAH DI ENTRY

						//$z = new trretribusi_imb();
						$z = new trretribusi_imb_ciamis();
						$z->where('tmpermohonan_id',$id_permohonan);
						//$z->where('type_bangunan','');
						$z->get();

						$tmretribusi = new tmretribusi();
						$tmretribusi->where('tmpermohonan_id',$id_permohonan);
						$tmretribusi->get();


						$rows = 1;

					
						if($z->exists()){
							$cacing_flag = 0;
							$rows_cacing = 0;
							foreach($z as $row){
								$index_kegiatan1 = array('',0.028,0.018,0.013);
								$view_index = array('','Perusahaan','Rumah Tinggal','Sosial/Umum');
								$i_k1 = '<select id="val_jns_bangunan'.$rows.'" class="input-select-wrc required" name="val_jns_bangunan[]" style="width:90%;" onchange="hitung_retribusi('.$i.','.$rows.')" required>';
								for($a=0;$a<count($index_kegiatan1);$a++){
									if($index_kegiatan1[$a]==$row->jenis_bangunan){
										$i_k1  .= "<option value='".$index_kegiatan1[$a]."' selected>".$view_index[$a]."</option>";
									}else{
										$i_k1  .= "<option value='".$index_kegiatan1[$a]."' >".$view_index[$a]."</option>";
									}
								}
								$i_k1 .= '</select>';

								$jum = $row->luas * $row->harga_standar * $row->jenis_bangunan * $row->tinggi_bangunan;

								echo "<tr class='row-grid".$i."' style='border: 1px solid #000;'>";
								echo "<td align='center'><input type='text' name='lantai[]' id='lant' value='". $row->bangunan ."' style='width:95%;' class='input-wrc required' required readonly/></td>";
								echo "<td align='center'><input type='text' name='val_luas[]' value='".$row->luas."' class='input-wrc required' required /></td>";
								echo "<td align='center'><input type='text' name='val_hrg_satuan[]' value='".$row->harga_standar."' class='input-wrc required' required /></td>";
								echo "<td align='center'>".$i_k1."</td>";
								echo "<td align='center'><input type='text' name='val_tggi_bangunan[]' value='".$row->tinggi_bangunan."' class='input-wrc required' required /></td>";
								echo "<td align='center'><input type='text' id='jumlah".$cacing_flag++."' name='jumlah_ret[]' value='".$jum."' class='input-wrc required' required /></td>";

								echo "
									<td align='center' style='border-right: 1px solid #000; '>
										<a onClick='javascript:deleteRow(this,".$i.",".($rows_cacing++)."); return false;' href='javascript:void(0)'>
											<img src='".base_url()."assets/images/icon/cross.png'/>
										</a>
										<input type='hidden' name='a[]'/>
										<input type='hidden' name='b[]'/>
									</td>";
								echo "</tr>";
							}
							
						}
					
					?>
				</tbody>
				<tfoot>
                    <tr style="border: 1px solid #000; background-color: #eee">
                    	<td colspan='4' align='center'><b>Total Retribusi</b></td>
                    	<td colspan='2' align='center'><input type='text' value="<?php echo $tmretribusi->nominal; ?>" onkeyup="hitung_retribusi('+i+','+row+')" name="total[]" id="total" class="input-wrc required" readonly/></td>
                    	<!--td colspan='2' align='center'><input type='text' onkeyup="total_retribusi('+i+','+row+')" name="tot[]" id="tot" class="input-wrc required" readonly/></td-->
                    	<!--td colspan='2' align='center'><input type='text' onkeyup="total_retribusi()" name="total[]" id="total" class="input-wrc required" readonly/></td-->
                    </tr>
				</tfoot>
			 </table>
        </div>
        <?php } ?>

