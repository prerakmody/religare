<?php
$auto = $_POST[]
if(isset($auto))
{
    if($auto[3] == ":"){
        $code = substr($auto,0,4)
        $search = substr($auto,4)
        if($code == "pro")
            $query = "SELECT * FROM raw WHERE proposal_no = $search";
        if($code == "")
    }
    
}
?>