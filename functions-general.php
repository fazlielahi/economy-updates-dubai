<?php

	function redirect($url, $msg = "", $msgtype = "")
	{
		
		$_SESSION['msg'] = $msg;
		$_SESSION['msgtype'] = $msgtype;
		header("location:" . $url);
		
	}
	
	function show_msg()
	{
		if(isset($_SESSION['msg']))
		{
			echo "<span class='$_SESSION[msgtype]'>
			
				$_SESSION[msg]
			</span>
			"; 
		}
		unset($_SESSION['msg']);
		unset($_SESSION['msgtype']);
	}

?>

<style>
	
	.success{
		
		font-weight: 100;
		color: #00aa00;
		font-size: small;
		border-left: 1px solid #00aa00;
		padding-left: 5px;
		padding-bottom: 3px;
	}
	.error{
		
		font-weight: 100;
		color: #aa0000;
		font-size: small;
		border-left: 1px solid #00aa00;
		padding-left: 5px;
		padding-bottom: 3px;
	}
	
</style>