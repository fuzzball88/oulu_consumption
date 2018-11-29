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
        $this->load->database('c9');
    }

    /**
    * this function is getting the estate information from JSON
    * 
    * @param -
    * @return array
    */
    public function all_estates() 
    {
        //Read from local file:
        $json = file_get_contents('../CI/assets/json/properties_basic_information.json');
        //Read from URL:
        //$json = file_get_contents('https://api.ouka.fi/v1/properties_consumption_yearly');
        
        $obj['city'] = json_decode($json, true);
        return $obj;
    }
    
    
    /**
    * this function is getting the single estate details
    * 
    * @param string(estate id)
    * @return array
    */
    public function get_estate($estate_id = NULL) 
    {
        //Read from local file:
        $json = file_get_contents('../CI/assets/json/properties_basic_information.json');
        $obj['city'] = json_decode($json, true);
        $data['estate'] = array_search($estate_id,$obj['city']);
    }
    
    /**
    * this function is reading entered data and adds the new recipe to 
    * the database. 
    * 
    * @param    string(path of the upload image)
    * @return   boolean
    */
    public function insert_recipe($imagepath = NULL) 
    {
        $data = array(
            'title' => $this->input->post('title'),
            'category_id' => $this->input->post('category_id'),
            'ingredients' => $this->input->post('ingredients'),
            'production_method' => $this->input->post('production_method'),
            'production_time' => $this->input->post('production_time'),
            'image_path' => $imagepath
            );
        return $this->db->insert('recipe', $data);
    }
    
    /**
    * this function is reading the new entered data and updates the recipe 
    * to the database. 
    * 
    * @param    id(int  user id), image_path(string path of the upload image)
    * @return   boolean
    */
    public function update_recipe($id = NULL,$image_path = NULL) 
    {
        $data = array(
            'id' => $this->input->post('id'),
            'title' => $this->input->post('title'),
            'ingredients' => $this->input->post('ingredients'),
            'production_method' => $this->input->post('production_method'),
            'production_time' => $this->input->post('production_time'),
            'category_id' => $this->input->post('category_id'),
            'image_path' => $image_path
            );
        
        $this->db->where('id', $data['id']);
        $this->db->update('recipe', $data);
    }
    
    /**
    * this function is deleting the recipe from the database
    * 
    * @param int, user id
    * @return boolean
    */
    public function delete_recipe($id) 
    {
        $delete = $this->db->delete('recipe',array('id'=>$id));
        return $delete?true:false;
    }
}