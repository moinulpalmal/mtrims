<?php
namespace App\CRUD;
use DB;
class Update{
	public function update($table_name,$table_ID,$ID_value,$ColumnToBeUpdate,$textfield_value)
	{
		DB::table($table_name)
		->where($table_ID, $ID_value)
		->update([$ColumnToBeUpdate => $textfield_value]);
		return;
		
	}
}