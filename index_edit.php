<?php
$proposal_no='';
echo "Srno:".$_POST['hidden_edit_srno']."<br/>";
    if(isset($_POST['hidden_edit_srno']))
    {
        require 'config.php';
        $srno = $_POST['hidden_edit_srno'];
        $name = $_POST['name'];
        $proposal_no = $_POST['proposal_num'];
        $payment_amount = $_POST['payment_amount'];
        $GWP = $_POST['GWP'];
        $login_date = $_POST['login_date'];
        $proposal_status = $_POST['proposal_status'];
        $insured_age = $_POST['insured_age'];
        $policy_no = $_POST['policy_no'];
        $policy_start_date = $_POST['policy_start_date'];
        $no_of_lives = $_POST['no_of_lives'];
        $business_type = $_POST['business_type'];
        $plan = $_POST['plan'];
        $policy_issuance_date = $_POST['policy_issuance_date'];
        $policy_end_date = $_POST['policy_end_date'];
        $address = $_POST['address'];
        $pincode = $_POST['pincode'];
        $mobile = $_POST['mobile'];
        $cover_type = $_POST['cover_type'];
        $client_id = $_POST['client_id'];
        $DOB = $_POST['DOB'];
        $landline = $_POST['landline'];
        $email = $_POST['email'];
        $claims = $_POST['claims'];
        $notes = $_POST['notes'];
        $renewal = $_POST['renewal'];
        $query = "UPDATE raw SET name='$name',proposal_no='$proposal_no',payment_amount=$payment_amount,GWP=$GWP,login_date='$login_date',
                                proposal_status='$proposal_status',insured_age=$insured_age,policy_no=$policy_no,policy_start_date='$policy_start_date',
                                policy_end_date='$policy_end_date',no_of_lives=$no_of_lives,business_type='$business_type',plan='$plan',policy_issuance_date='$policy_issuance_date',address='$address',
                                pincode=$pincode,mobile=$mobile,cover_type='$cover_type',client_id=$client_id,DOB='$DOB',landline=$landline,email='$email',
                                claims='$claims',notes='$notes',renewal='$renewal'
                    WHERE srno = $srno";
        mysql_query($query) or die(mysql_error());
        header('location:index.php?proposal_no="'.$proposal_no.'"');
    }
   
?>