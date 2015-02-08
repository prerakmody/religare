<?php
    if(isset($_POST['hidden_edit'])){
        $name = $_POST['hidden_edit'];
        $ans = mysql_query("SELECT * FROM raw WHERE name=$name");
        echo "<form method='POST' action='index_edit.php'>";
        while($res = mysql_fetch_assoc($ans)){
            echo "<input type='text' name='name' value=".$res['name'].">";
            echo "<input type='text' name='proposal_num' value=".$res['proposal_num'].">";
            echo "<input type='text' name='payment_amount' value=".$res['payment_amount'].">";
            echo "<input type='text' name='GWP' value=".$res['GWP'].">";
            echo "<input type='text' name='login_date' value=".$res['login_date'].">";
            echo "<input type='text' name='proposal_status' value=".$res['proposal_status'].">";
            echo "<input type='text' name='insured_age' value=".$res['insured_age'].">";
            echo "<input type='text' name='policy_no' value=".$res['policy_no'].">";
            echo "<input type='text' name='policy_start_date' value=".$res['policy_start_date'].">";
            echo "<input type='text' name='no_of_lives' value=".$res['no_'].">";
            echo "<input type='text' name='business_type' value=".$res['business_type'].">";
            echo "<input type='text' name='plan' value=".$res['plan'].">";
            echo "<input type='text' name='policy_issuance_date' value=".$res['policy_issuance_date'].">";
            echo "<input type='text' name='Address' value=".$res['address'].">";
            echo "<input type='text' name='City' value=".$res['city'].">";
            echo "<input type='text' name='Pincode' value=".$res['pincode'].">";
            echo "<input type='text' name='Mobile' value=".$res['mobile'].">";
            echo "<input type='text' name='Cover type' value=".$res['cover_type'].">";
            echo "<input type='text' name='Client ID' value=".$res['client_ID'].">";
            echo "<input type='text' name='DOB' value=".$res['DOB'].">";
            echo "<input type='text' name='Landline' value=".$res['landline'].">";
            echo "<input type='text' name='Email ID' value=".$res['email'].">";
            echo "<input type='text' name='Claims' value=".$res['claims'].">";
            echo "<input type='text' name='Notes' value=".$res['notes'].">";
            echo "<input type='text' name='Renewal Due' value=".$res['renewal'].">";
            echo "<input type='submit' value='Edit'>";
        }
        echo "</form>"
    }
?>