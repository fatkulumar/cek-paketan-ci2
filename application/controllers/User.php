<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model('m_paket');
		$this->load->helper('url');
		$this->load->model('M_paket','paket');
		// $this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$this->output->delete_cache();
		$data['nama_paket'] = $this->m_paket->grafikNamaPaket()->result_array();
		$data['data_asc'] = $this->m_paket->tampil_data_asc(); 
		$data['hitungCod'] = $this->m_paket->hitungCod();
		$data['hitungLangsung'] = $this->m_paket->hitungLangsung();
		$data['penerima'] = $this->m_paket->grafikPenerima()->result_array();
		$data['getWarning'] = $this->m_paket->getWarning();

		// $rangking = array();
		// $data['peringkat'] = $this->m_paket->peringkat()->result_array();
		// foreach($data['peringkat'] as $rank => $val){
		// 	$rangking[$val["nama_paket"]] = $val['jumlah'];
		// }

		// arsort($rangking);
		// $data['rangking'] = $rangking;

		// $data_rangking = array();
		// foreach($rangking as $rang => $val){
			
			
		// 	$data_rangking[] = [
		// 		'nama' => $rang,
		// 		'jumlah' => $val
		// 	];
		// }

		// $data["data_rangking"] = $data_rangking;

		$this->load->view('user/index', $data);
	}

	public function grafikNamaPaket($tahun)
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Max-Age: 1000");
		header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
		header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
		header('Content-Type: application/json');
		
		$data['paketan_user'] = [];
		$data['nama_paket'] = $this->m_paket->grafikPaket($tahun)->result_array();
		foreach($data['nama_paket'] as $row){

			$nama = $row["nama_paket"];
            $jml = intval($row["jumlah"]);
            $data['paketan_user'][] = [
                'name' => $nama,
                'y' => $jml,
            ];

			// $jenis=$row['jenis_kirim'];
			$data['cod']=$this->db
			->select('nama_paket,jenis_kirim, count(*) as jumlah_cod')
			->group_by('nama_paket')
			->get_where('tb_paket',['jenis_kirim'=> "COD"])->result_array();

			$data['langsung']=$this->db
			->select('nama_paket,jenis_kirim, count(*) as jumlah_langsung')
			->group_by('nama_paket')
			->get_where('tb_paket',['jenis_kirim'=> "langsung"])->result_array();

			// $data['peringkat']=$this->db
			// ->select('nama_paket,jenis_kirim, count(*) as jumlah_langsung')
			// ->group_by('nama_paket')
			// ->get_where('tb_paket',['jenis_kirim'=> "langsung"])->result_array();

			// $rangking = array();
			// $data['peringkat'] = $this->m_paket->peringkat()->result_array();
			// 	foreach($data['peringkat'] as $rank => $val){
			// 		$rangking[$val["nama_paket"]] = $val['jumlah'];
			// }

			// arsort($rangking);
			// $data['rangking'] = $rangking;

			// $data_rangking = array();
			// $no = 0;
			// foreach($rangking as $rang => $val){
			// 	$no++;
			// 	if($no == 4){break;	}
			// 		$data_rangking[] = [
			// 			'nama' => $rang,
			// 			'jumlah' => $val
			// 		];
			// }

			// $data["data_rangking"] = $data_rangking;
			
		}
		// $data['tahun'] = $tahun;
		$data['jumlah_nama_paket'] = $this->m_paket->grafikNamaPaket()->num_rows();

		// $rangking = array();
		// $data['peringkat'] = $this->m_paket->peringkat()->result_array();
		// foreach($data['peringkat'] as $rank){
		// 	echo $rangking[] =  $rank["jumlah"];
		// 	echo "<br>";
		// }

		// rsort($rangking);
		// $data['rank'] = $rangking;

   
		echo json_encode($data);
	}

	public function ajax_list()
    {
        $list = $this->m_paket->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $paket) {
            $no++;
            $row = array();
            $row[] = $paket->tgl_terima;
            $row[] = $paket->nama_paket;
            $row[] = $paket->hp;
            $row[] = $paket->penerima;
            $row[] = $paket->jml_paket;
            $row[] = $paket->jenis_kirim;
            if($paket->status_ambil==''){

				$btn_status="<td><a class='btn btn-danger btn-sm' href='javascript:void(0)'>Belum Diambil</a></td>";
			}else{

				$btn_status="<button class='btn btn-success btn-sm' disabled>Sudah Diambil</button><div><span>$paket->tgl_ambil</span>";
			}
			$row[]=$btn_status;

            $data[] = $row;
			
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->paket->count_all(),
                        "recordsFiltered" => $this->paket->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	function grafik_pisah()
	{
		$this->output->delete_cache();
		$data['nama_paket'] = $this->m_paket->grafikNamaPaket()->result_array();
		$data['data_asc'] = $this->m_paket->tampil_data_asc(); 
		$data['hitungCod'] = $this->m_paket->hitungCod();
		$data['hitungLangsung'] = $this->m_paket->hitungLangsung();
		$data['penerima'] = $this->m_paket->grafikPenerima()->result_array();
		$data['getWarning'] = $this->m_paket->getWarning();
		$this->load->view('user/grafik_pisah_user', $data);
	}
}
