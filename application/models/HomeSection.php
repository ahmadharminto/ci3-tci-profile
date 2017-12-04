<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeSection extends CI_model
{
    public function get_all($limit=0, $start=0, $order_by=array())
	{
		$this->db->select('home_section.*');
	
		if ($limit>0) $this->db->limit($start, $limit);
		
		if (!empty($order_by)) {
			foreach ($order_by as $key=>$value) $this->db->order_by($key,$value);
        }
        
		$this->db->where('home_section.deleted_at IS NULL', NULL, FALSE);
		
		return $this->db->get('home_section');
	}

	public function save($set_array=array())
	{
		$this->db->set($set_array);
		$this->db->insert('home_section');
		return $this->db->insert_id();
	}

	public function update($set_array=array(), $where_array=array())
	{
		$this->db->set($set_array);
		$this->db->where($where_array);
		$this->db->update('home_section');
	}
}