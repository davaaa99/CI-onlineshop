<?php defined('BASEPATH') OR die('No direct script access allowed');

// require ('application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class c_admin extends CI_Controller {
    function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_penjualan');
        $this->load->model('m_barang');
        $this->load->library('pagination');  
    }
    
    public function index()
     {
          $data['semuabarang'] = $this->m_barang->getAllBarang()->result();
          $this->load->view('export', $data);
     }

     public function importview()
     {
          $this->load->view('v_import');
     }

     public function adminbarang(){ 
            $this->load->database();
            $jumlah_data = $this->m_barang->jumlah_data();
            $config['base_url'] = base_url().'index.php/barangadmin/';
            $config['total_rows'] = $jumlah_data;
            $config['per_page'] = 3;
            $from = $this->uri->segment(2);

            //Boostraps
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';

            $this->pagination->initialize($config);   
            $data['barang'] = $this->m_barang->data($config['per_page'],$from);
            $data['pagination'] = $this->pagination->create_links();
            $data['page']=$this->load->view('v_barangadmin',$data,TRUE);
            $this->load->view('v_templateadmin',$data);
    }


    public function search(){
        $search = ($this->input->post('nama'))? $this->input->post('nama') : NULL;
        $searchs = ($this->uri->segment(2)) ? $this->uri->segment(2) : $search;

        $this->load->database();
            $jumlah_data = $this->m_barang->jumlah_data();
            $config['base_url'] = base_url().'index.php/barangadmin/';
            $config['total_rows'] = $jumlah_data;
            $config['per_page'] = 3;
            $from = $this->uri->segment(2);


        //Boostraps
            $config['first_link']       = 'First';
            $config['last_link']        = 'Last';
            $config['next_link']        = 'Next';
            $config['prev_link']        = 'Prev';
            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';
            $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close']    = '</span></li>';
            $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['prev_tagl_close']  = '</span>Next</li>';
            $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $config['first_tagl_close'] = '</span></li>';
            $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $config['last_tagl_close']  = '</span></li>';


        $this->pagination->initialize($config);   
            $data['barang'] = $this->m_barang->getBarangbyNama($config['per_page'],$from,$searchs);
            $data['pagination'] = $this->pagination->create_links();
            $data['page']=$this->load->view('v_barangadmin',$data,TRUE);
            $this->load->view('v_templateadmin',$data);
    }






     

    public function displaypenjualan(){		
        $data['penjualan'] = $this->m_penjualan->get_penjualan()->result();
        $data['page']=$this->load->view('v_adminhome',$data,TRUE);
        $this->load->view('v_templateadmin',$data);
    }
    public function set_status_penjualan(){
        $NoPjl = $this->input->post('NoPjl');
        $status = $this->input->post('status');
        $this->m_penjualan->set_status_penjualan($NoPjl,$status);
        redirect('/adminhome');
    }
    public function export()
     {
        $barang = $this->m_barang->get_barang()->result();

        $spreadsheet = new Spreadsheet;  

        $spreadsheet->setActiveSheetIndex(0)
                      ->setCellValue('A1', 'Kode Barang')
                      ->setCellValue('B1', 'Nama Barang')
                      ->setCellValue('C1', 'Harga Barang')
                      ->setCellValue('D1', 'Berat Barang')
                      ->setCellValue('E1', 'Stock Barang')
                      ->setCellValue('F1', 'Keterangan Barang')
                      ->setCellValue('G1', 'File Barang');

          $kolom = 2;
          $nomor = 1;
          foreach($barang as $b) {

               $spreadsheet->setActiveSheetIndex(0)
                           ->setCellValue('A' . $kolom, $b->kode)
                           ->setCellValue('B' . $kolom, $b->nama)
                           ->setCellValue('C' . $kolom, $b->harga)
                           ->setCellValue('D' . $kolom, $b->berat)
                           ->setCellValue('E' . $kolom, $b->stock)
                           ->setCellValue('F' . $kolom, $b->keterangan)
                           ->setCellValue('G' . $kolom, $b->filebr);

               $kolom++;
               $nomor++;

          }

          $writer = new Xlsx($spreadsheet);

          header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="Barang.xlsx"');
	  header('Cache-Control: max-age=0');

	  $writer->save('php://output');
    
    }



    public function importdata()
    {


    $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
    if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
 
    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
    $extension = end($arr_file);
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);
     
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
	for($i = 1;$i < count($sheetData);$i++)
	{
        $data = array(
        'kode' => $sheetData[$i]['0'],
        'nama' => $sheetData[$i]['1'],
        'harga' => $sheetData[$i]['2'],
        'stock' => $sheetData[$i]['4'],
        'keterangan' => $sheetData[$i]['5'],
        'filebr' => $sheetData[$i]['6'],
        'berat' => $sheetData[$i]['3']
        );
        $this->m_barang->insertbarang($data);    
    
    }
    
    redirect("adminhome"); 
}
}

}