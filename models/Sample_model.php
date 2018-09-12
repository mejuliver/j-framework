<?php namespace jframework\Models;
use \MysqliDb as sqldb;

Class Sample_model extends model{

	function test(){

		return 'test model result';
		
	}
	function testusers(){
		$sql = new sqldb('localhost', 'root', '', 'reviluj_store_db');
		$users = $sql->get('users');

		return $users;
	}
}