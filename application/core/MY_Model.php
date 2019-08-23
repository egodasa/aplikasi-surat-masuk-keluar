<?php
use Medoo\Medoo;

class MY_Model extends CI_Model {
	protected $db;
  function __construct()
  {
    parent::__construct();
    $this->db = new Medoo([
      'database_type' => 'mysql',
      'database_name' => 'mandanon_disbud',
      'server' => 'localhost',
      'username' => 'mandanon_disbud',
      'password' => 'qwe123*IOP'
    ]);
  }
}
