<?php
require 'config.php';
ini_set('auto_detect_line_endings',true);
if(isset($_POST['csv_file'])){
	$file_handle = fopen(trim($_POST['csv_file']), 'r');
	//print_r(fgetcsv($file_handle));
	//$file_handle = fopen("data.csv", "r");
	echo 'File is set<br/>';
}
$final = '';
$i = 0;
while (!feof($file_handle)) {
	$line_of_text = fgetcsv($file_handle,4096,',');
	//print_r($line_of_text);
	if($line_of_text == ''){
		print 'Empty';
		file_put_contents("log_file", date("Y-m-d:H-i-s").','.($i-1), FILE_APPEND | LOCK_EX);
		header("location:index.php");
	}
		
	print '<br/>';
	//echo 'Line:'.$line_of_text.'<br/>';
	if($i >= 2){
		$proposal_no = $line_of_text[0];
		$ans = mysql_query("SELECT * FROM raw WHERE proposal_no = $proposal_no");
		echo mysql_num_rows($ans);
		if(!mysql_num_rows($ans)){
			echo 'New:'.$i.'<br/>';
			$name = $line_of_text[1];
			echo 'Name:'.$name.'<br/>';
			$payment_amount = $line_of_text[2];
			$GWP = $line_of_text[3];
			$login_date = date("Y-m-d",strtotime($line_of_text[4]));
			$proposal_status = $line_of_text[5];
			$policy_no = $line_of_text[7];
			$policy_start_date = date("Y-m-d",strtotime($line_of_text[8]));
			$no_of_lives = $line_of_text[9];
			$business_type = $line_of_text[10];
			$plan = $line_of_text[11];
			$policy_issuance_date = date("Y-m-d",strtotime($line_of_text[14]));
			if ($policy_issuance_date == '')
				$policy_issuance_date = 0;
			$sum_insured = preg_replace('/Lacs/', '', str_replace(' ', '', $line_of_text[15]));
			$sum_insured = (int)$sum_insured;
			if ($sum_insured  == 0)
				$sum_insured = -1;
			//echo $sum_insured;
			$cover_type = $line_of_text[16];
			
			$policy_end_date = date("Y-m-d",strtotime($line_of_text[25]));
			
			$query = "INSERT INTO raw(proposal_no,name,payment_amount,GWP,login_date,proposal_status,policy_no,policy_start_date,no_of_lives,business_type,plan,
					policy_issuance_date,sum_insured,cover_type,policy_end_date) 
				VALUES('$proposal_no','$name',$payment_amount,$GWP,$login_date,'$proposal_status','$policy_no',$policy_start_date,$no_of_lives,'$business_type','$plan',
					$policy_issuance_date,$sum_insured,'$cover_type',$policy_end_date)";
			try{
				$final = mysql_query($query) or die(mysql_error());	
			}
			catch(Excepion $e){
				if ($final == false){
					echo 'Log File';
					file_put_contents("log_file", $e->getMessage()."\n", FILE_APPEND | LOCK_EX);
					header("location:index.php");
				}
			}
		}
	}
	$i++;
}

//fclose($file_handle);
header("location:index.php");
//$eldest_insured_age = $line_of_text[6];
//$eldest_insured_member_age = $line_of_text[17];
// $bank_unique_ID1 = $line_of_text[12];
// if ($bank_unique_ID1 == '')
// 	$bank_unique_ID1 = 0;
// $bank_unique_ID2 = $line_of_text[13];
// if ($bank_unique_ID2 == '')
// 	$bank_unique_ID2 = 0;
// $RHICL_branch_name = $line_of_text[18];
// $partner_RM_Code = $line_of_text[19];
// $partner_branch_code = $line_of_text[20];
// $mode_of_payment = $line_of_text[21];
// $bank_name = $line_of_text[22];
// $instrument_no = $line_of_text[23];
// $instrument_date = strtotime($line_of_text[24]);
// $product_Id = $line_of_text[26];
// $passport_number = $line_of_text[27];
// $geographical_location = $line_of_text[28];
// $autorenewal = $line_of_text[29];
// $intermediary_code = $line_of_text[30];
?>

