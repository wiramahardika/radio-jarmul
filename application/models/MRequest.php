<?php

class MRequest extends CI_Model
{
    public $nama;
    public $song;
    public $artist;
    public $message;

    private $cipher = "aes-128-cbc";
    private $iv = '6aa1e29a40495459ff4ab5233962a7e8';
    private $key = 'd486f32bc2086f0133cd0008565c2f462eb49a9f33d5e3459006afa203bd3515';
    private $table = 'user-request';

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

    private function encrypt_data($plaintext)
    {
        $cipher = $this->cipher;
        $iv = $this->iv;
        $key = $this->key;

        $encrypted = base64_encode(openssl_encrypt($plaintext, $cipher, hex2bin($key), $options=OPENSSL_RAW_DATA, hex2bin($iv)));

        return $encrypted;
    }

    private function decrypt_data($encrypted)
    {
        $cipher = $this->cipher;
        $iv = $this->iv;
        $key = $this->key;

        $decrypted = openssl_decrypt(base64_decode($encrypted), $cipher, hex2bin($key), OPENSSL_RAW_DATA, hex2bin($iv));

        return $decrypted;
    }

    public function simpan($response)
    {
        try
        {
          $ret = $this->checkCaptcha($response);

          if($ret == 0)
          {
              return 0;
          }

          $this->nama = $this->encrypt_data($this->nama);
          $this->song = $this->encrypt_data($this->song);
          $this->artist = $this->encrypt_data($this->artist);
          $this->message = $this->encrypt_data($this->message);

          $this->db->insert($this->table, $this);
        }
        catch(Exception $e)
        {
            return 0;
        }

        return 1;
    }

    public function getData()
    {
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0)
        {


            $res = $query->result_array();

            for($i=0; $i< count($res); $i++)
            {
                $res[$i]['nama'] = $this->decrypt_data($res[$i]['nama']);
                $res[$i]['song'] = $this->decrypt_data($res[$i]['song']);
                $res[$i]['artist'] = $this->decrypt_data($res[$i]['artist']);
                $res[$i]['message'] = $this->decrypt_data($res[$i]['message']);
            }

            return $res;
        }

        return NULL;
    }

    public function getById($id)
    {
      $query = $this->db->where(array('id'=>$id))->get($this->table);

      if($query->num_rows() > 0)
      {


          $res = $query->result_array();

          for($i=0; $i< count($res); $i++)
          {
              $res[$i]['nama'] = $this->decrypt_data($res[$i]['nama']);
              $res[$i]['song'] = $this->decrypt_data($res[$i]['song']);
              $res[$i]['artist'] = $this->decrypt_data($res[$i]['artist']);
              $res[$i]['message'] = $this->decrypt_data($res[$i]['message']);
          }

          return $res;
      }

      return NULL;
    }
    public function hapus($id)
    {
        try {
            $this->db->delete($this->table, array('id' => $id));
            return 1;
        } catch (Exception $e) {
            return 0;
        }

    }


}
