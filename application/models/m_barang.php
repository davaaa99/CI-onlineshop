<?php 

class M_barang extends CI_Model{

    public function __construct(){
		$this->load->database();
    }
    
    function get_barang(){
		return $this->db->query("SELECT * FROM barang");
    }
    
    function insertbarang($data){
      $query = $this->db->query("INSERT INTO barang(kode,nama,harga,stock,keterangan,filebr,berat) values ('$data[kode]','$data[nama]','$data[harga]','$data[stock]','$data[keterangan]','$data[filebr]','$data[berat]')");
    }

    public function getAllBarang()
     {
          $this->db->select('*');
          $this->db->from('barang');

          return $this->db->get();
     }

    function get_barang_kode($kode){
     $query = $this->db->query("SELECT * FROM barang where kode = $kode");
     return $query->result();
    }

    public function update_stock_barang($data){
      $this->db->query("UPDATE barang SET stock= stock - $data[jmljual] WHERE kode=$data[KodeBrg]");
    }

    function jumlah_data(){
    return $this->db->get('barang')->num_rows();
  }
    function data($number,$offset){
    return $query = $this->db->get('barang',$number,$offset)->result();   
  }

  function getBarangbyNama($limit, $offset, $nama)
    {
        $sql = "SELECT * from barang where nama like '%$nama%' LIMIT $offset,$limit";
        $query = $this->db->query($sql);
        return $query->result();
    }
  
}

?>