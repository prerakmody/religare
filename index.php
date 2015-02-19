<html>
<head>
	<link rel="stylesheet" type="text/css" href="search.css">
	<link rel="stylesheet" type="text/css" href="jquery-ui.css">
	<link rel="stylesheet" href="foundation-5.5.1/css/foundation.css" />
	<!--<script src="autocomplete.js" type="text/javascript"></script>-->
	<script src="foundation-5.5.1/js/vendor/modernizr.js"></script>
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

		function show(data)
		{
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
		
		$('body').click(function() {
   			clearAutoComplete();
		});
		$("#searchField").keyup(function (e) {
			// get keyCode (window.event is for IE)
			
			var acDelay = 500
			var keyCode = e.keyCode || window.event.keyCode;
			lastVal = $("#searchField").val();
			if($("#searchField").val()){
				$("#content").css('-webkit-filter', 'blur(1px)');
				$("#content").css('-moz-filter', 'blur(1px)');
				$("#content").css('-o-filter', 'blur(1px)');
				$("#content").css('-ms-filter', 'blur(1px)');
				$("#content").css('filter', 'blur(1px)');
				$("#content").css('opacity', '0.5');
			}
			else{
				clearAutoComplete();
			}
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
			if ($("#searchField").val().length >=2)
				setTimeout(function () {autoComplete($("#searchField").val())}, acDelay);
		});

		function clearAutoComplete()
		{
			$("#results").html('');
			$("#results").css("display","none");
			$("#content").css('-webkit-filter', 'blur(0px)');
			$("#content").css('-moz-filter', 'blur(0px)');
			$("#content").css('-o-filter', 'blur(0px)');
			$("#content").css('-ms-filter', 'blur(0px)');
			$("#content").css('filter', 'blur(0px)');
			$("#content").css('opacity', '1');
		}
		
		function removeBlur(){
			$("#body *").css('-webkit-filter', 'blur(0px)');
			$("#body *").css('-moz-filter', 'blur(0px)');
			$("#body *").css('-o-filter', 'blur(0px)');
			$("#body *").css('-ms-filter', 'blur(0px)');
			$("#body *").css('filter', 'blur(0px)');
			$("#body *").css('opacity', '1');
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
		
		$("#upload").click(function(){
				clearAutoComplete();
				removeBlur();
				// $("body >*").not('#dialog').css('-webkit-filter', 'blur(1px)');
				// $("body >*").not('#dialog').css('-moz-filter', 'blur(1px)');
				// $("body  >*").not('#dialog').css('-o-filter', 'blur(1px)');
				// $("body  >*").not('#dialog').css('-ms-filter', 'blur(1px)');
				// $("body  >*").not('#dialog').css('filter', 'blur(1px)');
				// $("body  >*").not('#dialog').css('opacity', '0.5');
		  	 	 $(function() {
		    		$( "#dialog" ).dialog({
						    beforeClose: function(event,ui){removeBlur();}
					});
		  		});
		 });
	});
	
	
	$(function() {
    	$( "#date" ).datepicker(
    		 { changeMonth: true,
      		changeYear: true,
      		dateFormat: "yy-mm-dd",
    		 yearRange: "-80:+0"}
    	);
    	$( "#date0" ).datepicker(
    		 { changeMonth: true,
      		changeYear: true,
      		dateFormat: "yy-mm-dd",
    		 yearRange: "-20:+0" }
    	);
    	$( "#date1" ).datepicker(
    		 { changeMonth: true,
      		changeYear: true,
      		dateFormat: "yy-mm-dd",
    		 yearRange: "-80:+0"}
    	);
    	$( "#date2" ).datepicker(
    		 { changeMonth: true,
      		changeYear: true,
      		dateFormat: "yy-mm-dd",
    		 yearRange: "-80:+0"}
    	);
    	$( "#date3" ).datepicker(
    		 { changeMonth: true,
      		changeYear: true,
      		dateFormat: "yy-mm-dd",
    		 yearRange: "-80:+0"}
    	);
    	$( "#date4" ).datepicker(
    		 { changeMonth: true,
      		changeYear: true,
      		dateFormat: "yy-mm-dd",
    		 yearRange: "-80:+0"}
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
	<div class="row">
      <div class="large-12 columns">
      	<div class="panel">
      		<div class="row">
	        <div class="large-8 medium-8 columns"><h3>RELIGARE INSURANCE DETAILS MANAGER</h3></div>
	        <div class="large-4 medium-4 columns"><a href="#" id="upload" class="small radius button" style="float:right;">Upload Data</a></div>
	     	</div>
	     </div>
	  </div>
	</div>
	
	<div class="row">
	    <div class="large-12 columns">
	      <div id="autocomplete">
			<form action="index.php" method="POST">
				<input type="hidden" name="hidden_proposal_no" id="hidden_proposal_no" value="">
				<div style="margin:0 auto;">
					<div class="large-3 medium-3 columns">
				        <select>
				          <option value="pay">Payment Amount</option>
				          <option value="GWP">GWP</option>
				          <option value="pol">Policy</option>
				          <option value="add">Address</option>
				        </select>
				    </div>
					<div class="large-7 medium-7 columns">
						<input style="padding:3px;width:100%" placeholder="Default search via name or proposal no..." autocomplete="off" id="searchField" maxlength="15" name="searchField" type="text" />
					</div>
					<div class="large-2 medium-2 columns">
						<input style="width:100%" class="button small left" type="submit" value="Search" />
					</div>
				</div>
			</form>
			</div>
	    </div>
  	</div>
	<div id="results" style="z-index:1000;"></div>
	<div class="row"><hr></div>
	
	<div id='content' style="">
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
				echo "<div class='row'>";
				echo "<div id='content_show'>";
					
					while($res = mysql_fetch_assoc($ans))
					{
						if(mysql_num_rows($ans) == 1){
							echo "<div class='large-6 medium-6 columns'>";
							echo "<div class='panel'>";
							echo "<table>";
						echo "<tr><td>Name:</td><td>".$res['name']."</td></tr><br/>";
						echo "<tr><td>Proposal Num</td><td>:".$res['proposal_no']."</td></tr><br/>";
						echo "<tr><td>Payment Amount</td><td>:".$res['payment_amount']."</td></tr><br/>";
						echo "<tr><td>GWP:</td><td>".$res['GWP']."</td></tr><br/>";
						echo "<tr><td>Login Date:</td><td>".$res['login_date']."</td></tr><br/>";
						echo "Policy Start Date:".$res['policy_start_date']."<br/>";
						echo "Policy Issuance Date:".$res['policy_issuance_date']."<br/>";
						echo "Policy End Date:".$res['policy_end_date']."<br/>";
						echo "DOB:".$res['DOB']."<br/>";
						echo "Proposal Status:".$res['proposal_status']."<br/>";
						echo "Insured Age:".$res['insured_age']."<br/>";
						echo "Policy No:".$res['policy_no']."<br/>";						
						echo "No.Of Lives:".$res['no_of_lives']."<br/>";
							echo "</table>";
							echo "</div></div>";
							echo "<div class='large-6 medium-6 columns'>";
							echo "<div class='panel'>";
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
							echo "</div></div>";
						}
					}
					echo "<div class='large-4 medium-4 columns' style='margin:0 auto;'>";
					echo "<input type='button' class='button small left' name = 'edit_button' value='Edit' onclick='edit_function()'><br/>";
					echo "</div>";
				echo "</div></div>";
				
				echo "<div id='content_edit' style='display:none;'>";
				$ans = mysql_query("SELECT * FROM raw WHERE proposal_no = $hidden_proposal_no ") or die(mysql_error());
					echo "<form method='POST' action='index_edit.php'>";
			        while($res = mysql_fetch_assoc($ans))
			        {
			        		echo "<div class='large-6 medium-6 columns'>";
							echo "<div class='panel'>";
			            echo "Name:<input type='text' name='name' value='".$res['name']."'>";
			            echo "Proposal No:<input type='text' name='proposal_num' value='".$res['proposal_no']."'>";
			            echo "Payment Amount:<input type='text' name='payment_amount' value=".$res['payment_amount'].">";
			            echo "GWP:<input type='text' name='GWP' value=".$res['GWP'].">";
			            echo "Proposal Status:<input type='text' name='proposal_status' value=".$res['proposal_status'].">";
			            echo "Insured Age:<input type='text' name='insured_age' value=".$res['insured_age'].">";
			            echo "Policy Num:<input type='text' name='policy_no' value=".$res['policy_no'].">";
			            echo "Login Date:<input type='text' id='date' name='login_date' value=".$res['login_date'].">";
			            echo "Poliy Start Date:<input type='text' id='date0' name='policy_start_date' value=".$res['policy_start_date'].">";
			            echo "Policy End Date:<input type='text' id='date1' name='policy_end_date' value=".$res['policy_end_date'].">";
			            echo "Policy Issuance Date:<input type='text' id='date2' name='policy_issuance_date' value=".$res['policy_issuance_date'].">";
			            echo "DOB: <input type='text' id='date3' name='DOB' value=".$res['DOB'].">";
			            echo "No of Lives:<input type='text' name='no_of_lives' value=".$res['no_of_lives'].">";
			            	echo "</div></div>";
							echo "<div class='large-6 medium-6 columns'>";
							echo "<div class='panel'>";
			            echo "Business Type:<input type='text' name='business_type' value=".$res['business_type'].">";
			            echo "Plan:<input type='text' name='plan' value=".$res['plan'].">";
			            echo "Sum Insured:<input type='text' name='sum_insured' value=".$res['sum_insured'].">";
			            echo "Cover Type:<input type='text' name='cover_type' value=".$res['cover_type'].">";
			            echo "Address:<input type='text' name='address' value=".$res['address'].">";
			            echo "Pincode:<input type='text' name='pincode' value=".$res['pincode'].">";
			            echo "Mobile:<input type='text' name='mobile' value=".$res['mobile'].">";
			            echo "Cover Type:<input type='text' name='cover_type' value=".$res['cover_type'].">";
			            echo "Client ID:<input type='text' name='client_id' value=".$res['client_id'].">";			            
			            echo "Landline:<input type='text' name='landline' value=".$res['landline'].">";
			            echo "Email:<input type='text' name='email' value=".$res['email'].">";
			            echo "Claims:<input type='text' name='claims' value=".$res['claims'].">";
			            echo "Notes:<input type='text' name='notes' value=".$res['notes'].">";
			            echo "Renewal:<input type='text' id='date4' name='renewal' value=".$res['renewal'].">";
							echo "</div></div>";
			            echo "<input type='hidden' name='hidden_edit_srno' value=".$res['srno'].">";
			            echo "<input type='submit' class='button small left' value='Submit'>";
			        }
			        echo "</form>";
				echo "</div>";
			}
			?></div>

	<div id="dialog" title="Upload Data in CSV format" style='display:none;'>
	<form method="POST" action="upload_csv.php">
		File : <input type="file" name="csv_file">
		<input type="submit" value="Upload Data"> 
	</form>
	</div>
	
</body>
</html>