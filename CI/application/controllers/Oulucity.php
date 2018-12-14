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
        $this->load->model('Oulucity_model');
    }
    
    public function index(){
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $obj['estates'] = $this->Oulucity_model->get_estates();
        $this->load->view('templates/header');
        $this->load->view('templates/header_video'); 
        $this->load->view('oulucity/index',$obj);
        $this->load->view('templates/footer');
        /*
        if($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('oulucity/index',$obj);
            $this->load->view('templates/footer');
        }
        else
        {
            $id = $this->input->post('property_id');
            $obj['estate'] = $this->Oulucity_model->get_estates($id);
            
            $this->load->view('templates/header');
            $this->load->view('oulucity/consumption_yearly',$obj);
            $this->load->view('templates/footer');
        }*/
    }
    
    public function estates($id = NULL)
    {
        $getid = $this->input->post('estate');
        if($id===NULL and $getid === 'all')
        {
            $obj['estate'] = $this->Oulucity_model->get_estates($getid);
            $this->load->view('templates/header');
            $this->load->view('oulucity/all_estates',$obj);
            $this->load->view('templates/footer');
        }
        elseif($id === NULL and $getid === NULL)
        {
            $obj['estate'] = $this->Oulucity_model->get_estates();
            $this->load->view('templates/header');
            $this->load->view('oulucity/all_estates',$obj);
            $this->load->view('templates/footer');
        }
        elseif($id != NULL and $getid != 'all')
        {
            //$year='2017';
            $obj['estate'] = $this->Oulucity_model->get_estates($id);
            $obj['usage'] = $this->Oulucity_model->get_consumption(NULL,$id);
            $this->load->view('templates/header');
            $this->load->view('oulucity/estate',$obj);
            $this->load->view('oulucity/test_years2',$obj);
            //$this->load->view('oulucity/year_usage',$obj);
            $this->load->view('templates/footer');
        }
        elseif($id === NULL and $getid != 'all')
        {
            //$year='2017';
            $obj['estate'] = $this->Oulucity_model->get_estates($getid);
            $obj['usage'] = $this->Oulucity_model->get_consumption(NULL,$getid);
            $this->load->view('templates/header');
            $this->load->view('oulucity/estate',$obj);
            $this->load->view('oulucity/test_years2',$obj);
            //$this->load->view('oulucity/year_usage',$obj);
            $this->load->view('templates/footer');
        }
        
    }
    
    public function consumption_yearly($year = NULL,$id = NULL)
    {
        $getid = $this->input->post('property_id');
        $obj['year'] = $year;
        $obj['id'] = $id;
        if($year != NULL and $id != NULL and $getid === NULL)
        {
            $obj['estate'] = $this->Oulucity_model->get_consumption($year,$id);
        }
        elseif($year != NULL and $id === NULL and $getid === NULL)
        {
            $obj['estate'] = $this->Oulucity_model->get_consumption($year,NULL);
        }
        elseif($year === NULL and $id != NULL and $getid === NULL)
        {
            $obj['estate'] = $this->Oulucity_model->get_consumption(NULL,$id);
        }
        elseif($year === NULL and $id === NULL and $getid != NULL)
        {
            $obj['estate'] = $this->Oulucity_model->get_consumption(NULL,$getid);
        }
        elseif($year === NULL and $id === NULL and $getid === NULL)
        {
            $obj['estate'] = $this->Oulucity_model->get_consumption();
        }
        $this->load->view('templates/header');
        $this->load->view('oulucity/consumption_yearly',$obj);
        $this->load->view('templates/footer');
        
    }
    
    // test here the monthly thing 
    public function test_consumption_mothly($year = NULL,$id = NULL)
    {
        $obj['estate'] = $this->Oulucity_model->get_consumption_monthly($year,$id);
        
        $this->load->view('templates/header');
        $this->load->view('oulucity/test_consumption_monthly',$obj);
        $this->load->view('templates/footer');
    }
    
    public function district($id = NULL)
    {
        //$id = $this->input->post('district');
        $obj['districtname'] = $id;
        $obj['estates'] = $this->Oulucity_model->get_estates();
        
        $this->load->view('templates/header');
        $this->load->view('oulucity/district_estates',$obj);
        $this->load->view('templates/footer');
    }
}