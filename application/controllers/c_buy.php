<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_buy extends CI_Controller {
    function __construct(){
		parent::__construct();
        $this->load->helper('url');
    }
    public function getkota_id($city_id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=".$city_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "key: 0ff33abee4e273c7eabf2955324a15ca"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response);
            // print_r($result);
            return $result->rajaongkir->results->city_name;
            // foreach ($result as $c ) {
            //     foreach ($c['results'] as $kota ) {
            //         $namakota = $kota->city_name;
            //         return $namakota;
            //     }
            // }
        }
    }
    public function konfirmasi()
    {
        // print_r($this->input->post());
        $namakota = $this->getkota_id($this->input->post('city'));
        $ongkir = $this->ongkir($this->input->post('city'));
        $data = array(
            'nama' => $this->input->post('name'),
            'hp' => $this->input->post('phonenumber'),
            'alamat' => $this->input->post('address'),
            'kota' => $namakota,
            'kodepos' => $this->input->post('zipcode'),
            'total' => $this->cart->total(),
            'ongkir' => $ongkir,
        );
        $data['page'] = $this->load->view('v_konfirmasi',$data,TRUE);
        $this->load->view('v_template',$data);
    }

    public function beli()
    {
        $data = array(
            'nama' => $this->input->post('name'),
            'hp' => $this->input->post('phonenumber'),
            'alamat' => $this->input->post('address'),
            'kota' => $this->input->post('city'),
            'kodepos' => $this->input->post('zipcode'),
            'total' => $this->input->post('totalbayar'),
            'ongkir' => $this->input->post('ongkir'),
    );
    $data['NoPjl'] = $this->m_penjualan->create_penjualan($data);
    foreach($this->cart->contents() as $cartItem){
        $data['KodeBrg'] = $cartItem['id'];
        $data['jmljual'] = $cartItem['qty'];
        $data['hargajual'] = $cartItem['price'];
        $this->m_jual->create_jual($data);
        $this->m_barang->update_stock_barang($data);
    }
    $this->cart->destroy();
    redirect('/home');
    }

    public function checkoutongkir(){
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "key: 0ff33abee4e273c7eabf2955324a15ca"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        // echo $response; 
        $response_object = json_decode($response);
        $city_result = $response_object->rajaongkir->results;
        $this->data['cities'] = $city_result;
        $this->data['courier'] = ["jne","pos","tiki"];
        $data['page'] = $this->load->view('v_formbeli',$this->data,TRUE);
        $this->load->view('v_template',$data);
        }
    }

    public function ongkir($city_id){
        $totalberat = 0;
        foreach ($this->cart->contents() as $cart) {
            $totalberat +=  $cart['berat'] * $cart['qty'];
        }
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=22&destination=".$city_id."&weight=".$totalberat."&courier=jne",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 0ff33abee4e273c7eabf2955324a15ca"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response,TRUE);
        foreach ($result as $res) {
            foreach ($res['results'] as $r ) {
                foreach ($r['costs'] as $c) {
                    if ($c['service'] == 'REG' || $c['service'] == 'CTC' ) {
                        $ongkir = $c['cost'][0]['value'];
                        return $ongkir;
                    }
                }
            }
        }
        
        }
    }
}
    