<?php
Class c_pdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    
    function index(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // memasukan gambar
        $pdf->Image(base_url(). 'assets/img/tokopedia-logo.png',150,0,50,0,'PNG');
        // mencetak string 
        $pdf->SetTextColor(66 ,181, 73);
        $pdf->Cell(190,40,'DAFTAR BARANG TOKOPEDIA',0,0,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetTextColor(0 ,0, 0);
        $pdf->SetFont('Arial','B',8);
        $pdf -> SetY(45);
        $pdf->Cell(5);
        $pdf->Cell(20,6,'Kode',1,0);
        $pdf->Cell(50,6,'Nama Barang',1,0);
        $pdf->Cell(27,6,'Harga',1,0);
        $pdf->Cell(25,6,'Stock',1,0);
        // $pdf->Cell(23,6,'Stock',1,0);
        $pdf->Cell(50,6,'Keterangan',1,1);
        // $pdf->Cell(21,6,'Berat',1,1);
        $pdf->SetFont('Arial','',10);
        $barang = $this->m_barang->get_barang()->result();
        foreach ($barang as $row){
            $pdf->Cell(5);
            $pdf->Cell(20,6,$row->kode,1,0);
            $pdf->Cell(50,6,$row->nama,1,0);
            $pdf->Cell(27,6,'Rp. '.$row->harga,1,0);
            $pdf->Cell(25,6,$row->stock,1,0); 
            $pdf->Cell(50,6,$row->keterangan,1,1); 
        }
        
        $pdf->Output();
    }
}