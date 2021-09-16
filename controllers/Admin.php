<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();		
		$this->load->model('m_list_nama_paket');
		$this->load->model('m_paket');
		$this->load->model('m_belum');
		$this->load->model('m_sudah');
		$this->load->helper('url');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		// curl_init("https://fatkulumar.com");
		$this->output->delete_cache();
		$data['nama_paket'] = $this->m_paket->grafikNamaPaket()->result_array();
		$data['hitungCod'] = $this->m_paket->hitungCod();
		$data['hitungLangsung'] = $this->m_paket->hitungLangsung();
		// $data['penerima'] = $this->m_paket->grafikPenerima()-ray();

		$data['data_asc'] = $this->m_paket->tampil_data_asc();
		$data['data_desc'] = $this->m_paket->tampil_data_desc();
		$data['getWarning'] = $this->m_paket->getWarning();

		$this->load->view('admin/index', $data);
	}

	public function tambah_aksi()
	{
		$id_paket = $this->input->post('id_paket', true);
		$nama_paket = $this->input->post('nama_paket', true);
		$penerima = $this->input->post('penerima',true);
		$jenis_kirim = $this->input->post('jenis_kirim',true);
		$hp = $this->input->post('no_hp',true);
		$tgl_terima = $this->input->post('tgl_terima', true);
		$jml_paket = $this->input->post('jml_paket', true);
		$tahun = intval(date('YYYY'));

		$data = [
			'hp' => $hp,
			'nama_paket' => $nama_paket,
			'penerima' => $penerima,
			'jenis_kirim' => $jenis_kirim,
			'tgl_terima' => $tgl_terima,
			'creat_at' => $tgl_terima,
			'tahun' => $tahun,
			'jml_paket' => $jml_paket,
		];

		$kirim_telegram = "Nama: " . $nama_paket . " dengan nomor hp " . $hp . " paketan sudah ada di Gasek Multimedia pada " .$tgl_terima. " harap segera di ambil karena gudang mau meledak. Terimakasih . info lain cek di https://www.ponpesgasek.id/ Pesan ini di kirim otomatis oleh sistem karena anda sudah numpang paket di gasek multimedia";

		// $hp_ku = $hp;
		// $n_hp = (int) $hp_ku;
		// $kode = "62";
		// $numb_hp = $kode . $n_hp;
		// echo $numb_hp;

		$this->m_paket->input_paket($data, 'tb_paket');
		$data["id_akhir"] = $this->m_paket->idAkhir()->row_array();
		// redirect('admin/index');
		$this->bot_telegram($kirim_telegram);
		echo json_encode($data);
	}

	public function edit_data($id)
	{
		$data['getWarning'] = $this->m_paket->getWarning();

		$data['hitungCod'] = $this->m_paket->hitungCod();
		$data['hitungLangsung'] = $this->m_paket->hitungLangsung();
		$data['data_asc'] = $this->m_paket->tampil_data_desc();
		$data['data_desc'] = $this->m_paket->tampil_data_desc();
		$data['data'] = $this->m_paket->getOne($id);
		$this->load->view('admin/form_edit', $data);
	}

	public function update_data($id)
	{
		$nama_paket = $this->input->post('nama_paket');
		$penerima = $this->input->post('penerima');
		$jenis_kirim = $this->input->post('jenis_kirim');
		$hp = $this->input->post('no_hp');
		$last_modified = $this->input->post('last_modified');

		$data = [
			'hp' => $hp,
			'nama_paket' => $nama_paket,
			'penerima' => $penerima,
			'jenis_kirim' => $jenis_kirim,
			'modified_at' => $last_modified,
			'tgl_ambil' => $last_modified
		];


		$this->m_paket->update_data($data, 'tb_paket', $id);
		redirect('admin/index', 'refresh');
	}

	public function updateNamaPengambil($id)
	{
		$id_paket = $this->input->post('id_paket');
		$pengambil = $this->input->post('pengambil');
		$tgl_ambil = $this->input->post('tgl_ambil');

		$data = [
			'pengambil' => $pengambil,
			'tgl_ambil' => $tgl_ambil,
			'modified_at' => $tgl_ambil,
			'status_ambil' => $tgl_ambil
		];

		$this->m_paket->update_data($data, 'tb_paket', $id_paket);
		
		echo json_encode($data);
	}

	public function hapus_data($id)
	{	
		if(!isset($id)) show_404(); 

		$this->m_paket->hapus_data($id);
		redirect('admin/index');
	}

	public function updateWarning()
	{
		$warning = $this->input->post('warning', true);

		$data = [
			'warning' => $warning
		];

		// print_r($data); die();

		$this->m_paket->updateWarning($data);

		redirect('admin/index');
	}

	public function updateInfo()
	{
		$warning = $this->input->post('info', true);

		$data = [
			'info' => $warning
		];

		// print_r($data); die();

		$this->m_paket->updateInfo($data);

		redirect('admin/index');
	}

	// public function peringkat()
	// {
	// 	$rangking = array();
	// 	$peringkat = $this->m_paket->peringkat()-ray();
	// 	foreach($peringkat as $rank){
	// 		echo $rangking[] =  $rank["jumlah"];
	// 		echo "<br>";
	// 	}

	// 	//  echo sort($peringkat);

	// 	// echo $angka = implode(",", $rangking);
	// 	echo sort($peringkat);
	// }

	private function bot_telegram($data)
	{
		define('BOT_TOKEN', '1605818633:AAEbvEQB417rgK_gDjlnI9_oORUOEENlh7Y');
		define('CHAT_ID', '-528017095');

		// $pesan = json_encode($data);
		$API = "https://api.telegram.org/bot".BOT_TOKEN."/sendmessage?chat_id=".CHAT_ID."&text=$data";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_URL, $API);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	public function ajax_list() 
    {
        $list = $this->m_paket->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $paket) {
            $no++;
            $row = array();
            // $row[] = $no;
            $row[] = $paket->id_paket;
            $row[] = $paket->tgl_terima;
            $row[] = $paket->nama_paket;
            $row[] = $paket->hp;
            $row[] = $paket->penerima;
            $row[] = $paket->jenis_kirim;
			$row[] = $paket->pengambil;
			$row[] = $paket->jml_paket;
			if($paket->status_ambil==''){

				$btn_status="<td><a class='btn btn-danger btn-sm' onclick='modalPengambil($paket->id_paket)' href='void:0'>Belum Diambil</a></td>";
			}else{

				$btn_status="<button class='btn btn-success btn-sm' disabled>Sudah Diambil</button><div><span>$paket->tgl_ambil</span>";
			}
		$row[]=$btn_status;
		$row[]= "<td><a class='btn btn-sm btn-danger' onclick='modalHapusPaket($paket->id_paket)' href='javascript:void(0)'><i class='fa fa-trash' aria-hidden='true'></i></a></td><td><a class='btn btn-sm btn-success' onclick='return confirm('Yakin Hapus $paket->nama_paket ?')' href='".base_url("admin/edit_data/$paket->id_paket")."'><i class='fa fa-edit' aria-hidden='true'></i></a></td>";


            $data[] = $row;
        }
 
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_paket->count_all(),
			"recordsFiltered" => $this->m_paket->count_filtered(),
			"data" => $data,
		);
        //output to json format
        echo json_encode($output);
	}

	//data table data paket belum di ambil
	public function ajax_list_belum() 
    {
        $list = $this->m_belum->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $paket) {
            $no++;
            $row = array();
            // $row[] = $no;
            $row[] = $paket->id_paket;
            $row[] = $paket->tgl_terima;
            $row[] = $paket->nama_paket;
            $row[] = $paket->hp;
            $row[] = $paket->penerima;
            $row[] = $paket->pengambil;
			$row[] = $paket->jml_paket;
            $row[] = $paket->jenis_kirim;
			if($paket->status_ambil==''){

				$btn_status="<td><a class='btn btn-danger btn-sm' onclick='modalPengambil($paket->id_paket)' href='void:0'>Belum Diambil</a></td>";
			}else{

				$btn_status="<button class='btn btn-success btn-sm' disabled>Sudah Diambil</button><div><span>$paket->tgl_ambil</span>";
			}
		$row[]=$btn_status;
		$row[]= "<td><a class='btn btn-sm btn-danger' onclick='modalHapusPaket($paket->id_paket)' href='javascript:void(0)'><i class='fa fa-trash' aria-hidden='true'></i></a></td><td><a class='btn btn-sm btn-success' onclick='return confirm('Yakin Hapus $paket->nama_paket ?')' href='".base_url("admin/edit_data/$paket->id_paket")."'><i class='fa fa-edit' aria-hidden='true'></i></a></td>";


            $data[] = $row;
        }
 
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_belum->count_all(),
			"recordsFiltered" => $this->m_belum->count_filtered(),
			"data" => $data,
		);
        //output to json format
        echo json_encode($output);
	}

	//datatable data paket sudah di ambil
	public function ajax_list_sudah() 
    {
        $list = $this->m_sudah->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $paket) {
            $no++;
            $row = array();
            // $row[] = $no;
            $row[] = $paket->id_paket;
            $row[] = $paket->tgl_terima;
            $row[] = $paket->nama_paket;
            $row[] = $paket->hp;
            $row[] = $paket->penerima;
            $row[] = $paket->pengambil;
			$row[] = $paket->jml_paket;
            $row[] = $paket->jenis_kirim;
			if($paket->status_ambil==''){

				$btn_status="<td><a class='btn btn-danger btn-sm' onclick='modalPengambil($paket->id_paket)' href='void:0'>Belum Diambil</a></td>";
			}else{

				$btn_status="<button class='btn btn-success btn-sm' disabled>Sudah Diambil</button><div><span>$paket->tgl_ambil</span>";
			}
		$row[]=$btn_status;
		$row[]= "<td><a class='btn btn-sm btn-danger' onclick='modalHapusPaket($paket->id_paket)' href='javascript:void(0)'><i class='fa fa-trash' aria-hidden='true'></i></a></td><td><a class='btn btn-sm btn-success' onclick='return confirm('Yakin Hapus $paket->nama_paket ?')' href='".base_url("admin/edit_data/$paket->id_paket")."'><i class='fa fa-edit' aria-hidden='true'></i></a></td>";


            $data[] = $row;
        }
 
		
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_belum->count_all(),
			"recordsFiltered" => $this->m_belum->count_filtered(),
			"data" => $data,
		);
        //output to json format
        echo json_encode($output);
	}

	public function grafikNamaPaket($tahun = 2021)
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Max-Age: 1000");
		header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
		header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
		header('Content-Type: application/json');
		
		$data['paketan_admin'] = [];
		$data['nama_paket'] = $this->m_paket->grafikPaket($tahun)->result_array();
		foreach($data['nama_paket'] as $row){
			$nama = $row["nama_paket"];
            $jml = intval($row["jumlah"]);
            $data['paketan_admin'][] = [
                'name' => $nama,
                'y' => $jml,
            ];

			$data['cod_counts']=$this->db
			->select('jenis_kirim, count(*) as jumlah_cod_counts')
			->get_where('tb_paket',['jenis_kirim'=> "COD", "tahun" => $tahun])->result_array();

			$data['langsung_counts']=$this->db
			->select('jenis_kirim, count(*) as jumlah_langsung_counts')
			->get_where('tb_paket',['jenis_kirim'=> "langsung", "tahun" => $tahun])->result_array();
			

			$data['cod']=$this->db
			->select('nama_paket,jenis_kirim, count(*) as jumlah_cod')
			->group_by('nama_paket')
			->get_where('tb_paket',['jenis_kirim'=> "COD", "tahun" => $tahun])->result_array();

			$data['langsung']=$this->db
			->select('nama_paket,jenis_kirim, count(*) as jumlah_langsung')
			->group_by('nama_paket')
			->get_where('tb_paket',['jenis_kirim'=> "langsung", "tahun" => $tahun])->result_array();

			$data['total_nama'] = $this->m_list_nama_paket->total_list_nama($tahun);

			// $data['peringkat']=$this->db
			// ->select('nama_paket,jenis_kirim, count(*) as jumlah_langsung')
			// ->group_by('nama_paket')
			// ->get_where('tb_paket',['jenis_kirim'=> "langsung"])->result_array();

			$rangking = array();
			$data['peringkat'] = $this->m_paket->peringkat($tahun)->result_array();
			foreach($data['peringkat'] as $rank => $val){
			$rangking[$val["nama_paket"]] = $val['jumlah'];
		}

			arsort($rangking);
			$data['rangking'] = $rangking;

			$data_rangking = array();
			$no = 0;
			foreach($rangking as $rang => $val){
				$no++;
				if($no == 11){break;	}
				$data_rangking[] = [
					'nama' => $rang,
					'jumlah' => $val
				]; 
				}

				$data["data_rangking"] = $data_rangking;
			
			}
		$data['tahun'] = $tahun;
		$data['jumlah_nama_paket'] = $this->m_paket->grafikNamaPaket()->num_rows();
		$data['data_admin_penerima'] = [];
		$data['data_penerima'] = $this->m_paket->grafikPenerimaJson($tahun)->result_array();
		foreach($data['data_penerima'] as $rows) {
			$nama_penerima = $rows["penerima"];
			$jml_penerima = intval($rows["jumlah"]);
			$data['data_admin_penerima'][] = [
				'name' => $nama_penerima,
				'y' => $jml_penerima
			];
		}

		

		// $rangking = array();
		// $data['peringkat'] = $this->m_paket->peringkat()->result_array();
		// foreach($data['peringkat'] as $rank){
		// 	echo $rangking[] =  $rank["jumlah"];
		// 	echo "<br>";
		// }

		// rsort($rangking);
		// $data['rank'] = $rangking;

		// $data = [];
        // foreach($nama_paket as $pk){
        //     $nama = $pk["nama_paket"];
        //     $jml = intval($pk["jumlah"]);
        //     $data[] = [
        //         'name' => $nama,
        //         'y' => $jml,
        //     ];
        // }

   
		echo json_encode($data);
	}

	// public function auto_nama_paket()
	// {
	// 	$data['nama_paketan'] = [];
	// 	$data['nama_paket'] = $this->m_paket->grafikNamaPaket()->result_array();
	// 	foreach($data['nama_paket'] as $row){
	// 		$nama = $row['nama_paket'];
	// 		$data['nama_paketan'][] = [
	// 			'nama_paket' => $nama
	// 		];
	// 	}
	// 	echo json_encode($data);
	// }

	function filter_hp(){
		$hp = $this->input->post('no_hp');
		$data["nama_hp"] = $this->m_paket->filter_hp($hp)->row(); 
		echo json_encode($data);
	}

	function filter_nama_paket(){
		$nama_paket = $this->input->post('nama_paket');
		$data["nama_paket"] = $this->m_paket->filter_nama_paket($nama_paket)->row(); 
		echo json_encode($data);
	}

	function grafik_pisah()
	{
		$this->output->delete_cache();
		$data['nama_paket'] = $this->m_paket->grafikNamaPaket()->result_array();
		$data['hitungCod'] = $this->m_paket->hitungCod();
		$data['hitungLangsung'] = $this->m_paket->hitungLangsung();
		// $data['penerima'] = $this->m_paket->grafikPenerima()->result_array();
		$data["tahun"] = $this->m_paket->tahun();

		$data['data_asc'] = $this->m_paket->tampil_data_asc();
		$data['data_desc'] = $this->m_paket->tampil_data_desc();
		$data['getWarning'] = $this->m_paket->getWarning();

		$data['list_nama_paket'] = $this->m_paket->list_nama_paket();
		$this->load->view('admin/grafik_pisah_admin', $data);
	}

	function selectPaket()
	{
		$id = $this->input->post("id_paket");
		$data["paket"] = $this->m_paket->getOne($id);
		echo json_encode($data);
	}

	function hapusPaket()
	{
		$id = $this->input->post("id_paket");
		$data["hapusPaket"] = $this->m_paket->hapus_data($id);
		echo json_encode("Terhapus");
	}

	function selecLimitAllAjax()
	{
		$data["selecLimitAllAjax"] = $this->m_paket->tampil_data_desc();
		echo json_encode($data);
	}

	function table_belum_ambil() {
		$data['nama_paket'] = $this->m_paket->grafikNamaPaket()->result_array();
		$data['hitungCod'] = $this->m_paket->hitungCod();
		$data['hitungLangsung'] = $this->m_paket->hitungLangsung();
		// $data['penerima'] = $this->m_paket->grafikPenerima()-ray();

		$data['data_asc'] = $this->m_paket->tampil_data_asc();
		// $data['data_desc'] = $this->m_paket->tampil_data_desc();
		$data['getWarning'] = $this->m_paket->getWarning();

		$data['data_asc'] = $this->m_belum->tampil_data_asc();

		

		$this->load->view('admin/table_belum_ambil', $data);
	}

	function table_sudah_ambil() {
		$data['nama_paket'] = $this->m_paket->grafikNamaPaket()->result_array();
		$data['hitungCod'] = $this->m_paket->hitungCod();
		$data['hitungLangsung'] = $this->m_paket->hitungLangsung();
		// $data['penerima'] = $this->m_paket->grafikPenerima()-ray();

		$data['data_asc'] = $this->m_paket->tampil_data_asc();
		// $data['data_desc'] = $this->m_paket->tampil_data_desc();
		$data['getWarning'] = $this->m_paket->getWarning();

		$data['data_asc'] = $this->m_belum->tampil_data_asc();

		$this->load->view('admin/table_sudah_ambil', $data);
	}

	function list_nama_paket() {

		$data['nama_paket'] = $this->m_paket->grafikNamaPaket()->result_array();
		$data['hitungCod'] = $this->m_paket->hitungCod();
		$data['hitungLangsung'] = $this->m_paket->hitungLangsung();
		// $data['penerima'] = $this->m_paket->grafikPenerima()-ray();

		$data['data_asc'] = $this->m_paket->tampil_data_asc();
		$data['data_desc'] = $this->m_paket->tampil_data_desc();
		$data['getWarning'] = $this->m_paket->getWarning();

		// $rangking = array();
		$data['peringkat'] = $this->m_paket->list_nama_paket();
		// foreach($data['peringkat'] as $rank => $val){
		// 	$rangking[$val["nama_paket"]] = $val['jumlah'];
		// }
		// $data["rangking"] = $rangking;

		$this->load->view('admin/list_nama_paket', $data);
	}

	//list nama paket
	public function ajax_list_nama_paket() 
    {
        $list = $this->m_list_nama_paket->get_datatables();
		$jumlah_list_nama_paket["jumlah_list_nama_paket"] = $this->m_list_nama_paket->jumlah_list_nama_paket();
		$jumlah = [];
		foreach($jumlah_list_nama_paket["jumlah_list_nama_paket"] as $jm) {
			$jumlah[] = $jm["jumlah"];
		}

        $data = array();
		$jumlah = [];
        $no = $_POST['start'];
        foreach ($list as $paket) {
            $no++;
			$jumlah[] = $paket->id_paket;
			// $jumlah = count($jumlah);
            $row = array();
            // $row[] = $no;
            $row[] = $no;
            // $row[] = $paket->tgl_terima;
            $row[] = $paket->nama_paket;
            $row[] = $paket->hp; 
            $row[] = $paket->jumlah; 
            // $row[] = implode(",",$jumlah);
            // $row[] = $paket->penerima;
            // $row[] = $paket->jenis_kirim;
			// $row[] = $paket->pengambil;
			// $row[] = $paket->jml_paket;
			// if($paket->status_ambil==''){

			// 	$btn_status="<td><a class='btn btn-danger btn-sm' onclick='modalPengambil($paket->id_paket)' href='void:0'>Belum Diambil</a></td>";
			// }else{

			// 	$btn_status="<button class='btn btn-success btn-sm' disabled>Sudah Diambil</button><div><span>$paket->tgl_ambil</span>";
			// }
		// $row[]=$btn_status;
		// $row[]= "<td><a class='btn btn-sm btn-danger' onclick='modalHapusPaket($paket->id_paket)' href='javascript:void(0)'><i class='fa fa-trash' aria-hidden='true'></i></a></td><td><a class='btn btn-sm btn-success' onclick='return confirm('Yakin Hapus $paket->nama_paket ?')' href='".base_url("admin/edit_data/$paket->id_paket")."'><i class='fa fa-edit' aria-hidden='true'></i></a></td>";


            $data[] = $row;
        }
 
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_list_nama_paket->count_all(),
			"recordsFiltered" => $this->m_list_nama_paket->count_filtered(),
			"data" => $data,
		);
        //output to json format
        echo json_encode($output);
	}
}

