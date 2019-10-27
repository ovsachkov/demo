<?php
class Model
{
	public $db;
	
	function __construct()
	{
		$this->db = new mysqli("localhost", "root", "","tasks");
		if ($this->db->connect_error) {
		die("Connection failed: " . $this->db->connect_error);
		}
	}
	function __destruct()
	{
		$this->db->close();
	}
	
	
	public function get_data($order,$page,$direction)
	{
	}
	
	public function set_data($name,$email,$task)
	{
	}
	
	public function update_data($id,$name,$email,$task,$checked)
	{
	}
	
	public function delete_data($id)
	{
	}
	
	
	
	public function get_count()
	{
	}
}
?>