<html>
<head>
	<link rel="stylesheet" type="text/css" href="search.css">
	<!--<script src="autocomplete.js" type="text/javascript"></script>-->
	<script src="jquery.js"></script>
	<script type="text/javascript">
$(document).ready(function () {
	//var acSearchField = $("#searchField");
	var lastVal = '';
	function autoComplete(val){
		//console.log('autocomplete:'+val);
		var request = new XMLHttpRequest();
		request.open('GET', 'autocomplete.php?name='+val, true);
		request.onload = function() {
		  if (request.status >= 200 && request.status < 400) {
		    var data = JSON.parse(request.responseText);
		    //console.log('Data:'+data.length);
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
	    	//console.log(data[i].name + '-' + data[i].proposal_no);
	    	//if (data[i].type == "proposal_no")
	    		newData += '<div class="unselected">' + data[i].name + ''+data[i].proposal_no +'</div>';
	    }
	    
	    repositionResultsDiv();
		$("#results").html(newData);
		$("#results").css("display","block");
		var divs = $("#results" + " > div");
	
		// on mouse over clean previous selected and set a new one
		divs.mouseover( function() {
			divs.each(function(){ this.className = "unselected"; });
			this.className = "selected";
		})
	
		// on click copy the result text to the search field and hide
		divs.click( function() {
			$("#searchField").val(this.childNodes[0].nodeValue);
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
		console.log('Width:'+sf_width);
		// apply the css styles - optimized for Firefox
		acResultsDiv.css("position","absolute");
		acResultsDiv.css("left", sf_left - 2);
		acResultsDiv.css("top", sf_top + sf_height + 5);
		acResultsDiv.css("width", sf_width - 2);
	}
});

	</script>
</head>

<body>
	<div id="autocomplete">
		<H4>SEARCH BY NAME</H4>
		<form action="process/indexp.php" method="POST">
		<input id="searchField" maxlength="15" name="searchField" type="text" style="width:50%;padding:3px;margin:0 auto;"/>
		<input type="hidden" name="hidden">
		<input type="button" value="Search">
		</form>
		<div id="results"></div>
		<?php
		if ($_POST['hidden'])
		{
			$name = $_POST['name'];
			$ans = mysql_query("SELECT * FROM raw WHERE name = $name");
			echo "<div id='content'>";
			while($res = mysql_fetch_assoc($ans))
			{
				echo "Name:".$res['name']."<br/>";
				echo "Proposal Num:".$res['proposal_no']."<br/>";
				echo "Payment Amout:".$res['payment_amount']."<br/>";
				echo "GWP:".$res['gwp']."<br/>";
				echo "Login Date:".$res['login_date']."<br/>";
				echo "Proposal Status:".$res['proposal_status']."<br/>";
				echo "Insured Age:".$res['insured_age']."<br/>";
				echo "Policy No:".$res['policy_no']."<br/>";
				echo "Policy Start Date:".$res['policy_Start_date']."<br/>";
				echo "No.Of Lives:".$res['no_of_lives']."<br/>";
				echo "Business Type:".$res['business_type']."<br/>";
				echo "Plan:".$res['plan']."<br/>";
				echo "Policy Issuance Date:".$res['policy_issuance_Date']."<br/>";
				echo "Address:".$res['address']."<br/>";
				echo "City:".$res['city']."<br/>";
				echo "Pincode:".$res['pincode']."<br/>";
				echo "Mobile:".$res['mobile']."<br/>";
				echo "Cover Type:".$res['cover_type']."<br/>";
				echo "Client ID:".$res['client_id']."<br/>";
				echo "DOB:".$res['dob']."<br/>";
				echo "Landline:".$res['landline']."<br/>";
				echo "Email ID:".$res['email']."<br/>";
				echo "Claims:".$res['claims']."<br/>";
				echo "Notes:".$res['notes']."<br/>";
				echo "Renewal Due:".$res['renewal']."<br/>";
				echo "<form method='POST' action='index_edit.php'>";
				echo "<input type='button' value='Edit'>";
				echo "<input type='hidden' name='hidden_edit' value=".$name.">";
				echo "</form>";
			}
			echo "</div>";
		}
		?>
		<div id="testing"></div>

	</div>
	<br/>
	<br/>
	<!--<a href="upload_csv.html">UPLOAD DATA</a>-->
</body>
</html>