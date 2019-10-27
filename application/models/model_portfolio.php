<?php
class Model_Portfolio extends Model
{
	
	public function get_data($order,$page,$direction)
	{	
		
		$sql = "SELECT * FROM tasklist ORDER BY ".$order." ".$direction." LIMIT ".$page.",3";
		return $this->db->query($sql);
	}
	public function get_count()
	{
		$total_pages_sql = "SELECT COUNT(*) FROM tasklist";
		$result=$this->db->query($total_pages_sql);
		return mysqli_fetch_array($result)[0];
	}
	
	public function set_data($name,$email,$task)
	{
		$sql = "INSERT INTO tasklist (id,name,email,task,checked,viewed) VALUES (NULL, '".$name."', '".$email."', '".htmlspecialchars($task, ENT_QUOTES)."', '0', '0' )";
		$this->db->query($sql);
	}
	
	public function update_data($id,$name,$email,$task,$checked)
	{
		$sql = "UPDATE tasklist SET name='".$name."' , email='".$email."' , task='".htmlspecialchars($task, ENT_QUOTES)."' , checked='".$checked."' , viewed='1' WHERE id=".$id;
		$this->db->query($sql);
	}
	
	public function delete_data($id)
	{
		$sql = "DELETE FROM tasklist WHERE id=".$id;
		$this->db->query($sql);
	}
}
?>