<?php
require 'config.php';
$temp = $_GET['query'];
if(isset($temp) and $temp != '')
{
	$colon = $temp[3];
	if($colon == ":"){
		$signature = substr($temp,0,3);
		$content = substr($temp,4);
		//echo $signature.":".$content;
		if($signature == "pro"){ //PROPOSAL NO
			$type = "proposal_no";
			$query = "SELECT * FROM raw WHERE proposal_no LIKE '%".mysql_real_escape_string($content)."%' ";
		}
		if($signature == "pay"){ //PAYMENT AMOUNT
			$type = "payment_amount";
			$content = (int)$content;
			$query = "SELECT * FROM raw WHERE payment_amount=$content";
		}
		if($signature == "gwp"){ //GWP
			$type = "GWP";
			$content = (int)$content;	
			$query = "SELECT * FROM raw WHERE GWP=$content";
		}
		if($signature == "pol"){ //POLICY NUM
			echo 'This is policy';
			$type = "policy_no";
			$query = "SELECT * FROM raw WHERE policy_no LIKE '%".mysql_real_escape_string($content)."%' ";
		}
		if($signature == "add"){ //ADDRESS
			$type = "address";
			$query = "SELECT * FROM raw WHERE address LIKE '%".mysql_real_escape_string($content)."%' ";
		}
		if($signature == "mob"){ //MOB
			$type = "mobile";
			$query = "SELECT * FROM raw WHERE mobile LIKE '%".mysql_real_escape_string($content)."%' ";
		}
		if($signature == "ema"){ //EMAIL
			$type = "email";
			$query = "SELECT * FROM raw WHERE email LIKE '%".mysql_real_escape_string($content)."%' ";
		}
		if($signature == "not"){ //NOTES
			$type = "notes";
			$query = "SELECT * FROM raw WHERE notes LIKE '%".mysql_real_escape_string($content)."%' ";
		}
		if($signature == "log"){ //NOTES
			$type = "login";
			if($content == "jan" )
			if($content == "feb" )
			if($content == "mar" )
			if($content == "apr" )
			if($content == "jan" )
			if($content == "jan" )
			if($content == "jan" )
			if($content == "jan" )
			if($content == "jan" )
			if($content == "jan" )
			if($content == "jan" )
			if($content == "jan" )
			$query = "SELECT * FROM raw WHERE login_date LIKE '%".mysql_real_escape_string($content)."%' ";
		}
	}
	
	else if (ord($temp[3]) >=48 && ord($temp[3]) <=57 ){
		//echo "This is proposal_no";
		$type = "proposal_no";
		$query = "SELECT * FROM raw WHERE proposal_no LIKE '%".mysql_real_escape_string($temp)."%' ";
	}
	else{
		//echo "This is just name";
		$type = "name";
		$query = "SELECT * FROM raw WHERE name LIKE '%".mysql_real_escape_string($temp)."%' ";
	}
	$results = array();
	
	$ans = mysql_query($query) or die(mysql_error());
	$count = 0;
	$type;
	if(mysql_num_rows($ans))
	{
		while($res = mysql_fetch_assoc($ans))
		{
			$srno = $res['srno'];
			$name = $res['name'];
			$proposal_no = $res['proposal_no'];
			$results[$count] = array('srno' => $srno, 'name' => $name, 'proposal_no' => $proposal_no, 'type'=>$type);
			$count +=1;
		}
	}
	// return the array as json with PHP 5.2
	echo json_encode($results);
}



