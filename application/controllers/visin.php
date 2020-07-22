<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visin extends CI_Controller {

    public function index()
	{
        $dataUrl=base_url('assets/data_row.json');
        $dataStringJson=file_get_contents($dataUrl);
        $dataJson=json_decode($dataStringJson);
        //mengambil data row
        $data=$dataJson[2]->data;
        //memanggil fungsi region()
        $output['region']=$this->region($data);
        $output['bancana']=$this->bancana($data);
        $output['produk']=$this->produk($data);   
        //mengirim variabel $output ke view      
        $this->load->view('visin',$output);
        //echo json_encode($output['bulanan']);
    }

    function region($data)
    {
        $result=array();
        foreach($data as $row)
        {
            if(isset($result[$row->Region]) == false)
            {
                $result[$row->Region]=$row->Bencana;
            }else{
                $Bencana=$result[$row->Region];
                $result[$row->Region]=$Bencana + $row->Bencana;
            }
        };
        //konversi dalam format tabulasi
        $keys=array_keys($result);
        $tabs=[['Region','Bencana']];
        foreach($keys as $row)
        {
            $dt=[$row,$result[$row]];
            array_push($tabs,$dt);
        }
        return json_encode($tabs);
    }

    function bancana($data)
    {
        $result=array();
        foreach($data as $row)
        {
            if(isset($result[$row->Rep]) == false)
            {
                $result[$row->Rep]=$row->Bencana;
            }else{
                $Bencana=$result[$row->Rep];
                $result[$row->Rep]=$Bencana + $row->Bencana;
            }
        };
        //sorting data berdasarkan value array secara menurun
        arsort($result);
        //konversi dalam format tabulasi
        $keys=array_keys($result);
        $tabs=[['bancana','Bencana']];
        foreach($keys as $row)
        {
            $dt=[$row,$result[$row]];
            array_push($tabs,$dt);
        }
        return json_encode($tabs);
    }

    function produk($data)
    {
        $result=array();
        foreach($data as $row)
        {
            if(isset($result[$row->Jenis]) == false)
            {
                $result[$row->Jenis]=$row->Bencana;
            }else{
                $Bencana=$result[$row->Jenis];
                $result[$row->Jenis]=$Bencana + $row->Bencana;
            }
        };
        //sorting data berdasarkan value array secara menurun
        arsort($result);
        //konversi dalam format tabulasi
        $keys=array_keys($result);
        $tabs=[['Produk','Bencana']];
        foreach($keys as $row)
        {
            $dt=[$row,$result[$row]];
            array_push($tabs,$dt);
        }
        return json_encode($tabs);
    }

    
}