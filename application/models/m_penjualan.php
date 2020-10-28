<?php 

class m_penjualan extends CI_Model{

    public function __construct(){
		$this->load->database();
    }

    public function create_penjualan($data){
        $this->db->query("INSERT INTO penjualan(nama,hp,alamat,kota,kodepos,ongkir,total,status) VALUES('$data[nama]','$data[hp]','$data[alamat]','$data[kota]','$data[kodepos]','$data[ongkir]','$data[total]','unpaid')");
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function get_penjualan(){
      return $this->db->query("SELECT * FROM penjualan");
    }

    public function set_status_penjualan($id,$status){
      $this->db->query("UPDATE penjualan SET status='$status' WHERE NoPjl = $id" );
    }
}
