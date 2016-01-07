<?php
include_once("accountData.php");
//  PHP 5 version
class account {

  private $id;
  private $name;
  private $email;

	public function __construct(){
		$this->id = ' ';
		$this->name = '';
		$this->email = '';
	}

	public function set_account($id = ' ', $name, $email){
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
	}

	public function get_name(){
		return $this->name;
	}

	public function get_email(){
		return $this->email;
	}

	public function print_account(){
		$returnSTR = "id: ".$this->id . "   ";
		$returnSTR .= "name: ".$this->name . "   ";
		$returnSTR .= "email: ".$this->email . "<br /> ";
		return $returnSTR;
	}
	
}
