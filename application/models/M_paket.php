<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
     
    class M_paket extends CI_Model{
        
        var $table = "tb_paket";
        private $table_other = "tb_other";

        var $column_order = array(null, 'nama_paket','tgl_terima','hp','penerima','jenis_kirim','status_ambil', 'tgl_ambil'); //set column field database for datatable orderable
        var $column_search = array('nama_paket','tgl_terima','hp','penerima','jenis_kirim','status_ambil', 'tgl_ambil'); //set column field database for datatable searchable 
        var $order = array('id_paket' => 'desc'); // default order 

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        function tampil_data_asc(){
            return $this->db
            ->select('`id_paket`, `id_santri`, `nama_paket`, `penerima`, `jenis_kirim`, `tgl_terima`, `tgl_ambil`, `pengambil`, `status_ambil`, `hp`, `creat_at`, `modified_at`, `tahun`, `jml_paket`')
            ->order_by('id_paket','desc')
            ->get($this->table)->result_array();
        }
 
        function tampil_data_desc(){
            return $this->db
            ->select('id_paket,nama_paket,tgl_terima,penerima,jenis_kirim,status_ambil, tgl_ambil')
            ->limit(6)
            ->order_by('id_paket','desc')
            ->get($this->table)->result_array();
        }

        public function getOne($id)
        {
            return $this->db->get_where($this->table, ["id_paket" => $id])->row();
        }

        function hapus_data($id)
        {
            return $this->db->delete($this->table, array("id_paket" => $id));
        }
    
        function input_paket($data,$table)
        {
            $this->db->insert($table,$data);
        }

        function update_data($data, $table, $id)
        {
            $this->db->update($table, $data, ["id_paket" => $id]);
        }

        function hitungCod()
        {
            return $this->db->get_where($this->table, ['jenis_kirim' => 'COD'])->num_rows();
        }

        function hitungLangsung()
        {
            return $this->db->get_where($this->table, ['jenis_kirim' => 'Langsung'])->num_rows();
        }
        //mencari nama paket
        function grafikNamaPaket()
        {
            return $query = $this->db
            ->select('nama_paket,jenis_kirim,hp, count(*) as jumlah')
            ->group_by('nama_paket')
            ->get($this->table);
        }
        //mencari nama paket berdasarkan tahun
        function grafikPaket($tahun)
        {
           return $query = $this->db
           ->select('nama_paket,jenis_kirim,tahun,hp,penerima, count(*) as jumlah')
           ->group_by('nama_paket')
           ->where('tahun',$tahun)
           ->get($this->table);
            // return $this->db->query("SELECT nama_paket,jenis_kirim,tahun,hp, count(*) as jumlah FROM `tb_paket` where tahun='$tahun' group by nama_paket");
        }
        //grafik penerima melalui json grafik
        function grafikPenerimaJson($tahun)
        {
            return $query = $this->db
            ->select('penerima, count(*) as jumlah')
            ->group_by('penerima')
            ->where('tahun',$tahun)
            ->get($this->table);
        }
        
        //grafik penerima melalui index
        function grafikPenerima()
        {
            return $query = $this->db
            ->select('penerima, count(*) as jumlah')
            ->group_by('penerima')
            ->get($this->table);
        }

        function updateWarning($data)
        {
            return $this->db->update($this->table_other, $data);
        }

        function updateInfo($data)
        {
            return $this->db->update($this->table_other, $data);
        }

        function getWarning()
        {
            return $this->db
            ->select('warning, info')
            ->get($this->table_other)->result_array();
        }

        function peringkat($tahun)
        {
            return $this->db
            ->select('nama_paket, count(*) as jumlah')
            ->group_by('nama_paket')
            ->where('tahun', $tahun)
            ->get($this->table);
        }

        function idAkhir()
        {
            return $this->db
            ->select('id_paket') 
            ->order_by('id_paket', 'desc')
            ->get($this->table);
        }

        private function _get_datatables_query()
        {
             
            $this->db->from($this->table);
     
            $i = 0;
         
            foreach ($this->column_search as $item) // loop column 
            {   
                if($_POST['search']['value']) // if datatable send POST for search
                {
                     
                    if($i===0) // first loop
                    {
                        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
     
                    if(count($this->column_search) - 1 == $i) //last loop
                        $this->db->group_end(); //close bracket
                }
                $i++;
            }
             
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
            
        }

        function get_datatables()
        {
            $this->_get_datatables_query();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            // $query = $this->db->get();
            $query = $this->db
            ->select('`id_paket`, `id_santri`, `nama_paket`, `penerima`, `jenis_kirim`, `tgl_terima`, `tgl_ambil`, `pengambil`, `status_ambil`, `hp`, `creat_at`, `modified_at`, `tahun`, `jml_paket`')
            ->order_by('id_paket','desc')
            ->get();
            return $query->result();
        }
    
        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
    
        public function count_all()
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }

        function filter_hp($hp)
        {
            return $this->db
            ->select('nama_paket')
            ->where('hp', $hp)
            ->get($this->table);
        }

        function filter_nama_paket($nama_paket)
        {
            return $this->db
            ->select('hp')
            ->where('nama_paket', $nama_paket)
            ->get($this->table);
        }

        function tahun()
        {
            return $this->db
            ->select('tahun')
            ->group_by('tahun')
            ->get($this->table)->result_array();
        }

    }

?>