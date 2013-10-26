<?PHP
###################################
#  XFUN  產品類別庫  2008-06-26   #
#								  #
###################################

class XFUN_product 
{
	var $Classname = "XFUN_product";
	var $ClassTitle = "";
	var $ClassActTitle = "";
	var $DB_Table = "";
	var $DB_Field = "";
	var $DB_Values = "";
	var $DB_updValues = "";
	var $DB_delValues = "";
	
	/**************************************************************************
	** name: insert()
	** created by: xfun
	** description: 新增資料
	** parameters:$DB_Table , $DB_Field , $DB_Values
	** returns:true
	***************************************************************************/
	function insert() 
	{
		$CLASS["db"] = new xfunDB_sql;
		$CLASS["db"]->connect(); 
	
		$q= "INSERT INTO ".$this->DB_Table." (".$this->DB_Field.") ";
		$q .= "VALUES (".$this->DB_Values.")";
	
		$CLASS["db"]->query($q);
		$CLASS["db"]->free_result($CLASS["db"]->result);
		$this->ClassActTitle = "新增";
		//$this->message("新增");
		return true;
	}
	/**************************************************************************
	** name: update()
	** created by: xfun
	** description: 更新資料
	** parameters:$DB_Table , $DB_Values
	** returns:true
	***************************************************************************/
	function update() 
	{
		$CLASS["db"] = new xfunDB_sql;
		$CLASS["db"]->connect(); 
	
		$q= "UPDATE ".$this->DB_Table." SET ".$this->DB_updValues;
	
		$CLASS["db"]->query($q);
		$CLASS["db"]->free_result($CLASS["db"]->result);
		$this->ClassActTitle = "更新";
		//$this->message("更新");
		return true;
	}
	/**************************************************************************
	** name: delete()
	** created by: xfun
	** description: 刪除資料
	** parameters:$DB_Table , $DB_Values
	** returns:true
	***************************************************************************/
	function delete() 
	{
		$CLASS["db"] = new xfunDB_sql;
		$CLASS["db"]->connect(); 
	
		$q= "DELETE FROM ".$this->DB_Table;
		$q .= "WHERE ".$this->DB_delValues;
	
		$CLASS["db"]->query($q);
		$CLASS["db"]->free_result($CLASS["db"]->result);
		$this->ClassActTitle = "刪除";
		//$this->message("刪除");
		return true;
	}
	/**************************************************************************
	** name: message()
	** created by: xfun
	** description: 返回執行後的訊息
	** parameters:$msg 
	** returns:訊息資料
	***************************************************************************/
	function message($msg) 
	{
		$this->ClassActTitle=$msg;
	}
	/**************************************************************************
	** name: ActDataAccess()
	** created by: xfun
	** description: 判斷執行新增、刪除、修改的動作
	** parameters:$act
	** returns:true
	***************************************************************************/
	function ActDataAccess($act)
	{
		switch($act)
		{
		case "insert":
		$process = $this->insert();
		break;
		case "update":
		$process = $this->update();
		break;
		case "delete":
		$process = $this->delete();
		break;
		}
		return $process;
	}
}
?>
