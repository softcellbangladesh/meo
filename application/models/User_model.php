<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
	public $variable;
	public function __construct()
	{
		parent::__construct();
		
	}

	// Insert data

	function insert_user($user_data)
	{
		$this->db->insert('land_owner', $user_data);
		$id = $this->db->insert_id();
        return (isset($id)) ? TRUE : FALSE;
	}

	function insert_data($table,$data)
	{
		$this->db->insert($table, $data);
		$id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
	}

	function insert_data_multi($table,$data)
	{
		$this->db->insert($table, $data);
		$id = $this->db->insert_id();
        return (isset($id)) ? TRUE : FALSE;
	}

	function insert_contact($contact_data)
	{
		return $this->db->insert('contact', $contact_data);
	}

	// End of insert
	
	function check_if_social_user_exists($social_id)
	{
		$this->db->where('user_social_id', (int) $social_id);
		$this->db->from('users');
		return $this->db->count_all_results();
	}

	function login_check($login_data)
	{
		if(empty($login_data['user_verification'])){
			$this->db->select('*');
			$this->db->from('land_owner');
			$this->db->where('nid', $login_data['user_nid']);		
			//$this->db->where('password', sha1($login_data['password']));
			//$this->db->group_by('nid');
			$this->db->order_by('land_owner_id','desc');
			$this->db->limit(1);
			return $this->db->get()->row_array();
		}else{
			$this->db->select('*');
			$this->db->from('land_owner');
			$this->db->where('nid', $login_data['user_nid']);		
			$this->db->where('random_number', $login_data['user_verification']);
			//$this->db->group_by('nid');
			$this->db->order_by('land_owner_id','desc');
			$this->db->limit(1);
			return $this->db->get()->row_array();
		}
	}

	function login_admin_check($login_data)
	{		
		
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('employee_username', $login_data['user_name']);		
		$this->db->where('employee_password', $login_data['user_pass']);
		// $this->db->group_by('nid');
		// $this->db->order_by('land_owner_id','desc');
		// $this->db->limit(1);
		return $this->db->get()->row_array();
		
	}

	function update_data($table, $data, $condition){
		
		$this->db->where($condition);
		$this->db->update($table, $data);

		if($this->db->affected_rows() > 0 )
			return true;
		else
			return false;
	}

	function get_row_count($table, $where = null){
		
		if($where){
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($where);
			$query = $this->db->get();
		}
		else{
			$this->db->select('*');
			$this->db->from($table);
			$query = $this->db->get();
			}
		return $query->num_rows();
	
	}

	function get_unique_data($table, $column){
		$this->db->distinct($column);
		$this->db->select($column);
		$this->db->from($table);
		//$this->db->group_by($column);
		//return $this->db->get()->row_array();
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_flat_data($column=null, $table=null, $where=null){
		$this->db->select($column);
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by('land_owner_id','desc');
		$this->db->limit(1);
		//$this->db->group_by($column);
		//return $this->db->get()->row_array();
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_table_data($table=null,$where=null){
		$this->db->select('*');
		$this->db->from($table);
		if($where){$this->db->where($where);}
		// $this->db->order_by('land_owner_id','desc');
		// $this->db->limit(1);
		//$this->db->group_by($column);
		//return $this->db->get()->row_array();
		$query = $this->db->get();
		return $query->result_array();
	}

	function count_where($table, $where=null){
		if(!empty($where))
			$this->db->where($where);
		$this->db->from($table);
		return $this->db->count_all_results();
	
	}

	function get_name($table, $where=null, $rowname){
		if(!empty($where))
			$this->db->where($where);
		$this->db->from($table);
	    $this->db->limit(1);
		return $this->db->get()->row()->$rowname;	
	}
        
        function get_primary_document(){
            
            $primarydoc='SELECT `document_name` FROM `document_list` WHERE `request_type_group_id`=1'; 
            $result=$this->db->query($primarydoc);
            
            return $result->result();
            
        }
        
        
        function get_important_document(){
            
            $importantdoc='SELECT `document_name` FROM `document_list` WHERE `request_type_group_id`=2'; 
            $result=$this->db->query($importantdoc);
            
            return $result->result();
            
        }
       
        function insert_documnet($data=null){
             $summary = $this->upload->data();
             $this->db->insert();
        }
	
}