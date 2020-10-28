<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_cart extends CI_Controller {
    function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_barang');
	}
    function addcart($kode)
    {
        $barang = $this->m_barang->get_barang_kode($kode);
        foreach($barang as $b){
        $data = array(
                'id' => $b->kode,
                'name' => $b->nama,
                'price' => $b->harga,
                'berat' => $b->berat,
                'qty' => 1,
                'file_gambar' => $b->filebr,
                'keterangan' => $b->keterangan
        );
        
        $this->cart->insert($data);
        redirect('home');
        }   
    }
    public function display()
    {
        $data['page'] = $this->load->view('v_cart','',TRUE);
        $this->load->view('v_template',$data);
    }
    public function delete()
    {
        $id = $this->input->post('id');
        $this->cart->remove($id);
        redirect('cart');
    }
    public function deleteAll()
    {
       
        $this->cart->destroy();
        redirect('cart');
    }

}