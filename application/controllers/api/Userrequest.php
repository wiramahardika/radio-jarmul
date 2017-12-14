<?php

class Userrequest extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('MRequest');
    }

    public function tambahrequest()
    {
        $json_data = array();

        $this->MRequest->nama = $this->input->post('nama');
        $this->MRequest->song = $this->input->post('song');
        $this->MRequest->artist = $this->input->post('artist');
        $this->MRequest->message = $this->input->post('message');

        $res = $this->MRequest->simpan();

        if($res == 1)
        {
              $json_data = array(
                  'status'=>'success'
              );
        }
        else {
          $json_data = array(
              'status'=>'error'
          );
        }

        echo json_encode($json_data);
    }

    public function getAllRequest()
    {
        $data = $this->MRequest->getData();

        $json_data = array(
            'status'=>'success',
            'data'=>$data
        );

        echo json_encode($json_data);
    }

    public function hapus()
    {
        $json_data =array();

        $res = $this->MRequest->hapus($this->input->post('id'));

        if($res == 1)
        {
              $json_data = array(
                  'status'=>'success'
              );
        }
        else {
          $json_data = array(
              'status'=>'error'
          );
        }

        echo json_encode($json_data);
    }

    public function getRequestById()
    {
      $data = $this->MRequest->getById($this->input->post('id'));

      $json_data = array(
          'status'=>'success',
          'data'=>$data
      );

      echo json_encode($json_data);
    }
}
