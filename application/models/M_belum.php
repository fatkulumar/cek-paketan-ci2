<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
     
    class M_belum extends CI_Model{
        
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
            ->where('status_ambil IS', 'NULL', false)
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

        function tampil_data_asc(){
            return $this->db
            ->select('`id_paket`, `id_santri`, `nama_paket`, `penerima`, `jenis_kirim`, `tgl_terima`, `tgl_ambil`, `pengambil`, `status_ambil`, `hp`, `creat_at`, `modified_at`, `tahun`, `jml_paket`')
            ->order_by('id_paket','desc')
            ->where('status_ambil IS', 'NULL', false)
            ->get($this->table)->result_array();
        }

        }

?>