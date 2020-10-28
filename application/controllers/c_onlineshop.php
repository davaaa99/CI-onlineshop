<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_onlineshop extends CI_Controller {
	
	function __construct(){
	parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_barang');
	}

	public function home(){		
        // $data['page']=$this->load->view('v_home','',TRUE);
        $this->load->view('v_onlineshop');
        
        }
	
    public function display(){		
            $data['barang'] = $this->m_barang->get_barang()->result();
            $data['page']=$this->load->view('v_onlineshop',$data,TRUE);
            $this->load->view('v_template',$data);
        
    }
    
}
?>