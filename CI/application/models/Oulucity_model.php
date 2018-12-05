<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class of Recipe model
 * 
 * @author: Tero Pelkonen
 */

class Oulucity_model extends CI_Model 
{
    
    /**
     * Initialise by calling parent constructor of parent class. Create
     * database connection.
     */
    public function __construct() 
    {
        parent::__construct();
    }

    /**
    * this function is getting all estates if no parameter is given and the single estate details if id is provided
    * 
    * @param string(estate id)
    * @return array
    */
    public function get_estates($id = NULL) 
    {
        if($id != NULL and  $id !="all")
        {
        $source = 'https://api.ouka.fi/v1/properties_basic_information?property_id=eq.'.$id;
        }
        else
        {
        $source = 'https://api.ouka.fi/v1/properties_basic_information';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $source);
        $result = curl_exec($ch);
        // Convert to php array
        $array = json_decode($result, true);
        curl_close($ch);
        //return
        return $array;
    }
    
    
    /**
    * this function is reading entered year and return all Oulu city consumption details
    * from that year. Otherwise it brings all the data.
    * 
    * @param    string(year)
    * @return   boolean
    */
    public function get_consumption($year = NULL,$id = NULL) 
    {
        if($year === NULL and $id === NULL)
        {
            $source = 'https://api.ouka.fi/v1/properties_consumption_yearly';
        }
        elseif($year != NULL and $id === NULL)
        {
            $source = 'https://api.ouka.fi/v1/properties_consumption_yearly?year=eq.'.$year;
        }
        elseif($year === NULL and $id != NULL)
        {
            $source = 'https://api.ouka.fi/v1/properties_consumption_yearly?property_id=eq.'.$id;
        }
        else
        {
            $source = 'https://api.ouka.fi/v1/properties_consumption_yearly?property_id=eq.'.$id.'&year=eq.'.$year;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $source);
        $result = curl_exec($ch);
        // Convert to php array
        $array = json_decode($result, true);
        curl_close($ch);
        //return
        return $array;
    }
    
    /**
    * this function is reading entered year and return all Oulu city consumption details
    * from that year. Otherwise it brings all the data.
    * 
    * @param    string(year)
    * @return   boolean
    */
    public function get_consumption_monthly($year = NULL,$id = NULL) 
    {
        if($year === NULL and $id === NULL)
        {
            $source = 'https://api.ouka.fi/v1/properties_consumption_monthly';
        }
        elseif($year != NULL and $id === NULL)
        {
            $source = 'https://api.ouka.fi/v1/properties_consumption_monthly?year=eq.'.$year;
        }
        elseif($year == NULL and $id != NULL)
        {
            $source = 'https://api.ouka.fi/v1/properties_consumption_monthly?property_id=eq.'.$id;
        }
        else
        {
            $source = 'https://api.ouka.fi/v1/properties_consumption_monthly?property_id=eq.'.$id.'&year=eq.'.$year;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $source);
        $result = curl_exec($ch);
        // Convert to php array
        $array = json_decode($result, true);
        curl_close($ch);
        //return
        return $array;
    }
}