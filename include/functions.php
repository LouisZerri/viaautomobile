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
?>



