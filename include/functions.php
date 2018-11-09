<?php

	function formatDate($date)
	{
		$string = explode("/",$date);

		$newdate = implode($string);

		if(strlen($newdate) == 8 && is_numeric($newdate))
		{
			return true;
		}
		
		return false;
	}

	function formatTelephone($telephone)
	{
		$result = "+ 33";
		$telephone = str_replace(" ", "", $telephone);
		$string = substr($telephone, 1);
		return $result."".$string;
	}

?>



