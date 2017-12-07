<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Song_title extends CI_Controller {

	public function index()
	{
    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/currentsong?sid=1");

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    echo $output;

    // close curl resource to free up system resources
    curl_close($ch);
	}
}
