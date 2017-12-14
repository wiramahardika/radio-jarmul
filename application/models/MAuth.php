<?php

class MAuth extends CI_Model
{
    public $username;
    public $password;
    public $token;

    private $table = 'broadcaster';

    private function checkCaptcha($response)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $secret_token = "6LdqsTwUAAAAAGoSfn5LggdZfBWxPFX2-xZ3Kybt";
        $data_post = array(
            'secret' => $secret_token,
            'response' => $response
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
            return 1;
        }
        else {
            return 0;
        }
    }

    private function generateToken($userId){
        $static_str='AL';
        $currenttimeseconds = date("mdY_His");
        $token_id=$static_str.$userId.$currenttimeseconds;

        return md5($token_id);
	  }

    public function login($username, $password, $response)
    {
        $ret = $this->checkCaptcha($response);

        if($ret == 0)
        {
            return 0;
        }
        
        $query = $this->db->from($this->table)->where('username', $username)->get();
        //var_dump($query->results());
        if($query->num_rows() > 0)
        {
            $row = $query->row();

            $hash = $row->password;

            if(password_verify($password, $hash))
            {
                $token = $this->generateToken($row->id);
                $this->db->where('id', $row->id)->update($this->table, array('token' => $token));
                $this->session->set_userdata('token', $token);

                return $row->id;
            }
            else {
              return 0;
            }
        }
        else {
          return 0;
        }
    }

    public function isLogged()
    {
        $token = $this->session->userdata('token');

        if($token == NULL)
        {
            return 0;
        }

        $query = $this->db->from($this->table)->where('token', $token)->get();

        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row->id;
        }
        else {
          return 0;
        }
    }

    public function logout()
    {
        $token = $this->session->userdata('token');

        if($token == NULL)
        {
            return;
        }

        $this->db->where('token', $token)->update($this->token, array('token'=>''));

        $this->session->unset_userdata('token');
    }

    public function simpan()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->db->insert($this->table, $this);
    }


}
