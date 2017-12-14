<?php

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MAuth');
    }
    public function testPost()
    {
        echo $this->input->post('isi');
    }

    public function register()
	   {
    			$this->MAuth->username = $this->input->post('username');
    			$this->MAuth->password = $this->input->post('password');

    			$this->MAuth->simpan();
	   }

     public function login()
     {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $response = $this->input->post('captcha');

        $res = $this->MAuth->login($username, $password, $response);

        $json_data = array();

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

     public function logout()
     {
        $this->MAuth->logout();
     }

    public function index()
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $secret_token = "6LdqsTwUAAAAAGoSfn5LggdZfBWxPFX2-xZ3Kybt";
        $data_post = array(
            'secret' => $secret_token,
            'response' => $secret_token
        );
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_post));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        $ret = json_decode($server_output);

        if($ret->success)
        {
            echo 'berhasil';
        }
        else {
            echo 'gagal';
        }
    }
}
