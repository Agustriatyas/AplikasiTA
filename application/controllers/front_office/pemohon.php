<?php 
	class Pemohon extends CI_Controller{
		/**
		 * Fungsi yang akan dijalankan paling awal.
		 */
		function __construct(){
        	parent::__construct();
			$this->load->database();
			$this->load->helper('captcha');
			$this->load->model('m_fo');			
    	}

		/**
		 * Fungsi ini yang digunakan untuk pertama kali mengeksekusi controllers front_office/pemohon
		 */    	
		function index(){
			$jns_permohonan = $this->m_fo->get_jenis_permohonan();
			$propinsi = $this->m_fo->get_propinsi();
			
			$this->load->view('front_office/v_pemohon',array('jns_permohonan'=>$jns_permohonan,'propinsi'=>$propinsi));
		}

		/**
		 * Fungsi ini digunakan untuk mengambil data dari table wilayah kabupaten berdasarkan
		 * provinsi (ID) yang diberikan.
		 */
		function kabupaten(){
			/*begin jj*/
			$id_propinsi 	= $this->input->post('id');
			$aId_kab 		= $this->input->post('aId_kab');
			/*end jj*/
			$this->db->where('wilayah_kabupaten.id_prop', $id_propinsi);
			$data = $this->db->get('wilayah_kabupaten')->result();
			
			$html = null;
			$html .= "<option></option>";
			foreach($data as $d){
				/*begin jj*/
				if($aId_kab == $d->id_kab){
					$selected = "selected";
				}else{
					$selected = "";
				}
				/*end jj*/
				$html .= "<option value='".$d->id_kab."' ".$selected.">".$d->nama_kab."</option>";
			}
			// var_dump($html);
			echo $html;
		}

		/**
		 * Fungsi ini digunakan untuk mengambil data dari table wilayah kecamatan berdasarkan
		 * kabupaten (ID) yang diberikan.
		 */
		function kecamatan(){
			/*begin jj*/
			$id_kabupaten 	= $this->input->post('id');
			$aId_kec 		= $this->input->post('aId_kec');
			/*end jj*/

			$this->db->where('wilayah_kecamatan.id_kab',$id_kabupaten);
			// echo $this->db->last_query($cek);
			$data = $this->db->get('wilayah_kecamatan')->result();

			$html = null;
			$html .= "<option></option>";
			foreach($data as $d){
				/*begin jj*/
				if($d->id_kec == $aId_kec){
					$selected = "selected";
				}else{
					$selected = "";
				}
				/*end jj*/
				$html .= "<option value='".$d->id_kec."' ".$selected.">".$d->nama_kec."</option>";
			}
			echo $html;
		}

		/**
		 * Fungsi ini digunakan untuk mengambil data dari table wilayah kelurahan berdasarkan
		 * kecamatan (ID) yang diberikan.
		 */
		function kelurahan(){
			/*begin jj*/
			$id_kecamatan 	= $this->input->post('id');
			$aId_kel 		= $this->input->post('aId_kel');
			/*end jj*/

			$this->db->where('wilayah_desa.id_kec',$id_kecamatan);
			$data = $this->db->get('wilayah_desa')->result();
			$html = null;
			$html .= "<option></option>";
			foreach($data as $d){
				/*begin jj*/
				if($d->id_kel == $aId_kel){
					$selected = "selected";
				}else{
					$selected = "";
				}
				/*end jj*/
				$html .= "<option value='".$d->id_kel."' ".$selected.">".$d->nama_kel."</option>";
			}
			echo $html;
		}

		/**
		 * Fungsi ini digunakan untuk mengambil data dari table tb_syarat untuk menampilkan syarat berdasarkan
		 * jenis permohonan (ID) yang diberikan.
		 */
		function send($id){
        	$daftar_user = $this->m_fo->get_syarat($id);
        	$i=1;
        	foreach ($daftar_user as $row) {
        		$data[$i]['id_syarat'] = $row->id_syarat;
        		$data[$i]['syarat'] = $row->syarat;
				$data[$i]['stat'] = $row->stat;
        		$i++;
        	}
        	echo json_encode($data);
		}

		/**
		 * Fungsi ini digunakan untuk menyimpan/insert data ke tabel tb_pemohon, tb_perusahaan, tb_lokasi, 
		 * tb_syarat, tb_permohonan
		 */
		function insert(){
			$idperm = $this->input->post('id_perm');
			$id_pemohon = $this->input->post('id_pemohon');
			$id_perusahaan = $this->input->post('id_perusahaan');
			$id_lokasi = $this->input->post('id_lokasi');
			
			// $kel_izin=$this->input->post('kelurahan_izin');
			// die($kel_izin);
			// $pemohon = $this->input->post('no_telp_pemohon');
			// $perusahaan = $this->input->post('no_telp_perusahaan');
			// die($perusahaan);
			
			if($_POST){
				/**
				 * Data pemohon
				 */
				$pemohon = array(
					'jenis_identitas'=>$this->input->post('source'),
					'no_identitas'=>$this->input->post('no_referensi'),
					'npwp_pemohon'=>$this->input->post('npwp_pemohon'),
					'nama_lengkap'=>$this->input->post('nama_lengkap'),
					'jk'=>$this->input->post('jenis_kelamin'),
					'posisi_pemohon'=>$this->input->post('posisi'),
					'telp_pemohon'=>$this->input->post('no_telp_pemohon'),
					'email'=>$this->input->post('email_pemohon'),
					'alamat'=>$this->input->post('alamat_pemohon'),
					'id_prop'=>$this->input->post('provinsi_pemohon'),
					'id_kab'=>$this->input->post('kabupaten_pemohon'),
					'id_kec'=>$this->input->post('kecamatan_pemohon'),
					'id_kel'=>$this->input->post('kelurahan_pemohon')
				);
				
				/**
				 * Data perusahaan
				 */
				$perusahaan = array(
					'npwp_perusahaan'=>$this->input->post('npwp_perusahaan'),
					'nama_perusahaan'=>$this->input->post('n_perusahaan'),
					'bid_usaha'=>$this->input->post('bidang_usaha'),
					'status_investasi'=>$this->input->post('status_modal'),
					'badan_hukum'=>$this->input->post('badan_hukum'),
					'nilai_investasi'=>$this->input->post('investasi'),
					'jumlah_tk'=>$this->input->post('jumlah_tk'),
					'telp_perusahaan'=>$this->input->post('no_telp_perusahaan'),
					'email'=>$this->input->post('email_perusahaan'),
					'website'=>$this->input->post('website'),
					'alamat'=>$this->input->post('alamat_perusahaan'),
					'id_prop'=>$this->input->post('provinsi_perusahaan'),
					'id_kab'=>$this->input->post('kabupaten_perusahaan'),
					'id_kec'=>$this->input->post('kecamatan_perusahaan'),
					'id_kel'=>$this->input->post('kelurahan_perusahaan')
				);

				/**
				 * Data lokasi
				 */
				$lokasi = array(
					'id_prop'=>$this->input->post('provinsi_izin'),
					'id_kab'=>$this->input->post('kabupaten_izin'),
					'id_kec'=>$this->input->post('kecamatan_izin'),
					'id_kel'=>$this->input->post('kelurahan_izin'),
					'alamat_lengkap'=>$this->input->post('alamat_izin')
				);
				
				/**
				 * Simpan Data pemohon, perusahaan, lokasi
				 */
				// begin jj
				//var_dump($pemohon);
				if($id_pemohon == ''){
					$this->m_fo->save($pemohon,$perusahaan,$lokasi);
				}else{
					$this->m_fo->update($pemohon,$perusahaan,$lokasi,$id_pemohon,$id_perusahaan,$id_lokasi);
				}
				// end jj

				/**
				 * Data permohonan
				 */
				//no_pendaftaran
				$id_izin = $this->input->post('jenis_izin');
				$query = $this->db->query("SELECT * from tb_permohonan order by id_perm DESC limit 1");
				foreach ($query->result() as $row){
		   			$row->no_pendaftaran;
		   			$row->tgl_permohonan;
				}
		        $now = date('Y-m-d');
		        $last = $row->tgl_permohonan;

				$a = $row->no_pendaftaran;
		        $a = explode('.', $a);
		        $last_index = $a[2];

		        $data_bulan = date("n");
		        $i_bulan = strlen($data_bulan);
		        for ($i = 2; $i > $i_bulan; $i--) {
		            $data_bulan = "0" . $data_bulan;
		        }

		        $data_date = date("d");
		        $i_date = strlen($data_date);
		        for ($i = 2; $i > $i_date; $i--) {
		            $data_date = "0" . $data_date;
		        }

				$kode_izin = "IMB";
				$data_izin = 1;

				$i_izin = strlen($data_izin);
				for ($i = 3; $i > $i_izin; $i--) {
		            $data_izin = "0" . $data_izin;
		        }

		        $zero = 0;
		        $count_index = strlen($last_index);
		        for ($i = 0; $i < $count_index; $i++) {
		            if (substr($last_index, $i, 1) == "0") {
		                $zero++;
		            }
		        }

		        $get_index = substr($last_index, $zero);

		        if ($get_index) {
		            $data_urut = $get_index;
		        } else {
		            $data_urut = 0;
		        }

		        if ($now == $last) {
		            $data_urut+=1;
		        } else {
		           $data_urut = 1;
		        }

		        $i_urut = strlen($data_urut);
		        $data_tahun = date('Y');

		        $y = $data_tahun . $data_bulan . $data_date . '.' . $kode_izin . '.';
		        $xy = 19 - strlen($y);

		        for ($i = $xy; $i > $i_urut; $i--) {
		            $data_urut = "0" . $data_urut;
		        }

		        $nomor_pendaftaran = $data_tahun . $data_bulan . $data_date . '.' . $kode_izin . '.' . $data_urut . '';
				
				//jenis_permohonan
		        $jenis = $this->input->post('jenis_izin');
		        $query = $this->db->query("SELECT * from tb_jenis_permohonan WHERE id = '$jenis'");
				foreach ($query->result() as $row){
		   			$row->jenis_permohonan;
				}
				$jenis_permohonan = $row->jenis_permohonan;

				//id_pemohon
				$query = $this->db->query("SELECT * from tb_pemohon ORDER BY id_pemohon DESC LIMIT 1");
				foreach ($query->result() as $row){
		   			$row->id_pemohon;
				}
				$id_pemohon = $row->id_pemohon;

				//id_perusahaan
				$query = $this->db->query("SELECT * from tb_perusahaan ORDER BY id_perusahaan DESC LIMIT 1");
				foreach ($query->result() as $row){
		   			$row->id_perusahaan;
				}
				$id_perusahaan = $row->id_perusahaan;

				//id_lokasi
				$query = $this->db->query("SELECT * from tb_lokasi ORDER BY id_lokasi DESC LIMIT 1");
				foreach ($query->result() as $row){
		   			$row->id_lokasi;
				}
				$id_lokasi = $row->id_lokasi;

			  	$permohonan = array(
					'no_pendaftaran' => $nomor_pendaftaran,
					'tgl_permohonan' => date('Y-m-d'),
					'jenis_permohonan' => $jenis_permohonan,
					'peruntukan' => $this->input->post('jns_peruntukan'),
					'c_kasubid' => 0,
					'c_kabid' => 0,
					'id_pemohon' => $id_pemohon,
					'id_perusahaan' => $id_perusahaan,
					'id_lokasi' => $id_lokasi,
					'id_dataizin' => 0,
					'id_tinjauan' => 0,
					'id_retribusi' => 0,
					//'id_bap' => 0
				);
				
				// begin jj
				if($idperm == ''){
					$this->m_fo->save_permohonan($permohonan);
				}else{
					$this->m_fo->update_permohonan($permohonan,$idperm);
				}
				// end jj

				/**
				 * Data syarat
				 */
				//  begin jj
				if($idperm == ''){
					$query = $this->db->query("SELECT * from tb_permohonan order by id_perm DESC limit 1");
					foreach ($query->result() as $row){
						$row->id_perm;
					}
					$id_perm = $row->id_perm;
					$check = $this->input->post('checkbox');
					$jum = count($check);
					for($i=0; $i<$jum; $i++){  
						$syarat = array(
							'syarat' => $check[$i],
							'stat' => $this->input->post('jenis_izin'),
							'id_perm' => $id_perm
						);
						$this->db->insert('tb_syarat',$syarat);
					}
				}else{
					$query = $this->db->query("SELECT * from tb_permohonan WHERE id_perm = $idperm");
					foreach ($query->result() as $row){
						$row->id_perm;
					}
					$id_perm = $row->id_perm;
					$check = $this->input->post('checkbox');
					$jum = count($check);
					for($i=0; $i<$jum; $i++){  
						$syarat = array(
							'syarat' => $check[$i],
							'stat' => $this->input->post('jenis_izin'),
							'id_perm' => $id_perm
						);
						$this->db->where('id_perm', $idperm);
						$this->db->update('tb_syarat',$syarat);
					}
				}
				// end jj

				/**
				 * Data tracking
				 */
				//id_permohonan
				if($idperm == ''){
				$query = $this->db->query("SELECT * from tb_permohonan ORDER BY id_perm DESC LIMIT 1");
				foreach ($query->result() as $row){
		   			$row->id_perm;
				}
				$id_perm = $row->id_perm;

				$tracking = array(
					'id_perm' => $id_perm,
					'open_file' => 'Pendaftaran di Front Office'
				);
				
				$this->m_fo->save_tracking($tracking);
				}
				
				
				redirect(base_url().'index.php/front_office/pemohon/permohonan');
			}else{
				redirect('front_office/pemohon/permohonan');
			}
		}

		//DATA PERMOHONAN

		/**
		 * Fungsi untuk menampilkan data permohonan
		 */
		function permohonan(){
			$data_perm = $this->m_fo->get_data_permohonan();
			$this->load->view('front_office/v_permohonan',array('data_perm'=>$data_perm));
		}

		/**
		 * Fungsi untuk menghapus data permohonan
		 */
		function delete($id){
			$del = $this->m_fo->del($id);
			redirect('front_office/pemohon/permohonan');
		}

		/**
		 * Fungsi untuk update data permohonan
		 */
		function edit($id){
			// var_dump($_POST);
			if($_POST){
				$data_edit = array("jenis_izin" => $this->input->post('jenis_izin'),
									"jns_peruntukan" => $this->input->post('jns_peruntukan'),
									"source" => $this->input->post('source'),
									"no_referensi" => $this->input->post('no_referensi'),
									"npwp_pemohon" => $this->input->post('npwp_pemohon'),
									"nama_lengkap" => $this->input->post('nama_lengkap'),
									"jenis_kelamin" => $this->input->post('jenis_kelamin'),
									"posisi" => $this->input->post('posisi'),
									"no_telp_pemohon" => $this->input->post('no_telp_pemohon'),
									"email_pemohon" => $this->input->post('email_pemohon'),
									"alamat_pemohon" => $this->input->post('alamat_pemohon'),
									"provinsi_pemohon" => $this->input->post('provinsi_pemohon'),
									"kabupaten_pemohon" => $this->input->post('kabupaten_pemohon'),
									"kecamatan_pemohon" => $this->input->post('kecamatan_pemohon'),
									"kelurahan_pemohon" => $this->input->post('kelurahan_pemohon'),

									"npwp_perusahaan" => $this->input->post('npwp_perusahaan'),
									"n_perusahaan" => $this->input->post('n_perusahaan'),
									"bidang_usaha" => $this->input->post('bidang_usaha'),
									"status_modal" => $this->input->post('status_modal'),
									"badan_hukum" => $this->input->post('badan_hukum'),
									"investasi" => $this->input->post('investasi'),
									"jumlah_tk" => $this->input->post('jumlah_tk'),
									"no_telp_perusahaan" => $this->input->post('no_telp_perusahaan'),
									"email_perusahaan" => $this->input->post('email_perusahaan'),
									"website" => $this->input->post('website'),
									"alamat_perusahaan" => $this->input->post('alamat_perusahaan'),
									"provinsi_perusahaan" => $this->input->post('provinsi_perusahaan'),
									"kabupaten_perusahaan" => $this->input->post('kabupaten_perusahaan'),
									"kecamatan_perusahaan" => $this->input->post('kecamatan_perusahaan'),
									"kelurahan_perusahaan" => $this->input->post('kelurahan_perusahaan'),
					);
				die("KE MODEL");
				$this->m_fo->edit_user($id, $data_edit);
				// redirect(base_url().'admin/user_admin');
			}else{
				/*begin jj*/
				$data['propinsi'] = $this->m_fo->get_propinsi();
				/*end jj*/
				// $data['action'] = base_url().'admin/user_admin/edituser/'.$id;
				// $data['title'] = 'Edit User';
				$data['data_edit'] = $this->m_fo->get_perid($id);
				// CEK QUERY
				// $aaa =$this->m_fo->get_perid($id);
				// echo $this->db->last_query($aaa);
				$data['combo'] = $this->m_fo->get_jenis_permohonan();
				$data['jenis_izin'] = $this->m_fo->get_jenis_izin($id);

				// $cek = $this->m_fo->get_jenis_izin($id);
				//echo $this->db->last_query($cek);
				$cek = $this->m_fo->get_perid($id);
				// echo $this->db->last_query($cek);
				$this->load->view('front_office/v_pemohon_edit',$data);		
			}

		}

		public function resi($id_perm = NULL){
			$this->load->library('PHPWord');
  			$document = $this->phpword->loadTemplate('application/docs/temp/Resi.docx');

			$query = $this->db->query("SELECT A.id_perm, A.jenis_permohonan, A.tgl_permohonan, 
				A.peruntukan, A.no_pendaftaran, B.nama_lengkap, B.jenis_identitas, B.no_identitas, C.nama_perusahaan, 
				D.id_lokasi, E.nama_prop AS prop_izin, F.nama_kab AS kab_izin, G.nama_kec AS kec_izin, 
				H.nama_kel AS kel_izin, D.alamat_lengkap AS alamat_izin, B.alamat AS alamat_pem, 
				I.nama_prop AS prop_pem, J.nama_kab AS kab_pem, K.nama_kec AS kec_pem, L.nama_kel AS kel_pem
					
					FROM tb_permohonan AS A 
					LEFT JOIN tb_pemohon AS B ON B.id_pemohon = A.id_pemohon
					LEFT JOIN tb_perusahaan AS C ON C.id_perusahaan = A.id_perusahaan
					LEFT JOIN tb_lokasi AS D ON D.id_lokasi = A.id_lokasi
					LEFT JOIN wilayah_provinsi AS E ON E.id_prop = D.id_prop
					LEFT JOIN wilayah_kabupaten AS F ON F.id_kab = D.id_kab
					LEFT JOIN wilayah_kecamatan AS G ON G.id_kec = D.id_kec
					LEFT JOIN wilayah_desa AS H ON H.id_kel = D.id_kel

					LEFT JOIN wilayah_provinsi AS I ON I.id_prop = B.id_prop
					LEFT JOIN wilayah_kabupaten AS J ON J.id_kab = B.id_kab
					LEFT JOIN wilayah_kecamatan AS K ON K.id_kec = B.id_kec
					LEFT JOIN wilayah_desa AS L ON L.id_kel = B.id_kel

					WHERE A.id_perm = '$id_perm' ");

				foreach ($query->result() as $row){
		   			$tipe_izin = $row->jenis_permohonan;
		   			$tgl_daftar = $row->tgl_permohonan;
		   			$peruntukan = $row->peruntukan;
		   			$nama_pemohon = $row->nama_lengkap;
		   			$jenis_identitas = $row->jenis_identitas;
		   			$no_identitas = $row->no_identitas;
		   			$nama_perusahaan = $row->nama_perusahaan;
		   			$prop_i = $row->prop_izin;
		   			$kab_i = $row->kab_izin;
		   			$kec_i = $row->kec_izin;
		   			$kel_i = $row->kel_izin;
		   			$almt_i = $row->alamat_izin;
		   			$almt_p = $row->alamat_pem;
		   			$prop_p = $row->prop_pem;
		   			$kab_p = $row->kab_pem;
		   			$kec_p = $row->kec_pem;
		   			$kel_p = $row->kel_pem;
		   			$no_pendaftaran = $row->no_pendaftaran;
				}
				
				$lokasi_izin = $almt_i." Kel. ".$kel_i." Kec.".$kec_i." ".$kab_i." Prop. ".$prop_i;
				$alamat_pemohon = $almt_p." Kel. ".$kel_p." Kec.".$kec_p." ".$kab_p." Prop. ".$prop_p;
				//format tgl daftar
				$bulanIndo = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
				$tahun = substr($tgl_daftar, 0, 4);
				$bulan = substr($tgl_daftar, 5, 2);
				$tgl = substr($tgl_daftar, 8, 2);
				$tgl_daftar_format = $tgl . " " . $bulanIndo[$bulan-1]. " " . $tahun;
				//format tgl sekarang
				$tgl_sekarang = date('Y-m-d');
				$bulanIndo1 = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember" );
				$tahun = substr($tgl_sekarang, 0, 4);
				$bulan = substr($tgl_sekarang, 5, 2);
				$tgl = substr($tgl_sekarang, 8, 2);
				$tgl_sekarang_format = $tgl . " " . $bulanIndo1[$bulan-1]. " " . $tahun;
			  	
			  $document->setValue('nomor_izin','Tamvan');
			  $document->setValue('tgl_daftar',$tgl_daftar_format);
			  $document->setValue('tipe_izin',$tipe_izin);
			  $document->setValue('nama_perusahaan',$nama_perusahaan);
			  $document->setValue('nama_pemohon',$nama_pemohon);
			  $document->setValue('alamat_pemohon',$alamat_pemohon);
			  $document->setValue('jenis_identitas',$jenis_identitas);
			  $document->setValue('no_identitas',$no_identitas);
			  $document->setValue('lokasi_izin',$lokasi_izin);
			  $document->setValue('peruntukan',$peruntukan);
			  $document->setValue('tanggal',$tgl_sekarang_format);
			  $document->setValue('kode_registrasi',$no_pendaftaran);

				$filename = 'Resi.docx';
				$document->save($filename);
				header('Content-Description: File Transfer');
				header('Content-type: application/force-download');
				header('Content-Disposition: attachment; filename='.basename($filename));
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: '.filesize($filename));
				readfile($filename);
		}

		public function cetak_berkas($id_daftar = NULL, $idIzin = NuLl){
        
        // $permohonan = new tmpermohonan();
        // $permohonan->get_by_id($id_daftar);
        // $izin = $permohonan->trperizinan;
        
        $nama_file = 'Resi.docx';
        $lokasi_file = 'assets/template/'.$nama_file;

        if(file_exists($lokasi_file)){
             $file = $lokasi_file;
             require_once __DIR__ . '../../../assets/word/PHPWord.php';
             die('yes');
            $PHPWord = new PHPWord();
            $document = $PHPWord->loadTemplate($file);

            //RESI
                $u_daftar = $this->pendaftaran->get_by_id($id_daftar);

        $pro = new trpropinsi();
        $kab = new trkabupaten();
        $kec = new trkecamatan();
        $kel = new trkelurahan();

        $p_pemohon = $u_daftar->tmpemohon->get();
        $p_kelurahan = $p_pemohon->trkelurahan->get();
        $p_kecamatan = $p_pemohon->trkelurahan->trkecamatan->get();
        $p_kabupaten = $p_pemohon->trkelurahan->trkecamatan->trkabupaten->get();
        $p_propinsi = $p_pemohon->trkelurahan->trkecamatan->trkabupaten->trpropinsi->get();

        $u_perusahaan = $u_daftar->tmperusahaan->get();

        $d_izin = $u_daftar->trperizinan->get();
        $d_kelompok = $d_izin->trkelompok_perizinan->get();
        $d_jenis = $u_daftar->trjenis_permohonan->get();

        $i_kelurahan = $kel->get_by_id($u_daftar->kelurahan_izin);
        $i_kecamatan = $i_kelurahan->trkecamatan->get();
        $i_kabupaten = $kab->get_by_id('124');
        $i_propinsi = $pro->get_by_id('10');

        $alamat_pemohon = $p_pemohon->a_pemohon;
        if ($p_pemohon->rt != '' && $p_pemohon->rw != '') {
            $alamat_pemohon .= ' ' . $p_pemohon->rt . '/' . $p_pemohon->rw;
        }
	 $apa = explode(" ",$p_kabupaten->n_kabupaten);
        $alamat_pemohon .= '  Kel.' . ucfirst($p_kelurahan->n_kelurahan);
        $alamat_pemohon .= '  Kec.' . ucfirst($p_kecamatan->n_kecamatan);
	 $alamat_pemohon .= ' ' . ucfirst(strtolower($apa[0]))." ".ucfirst(strtolower($apa[1])); //($p_kabupaten->n_kabupaten);
	
	 $prop = explode(" ",$p_propinsi->n_propinsi);
	 $alamat_pemohon .= ' ' . ucfirst(strtolower($prop[0]))." ".ucfirst(strtolower($prop[1]))." ".ucfirst(strtolower($prop[2]));
     $alamat_pemohon = $alamat_pemohon;

        $alamat_izin = $u_daftar->a_izin;
        $alamat_izin .= '  Kel.' . ucfirst($i_kelurahan->n_kelurahan);
        $alamat_izin .= '  Kec.' . ucfirst($i_kecamatan->n_kecamatan);
        
	 $kab_izin = explode(" ",$i_kabupaten->n_kabupaten);
	 $alamat_izin .= ' ' . ucfirst(strtolower($kab_izin[0]))." ".ucfirst(strtolower($kab_izin[1]));

	 $prop_izin = explode(" ",$i_propinsi->n_propinsi);
	 $alamat_izin .= ' ' . ucfirst(strtolower($prop_izin[0]))." ".ucfirst(strtolower($prop_izin[1]))." ".ucfirst(strtolower($prop_izin[2]));
	 $alamat_izin = $alamat_izin;

        $nomor_bpm = $this->lib_penomoran->GenerateBPM($id_daftar, $idIzin);
	   $trperuntukan = new tmpermohonan();
        $jenis_peruntukan = $trperuntukan->where('id', $id_daftar)->get()->n_peruntukan;

        if ($jenis_peruntukan == '') {
            $jenis_peruntukan = '-';
        }

// VALUE
        $document->setValue('nomor_izin', $nomor_bpm);
        $document->setValue('tgl_daftar', $this->lib_date->mysql_to_human($u_daftar->d_terima_berkas));
        $document->setValue('kode_registrasi', $u_daftar->pendaftaran_id);
        $document->setValue('nama_izin', $d_izin->n_perizinan);
        $document->setValue('tipe_izin', $d_jenis->n_permohonan);
        $document->setValue('nama_perusahaan', ucfirst($u_perusahaan->n_perusahaan));
        $document->setValue('nama_pemohon', ucfirst($p_pemohon->n_pemohon));
        $document->setValue('alamat_pemohon', ucfirst($alamat_pemohon));
        $document->setValue('jenis_identitas', $p_pemohon->source);
        $document->setValue('no_identitas', $p_pemohon->no_referensi);
        $document->setValue('lokasi_izin', ucfirst($alamat_izin));
        
        if($jenis_peruntukan == 0 ){
            $document->setValue('peruntukan', "-");
        }else{
        	$document->setValue('peruntukan', $jenis_peruntukan);
        }
        
        $document->setValue('tanggal', $this->lib_date->mysql_to_human(date('Y-m-d')));

            //END RESI
    
            $nama_surat = $nama_file;
            $document->save('assets/word/result/'.$nama_surat);
            header('Content-Type: application/vnd.ms-word.document.12');
            header('Content-Disposition: attachment; filename='.$nama_surat);
            header('Pragma: no-cache');
            readfile('assets/word/result/'.$nama_surat);
            unlink('assets/word/result/'.$nama_surat);
             
        }else{
            $this->session->set_flashdata('warning_message', 'File template  <b>assets/word/template/'.$izin->kode.'/'.$nama_file.'</b> belum tersedia.');  
            redirect('pelayanan/pendaftaran');
        }        
    }


	}
 ?>