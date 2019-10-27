<?php

class Controller_Portfolio extends Controller
{
	function __construct()
	{
		$this->model = new Model_Portfolio();
		$this->view = new View();
		$this->auth = new AuthClass();
	}
	
	function action_index()
	{
		If($this->auth->isAuth()) $data['admin']=$this->auth->getLogin();
		if(isset($_POST["name"])and($this->form_validation())) 
		{
			if(isset($_POST["insert"])) {$this->model->set_data($_POST["name"],$_POST["email"],$_POST["task"]);}
			if(isset($_POST["update"])and($this->auth->isAuth())) 
			{
				if(isset($_POST["checked"])) $v="1";else $v="0";
				$this->model->update_data($_POST["id"],$_POST["name"],$_POST["email"],$_POST["task"],$v);
			}
			if(isset($_POST["remove"])) $this->model->delete_data($_POST["id"]);
			
		}
		if(isset($_POST["pgnum"])) $pgn=$_POST["pgnum"];
		else $pgn=1;
		$srt="id";
		if (isset($_POST["sortby"])) $srt=substr($_POST["sortby"], 2);
		$data['sortby']="by".$srt;
		$ord="ASC";

		if (isset($_POST["order"])) $ord=strtoupper($_POST["order"]);
		$data['order']=strtolower($ord);
		$data['model'] = $this->model->get_data($srt,$pgn*3-3,$ord);
		$data['pages']=ceil($this->model->get_count()/3);
		$data['pageno']=$pgn;
		
		
		$this->view->generate('portfolio_view.php', 'template_view.php', $data);
	}
	
	function  form_validation()
	{
		if ($_POST["name"]=="") return false;
		if ($_POST["task"]=="") return false;
		if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))return false;
		return true;
	}
}
?>