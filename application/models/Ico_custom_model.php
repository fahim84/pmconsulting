<?php
class Ico_custom_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function get($params = [], $count_result = false)
	{
		if(isset($params['select'])) { $this->db->select($params['select']); }
		if(isset($params['status'])) { $this->db->where('status',$params['status']); }

        if(isset($params['listing']) and $params['listing']=='ongoing')
        {
            $this->db->where('icoStart <=', date('Y-m-d H:i:s'));
            $this->db->where('icoEnd >=', date('Y-m-d H:i:s'));
        }
        if(isset($params['listing']) and $params['listing']=='upcoming')
        {
            $this->db->where('icoStart >=', date('Y-m-d H:i:s'));
        }

		if(isset($params['keyword']) and $params['keyword']!='')
		{
			$this->db->like('name', $params['keyword']);
		}
		
		# If true, count results and return it
		if($count_result)
		{
			$this->db->from('icos_custom');
			$count = $this->db->count_all_results();
			return $count;
		}
		
		if(isset($params['limit'])) { $this->db->limit($params['limit'], $params['offset']); }
		if(isset($params['order_by']))
		{
		    isset($params['direction']) ? $this->db->order_by($params['order_by'],$params['direction']) : $this->db->order_by($params['order_by']);
		}
		
		$query = $this->db->get('icos_custom');
		//my_var_dump($this->db->last_query());
		return $query;
		
	}
	
	public function insert($data)
	{
		if($this->db->insert('icos_custom', $data))
		{
            //my_var_dump($this->db->last_query());
			$id =  $this->db->insert_id();

            return $id;
		}
		return false;
	}

	public function update($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('icos_custom',$data);
		//my_var_dump($this->db->last_query());
	}
	
	public function delete($id)
	{
        $entity = self::get_ico_by_id($id);
        if($entity->image != '')
        {
            $upload_path = './uploads/icos/';
            delete_file($upload_path.$entity->image);
            $_SESSION['msg_error'][] = $entity->image.' file deleted!';
        }
        if($entity->video != '')
        {
            $upload_path = './uploads/icos/';
            delete_file($upload_path.$entity->video);
            $_SESSION['msg_error'][] = $entity->video.' file deleted!';
        }
		return $this->db->delete('icos_custom', ['id' => $id]);
	}

	public function get_ico_by_id($id)
	{
		$query = $this->db->get_where('icos_custom',['id'=>$id]);
        if($query->num_rows())
        {
            $row = $query->row();
            return $row;
        }
		return false;
	}

	public function ico_already_exists($name, $id=false)
	{
		if($id > 0) $this->db->where('id !=',$id);
		$query = $this->db->get_where('icos_custom',['name'=>$name]);
		return $query->num_rows() ? $query->row() : false;
	}
}


