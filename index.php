<html>
<head>
	<link rel="stylesheet" type="text/css" href="search.css">
	<link rel="stylesheet" type="text/css" href="jquery-ui.css">
	<!--<script src="autocomplete.js" type="text/javascript"></script>-->
	<script src="jquery2.js"></script>
	<script src="jquery-ui.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
		var lastVal = '';
		//TAKE NAME AS INPUT HERE OR SUBSCRIPT (3 CHARS) FOLLOWED BY 
		function autoComplete(val){
			//console.log('autocomplete:'+val);
			var request = new XMLHttpRequest();
			request.open('GET', 'autocomplete.php?query='+val, true);
			request.onload = function() {
			  if (request.status >= 200 && request.status < 400) {
			    var data = JSON.parse(request.responseText);
			    console.log('Data:'+data[0].name);
			    if (data.length >=1)
			    	show(data);
			    
			  } else {
			    console.log('Óopsey!')

			  }
			};
			request.onerror = function() {
		  // There was a connection error of some sort
			};
			request.send();
		}

		function show(data){
			var newData = '';
			for (var i=0;i<data.length;i++){
				newData += '<div class="unselected" id="'+data[i].name+','+data[i].proposal_no+'">' + data[i].name + ' || '+data[i].proposal_no +'</div>';
		    }
		    
		    repositionResultsDiv();
			$("#results").html(newData);
			$("#results").css("display","block");
			var divs = $("#results" + " > div");
		
			// on mouse over clean previous selected and set a new one
			divs.mouseover( function() {
				divs.each(function(){ this.className = "unselected"; });
				this.className = "selected";
			});
		
			// on click copy the result text to the search field and hide
			divs.click( function() {
				$("#content").html('');
				var idd = (this.id).split(",");
				console.log("ID:"+idd[0]+","+idd[1])
				$("#searchField").val(idd[0]);
				$("#hidden_proposal_no").val(idd[1]);
				clearAutoComplete();
			});
		}

		$("#searchField").keyup(function (e) {
			// get keyCode (window.event is for IE)
			
			var acDelay = 500
			var keyCode = e.keyCode || window.event.keyCode;
			lastVal = $("#searchField").val();
			//console.log(lastval);
			// check an treat up and down arrows
			// check for an ENTER or ESC
			if(keyCode == 13 || keyCode == 27){
				clearAutoComplete();
				return;
			}
			if($("#searchField").val() == '')
				clearAutoComplete();
			// if is text, call with delay
			if ($("#searchField").val().length >=4)
				setTimeout(function () {autoComplete($("#searchField").val())}, acDelay);
		});

		function clearAutoComplete()
		{
			$("#results").html('');
			$("#results").css("display","none");
		}

		function repositionResultsDiv()
		{
			// get the field position
			var acSearchField = $("#searchField");
			var acResultsDiv = $("#results");
			var sf_pos    = acSearchField.offset();
			var sf_top    = sf_pos.top;
			var sf_left   = sf_pos.left;

			// get the field size
			var sf_height = acSearchField.height();
			var sf_width  = acSearchField.width();
			// console.log('Width:'+sf_width);
			// apply the css styles - optimized for Firefox
			acResultsDiv.css("position","absolute");
			acResultsDiv.css("left", sf_left - 2);
			acResultsDiv.css("top", sf_top + sf_height + 5);
			acResultsDiv.css("width", sf_width - 2);
		}		
	});
	
	$(function() {
    	$( "#date" ).datepicker(
    		 { dateFormat: "yy-mm-dd" }
    	);
    	$( "#date0" ).datepicker(
    		 { dateFormat: "yy-mm-dd" }
    	);
    	$( "#date1" ).datepicker(
    		 { dateFormat: "yy-mm-dd" }
    	);
    	$( "#date2" ).datepicker(
    		 { dateFormat: "yy-mm-dd" }
    	);
    	$( "#date3" ).datepicker(
    		 { dateFormat: "yy-mm-dd" }
    	);
    	$( "#date4" ).datepicker(
    		 { dateFormat: "yy-mm-dd" }
    	);
  	});
	function edit_function(){
		//alert('Warning!You are not wditing the data!');
		document.getElementById("content_show").style.display = "none";
		document.getElementById("content_edit").style.display = "block";
		//$( "#date" ).datepicker();
	}
	
	</script>
</head>

<body>
	<div id="autocomplete">
		<H4>SEARCH BY NAME</H4>
		<form action="index.php" method="POST">
		<input autocomplete="off" id="searchField" maxlength="15" name="searchField" type="text" style="width:50%;padding:3px;margin:0 auto;"/>
		<input type="hidden" name="hidden_proposal_no" id="hidden_proposal_no" value="">
		<input type="submit" value="Search">
		</form>
	</div>
	<div id="results"></div>
	<div id='content'>
			<?php
			if (@$_POST['hidden_proposal_no'] || @$_GET['proposal_no'])
			{
				require ('config.php');
				$hidden_proposal_no;
				if (isset($_POST['hidden_proposal_no']))
					$hidden_proposal_no = $_POST['hidden_proposal_no'];
				if(isset($_GET['proposal_no'])){
					$hidden_proposal_no = $_GET['proposal_no'];
					//alert('Successful Edit!');
				}
					
				$ans = mysql_query("SELECT * FROM raw WHERE proposal_no = $hidden_proposal_no ") or die(mysql_error());
				$ans1 = $ans;
				echo "<div id='content_show'>";
					echo "<input type='button' name = 'edit_button' value='Edit' onclick='edit_function()'><br/>";
					while($res = mysql_fetch_assoc($ans))
					{
						if(mysql_num_rows($ans) == 1){
						echo "Name:".$res['name']."<br/>";
						echo "Proposal Num:".$res['proposal_no']."<br/>";
						echo "Payment Amout:".$res['payment_amount']."<br/>";
						echo "GWP:".$res['GWP']."<br/>";
						echo "Login Date:".$res['login_date']."<br/>";
						echo "Policy Start Date:".$res['policy_start_date']."<br/>";
						echo "Policy Issuance Date:".$res['policy_issuance_date']."<br/>";
						echo "Policy End Date:".$res['policy_end_date']."<br/>";
						echo "DOB:".$res['DOB']."<br/>";
						echo "Proposal Status:".$res['proposal_status']."<br/>";
						echo "Insured Age:".$res['insured_age']."<br/>";
						echo "Policy No:".$res['policy_no']."<br/>";						
						echo "No.Of Lives:".$res['no_of_lives']."<br/>";
						echo "Business Type:".$res['business_type']."<br/>";
						echo "Plan:".$res['plan']."<br/>";
						echo "Sum Insured:".$res['sum_insured']."<br/>";
						echo "Cover Type:".$res['cover_type']."<br/>";
						echo "Address:".$res['address']."<br/>";
						echo "Pincode:".$res['pincode']."<br/>";
						echo "Mobile:".$res['mobile']."<br/>";
						echo "Client ID:".$res['client_id']."<br/>";
						echo "Landline:".$res['landline']."<br/>";
						echo "Email ID:".$res['email']."<br/>";
						echo "Claims:".$res['claims']."<br/>";
						echo "Notes:".$res['notes']."<br/>";
						echo "Renewal Due:".$res['renewal']."<br/>";
						}
					}
					
				echo "</div>";

				echo "<div id='content_edit' style='display:none;'>";
				$ans = mysql_query("SELECT * FROM raw WHERE proposal_no = $hidden_proposal_no ") or die(mysql_error());
					echo "<form method='POST' action='index_edit.php'>";
			        while($res = mysql_fetch_assoc($ans))
			        {
			            echo "Name:<input type='text' name='name' value='".$res['name']."'><br/>";
			            echo "Proposal No:<input type='text' name='proposal_num' value='".$res['proposal_no']."'><br/>";
			            echo "Payment Amount:<input type='text' name='payment_amount' value=".$res['payment_amount']."><br/>";
			            echo "GWP:<input type='text' name='GWP' value=".$res['GWP']."><br/>";
			           
			            echo "Proposal Status:<input type='text' name='proposal_status' value=".$res['proposal_status']."><br/>";
			            echo "Insured Age:<input type='text' name='insured_age' value=".$res['insured_age']."><br/>";
			            echo "Policy Num:<input type='text' name='policy_no' value=".$res['policy_no']."><br/>";
			            echo "Login Date:<input type='text' id='date' name='login_date' value=".$res['login_date']."><br/>";
			            echo "Poliy Start Date:<input type='text' id='date0' name='policy_start_date' value=".$res['policy_start_date']."><br/>";
			            echo "Policy End Date:<input type='text' id='date1' name='policy_end_date' value=".$res['policy_end_date']."><br/>";
			            echo "Policy Issuance Date:<input type='text' id='date2' name='policy_issuance_date' value=".$res['policy_issuance_date']."><br/>";
			            echo "DOB: <input type='text' id='date3' name='DOB' value=".$res['DOB']."><br/>";
			            echo "No of Lives:<input type='text' name='no_of_lives' value=".$res['no_of_lives']."><br/>";
			            echo "Business Type:<input type='text' name='business_type' value=".$res['business_type']."><br/>";
			            echo "Plan:<input type='text' name='plan' value=".$res['plan']."><br/>";
			            echo "Sum Insured:<input type='text' name='sum_insured' value=".$res['sum_insured']."><br/>";
			            echo "Cover Type:<input type='text' name='cover_type' value=".$res['cover_type']."><br/>";
			            echo "Address:<input type='text' name='address' value=".$res['address']."><br/>";
			            echo "Pincode:<input type='text' name='pincode' value=".$res['pincode']."><br/>";
			            echo "Mobile:<input type='text' name='mobile' value=".$res['mobile']."><br/>";
			            echo "Cover Type:<input type='text' name='cover_type' value=".$res['cover_type']."><br/>";
			            echo "Client ID:<input type='text' name='client_id' value=".$res['client_id']."><br/>";			            
			            echo "Landline:<input type='text' name='landline' value=".$res['landline']."><br/>";
			            echo "Email:<input type='text' name='email' value=".$res['email']."><br/>";
			            echo "Claims:<input type='text' name='claims' value=".$res['claims']."><br/>";
			            echo "Notes:<input type='text' name='notes' value=".$res['notes']."><br/>";
			            echo "Renewal:<input type='text' id='date4' name='renewal' value=".$res['renewal']."><br/>";
			            echo "<input type='hidden' name='hidden_edit_srno' value=".$res['srno']."><br/>";
			            echo "<input type='submit' value='Submit'>";
			        }
			        echo "</form>";
				echo "</div>";
			}
			?></div>

	<div id="testing"></div>

	</div>
	<br/>
	<br/>
	<!--<a href="upload_csv.html">UPLOAD DATA</a>-->
</body>
</html>