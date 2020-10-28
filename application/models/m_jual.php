<?php 

class m_jual extends CI_Model{

    public function __construct(){
		$this->load->database();
    }
    public function create_jual($data){
        $this->db->query("INSERT INTO jual(NoPjl,KodeBrg,jmljual,hargajual) VALUES('$data[NoPjl]','$data[KodeBrg]','$data[jmljual]','$data[hargajual]')");
    }
    function get_barang_kode($kode){
        $query = $this->db->query("SELECT * FROM barang where kode = $kode");
        return $query->result();
       }
}
