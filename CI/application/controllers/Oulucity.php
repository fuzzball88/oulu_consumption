<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set("allow_url_fopen", 1);
/*
require "../vendor/autoload.php";
use GuzzleHttp\Client;
define('REST_SERVER','https://api.ouka.fi/v1/');
*/

class Oulucity extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        //Read from local file:
        $json = file_get_contents('../CI/assets/json/properties_basic_information.json');
        //Read from URL:
        //$json = file_get_contents('https://api.ouka.fi/v1/properties_consumption_yearly');
        
        $obj['city'] = json_decode($json, true);
        
        $this->load->view('oulucity/index',$obj);
    }
}