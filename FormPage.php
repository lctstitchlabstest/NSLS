<?php
include_once($IDDir . "account.php");
$limit = 10;
$sql = " ORDER BY recordtime DESC LIMIT " . $limit;
$acctDB = new accountData();
$acct = new account();

if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
	$acct->set_account($id = ' ', $_POST['account_name'], $_POST['account_email']);
	$acctDB->add_accounts($acct);
}

?>
<html>
<head>
 <!-- <script src="https://code.jquery.com/jquery-1.10.2.js"></script>  -->
  <script language="JavaScript">
function ValidateEmail(mail)   
{  
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))  
  {  
    return (true)  
  }  
    alert("You have entered an invalid email address!")  
    return (false)  
}

function ValidateName(name)  {
	
 if (/^\S+(.)*$/.test(name))  
  {  
    return (true)  
  }  
    alert("You must enter something for the name!")  
    return (false)  

} 


function Validate(form)  {
	
	var name = form.account_name.value;
	var mail = form.account_email.value;
	
	if(ValidateName(name) == false)
		return false;
	
	if(ValidateEmail(mail) == false)
		return false;
	
}
//$( "form" ).submit(function( event ) {
//  if ( $( "input:first" ).val() === "correct" ) {
//    $( "span" ).text( "Validated..." ).show();
//    return;
//  }
 
//  $( "span" ).text( "Not valid!" ).show().fadeOut( 1000 );
//  event.preventDefault();
//});

function display(action, id)
{

if (action == 'show')
{
document.getElementById("explanation"+id).style.visibility = "visible";
document.getElementById("link"+id).href= "javascript:display('hide', "+id+")";
document.getElementById("link"+id).innerHTML = "Click here to collapse...";
autoResize(Oheight, width);
}

if (action == 'hide')
{
document.getElementById("explanation"+id).style.visibility = "hidden";
document.getElementById("link"+id).href= "javascript:display('show', "+id+")";
document.getElementById("link"+id).innerHTML = "Click here to expand...";
autoResize(Cheight, width);
}
}

</script>
</head>
<body>
	<div>
<a id="link1" href="javascript:display('show', 1)">Click here to enter accounts...</a>
</div>
<div id="explanation1" style="visibility:hidden">

		<form action='#' id='Addacct' method="post" onSubmit='return Validate(this);'>   
			name: <input type='text' name='account_name' id='account_name' size='10' maxlength='35'>
			email:<input type='text' name='account_email' id='account_email' size='10' maxlength='35'>
			<input type="submit" value="Submit">
		</form>
	</div>
	<div style="border:solid 1px #F60;">
		Last 10 entry:
	</div>
	<div style="border:solid 1px #000;">
		<?php
		 	$results = $acctDB->get_accounts($sql);
			
			
            if(is_array($results) && (count($results) > 0) )  {
				foreach ($results AS $account)  {
//echo "Hello <br />  \n ";
//print_r($results);
//echo "  \n ";
					
					$acct->set_account($account['id'], $account['name'], $account['email']);
					echo $acct->print_account();
				}
				
			}
		
		
		?>
	</div>
</body>
</html>
