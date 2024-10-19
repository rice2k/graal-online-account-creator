<?php
## Scripted in 2011, updated to not error.

#if ($_SERVER['HTTP_REFERER']) {
#    header("Location: /404.html");
#    exit();
#}


require("misc.php");

## Ugh 
$PHP_SELF = &$_SERVER['PHP_SELF'];

## Ughhhh
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = '';
}

if(isset($_POST['username'])) {
    $username = strtolower($_POST['username']);
} else {
    $username = '';
}


if(isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    $password = '';
}
?>
<html>
<head>
<title>The uhh Not Expanse - Account Creator</title>
<STYLE type=text/css>
BODY    {CURSOR: default; FONT-FAMILY: Verdana; FONT-SIZE: 12px}
UL    {CURSOR: default; FONT-FAMILY: Verdana; FONT-SIZE: 12px}
LI    {CURSOR: default; FONT-FAMILY: Verdana; FONT-SIZE: 12px}
P   {CURSOR: default; FONT-FAMILY: Verdana; FONT-SIZE: 12px}
TD    {FONT-FAMILY: Verdana; FONT-SIZE: 12px}
TR    {FONT-FAMILY: Verdana; FONT-SIZE: 12px}
SELECT    {BACKGROUND-COLOR: #272727; COLOR: #1D5D82; FONT-FAMILY: Verdana; FONT-SIZE: 10px}
INPUT     {BACKGROUND-COLOR: #272727; COLOR: #FFFFFF; FONT-FAMILY: Verdana; FONT-SIZE: 12px}
TEXTAREA  {BACKGROUND-COLOR: #272727; COLOR: #c0c0c0; FONT-FAMILY: Verdana; FONT-SIZE: 12px}
OPTION    {BACKGROUND-COLOR: #272727; COLOR: #1D5D82; FONT-FAMILY: Verdana; FONT-SIZE: 10px}
FORM    {FONT-FAMILY: Verdana; FONT-SIZE: 10px}
.thtcolor {COLOR: #000000;}
#all A:active {COLOR: #000000;}
#all A:visited {COLOR: #000000;}
#all A:hover {COLOR: #666666;}
#all A:link {COLOR: #000000;}
#cat A:active { COLOR:  #000000; text-decoration: none}
#cat A:visited { COLOR: #000000; text-decoration: none}
#cat A:hover { COLOR: #000000; text-decoration: underline}
#cat A:link { COLOR: #000000; text-decoration: none}
</STYLE>

</head>

<body bgcolor="#ffffff" text="#000000" id=all leftmargin="10" topmargin="10" marginwidth="10" marginheight="10" link="#000000" vlink="#000000" alink="#000000">
<div align="center"><font face="verdana" size="2"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="500" height="110">
    <param name=movie value="expanse.swf">
    <param name=quality value=high>
    <embed src="expanse.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="500" height="110">
    </embed> 
  </object><br>
  </font> </div>
<table width="640" border="2" cellspacing="2" cellpadding="3" bordercolor="#FFFFFF" align="center">
  <tr> 
    <td width="640" valign="top" bgcolor="#CCCCCC" bordercolor="#000000" align="center">

<?php

/*
echo ("<font face=\"$mainfont\" size=\"2\">[<b>A</b>ccounts:"); 
include ("$serverdata$accountcount_file"); 
echo("] / [<b>P</b>layers <b>O</b>nline: ");   
include ("$serverdata$playercount_file"); 
echo("] / [<b>U</b>ptime: ");  
include ("$serverdata$serveruptime_file"); 
echo("]</font>");
*/
?>
    </td>
  </tr>
  <tr> 
    <td width="640" valign="top" bgcolor="#CCCCCC" bordercolor="#000000" align="center">
        <br>

<?php
if ($page == "createaccountstep1") 
	{
		echo("
	<form name=\"accountcreator\" method=\"post\" action=\"$PHP_SELF?page=createaccountstep2\">
        <table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
          <tr bgcolor=\"#A6A6A6\"> 
            <td align=\"center\" colspan=\"2\"><b><font face=\"$mainfont\">Account Creator</font></b></td>
          </tr>
          <tr> 
            <td width=\"50%\"><font face=\"$mainfont\">Username:<br>
              </font></td>
            <td width=\"50%\"> <font face=\"$mainfont\"> 
              <input type=\"text\" name=\"username\">
              </font></td>
          </tr>
          <tr> 
            <td width=\"50%\"><font face=\"$mainfont\">Password:<br>
              <font size=\"-1\">(Make sure you remember it, we are on a budget and couldn't pay Hell Raven for decent scripting.)</font><br>
              </font></td>
            <td width=\"50%\"> <font face=\"$mainfont\"> 
              <input type=\"text\" name=\"password\">
              </font></td>
          </tr>
          <tr align=\"center\"> 
            <td colspan=\"2\"> <font face=\"$mainfont\"> 
              <input type=\"submit\" name=\"step2\" value=\" Next -&gt; \">
              </font></td>
          </tr>
        </table>
	    </form>
			");

	} else if ($page == "createaccountstep2") 
				  {

// Username Check
		if ($username == "") {
		$error = "$usernameerror1";
		} else if (strlen($username) <= "20") 
			{
			for ($i = 0; $i < strlen($username); $i++) 
				{ 
				$strnum = ord($username[$i]);
					if (($strnum < 65 || $strnum > 90) && (($strnum < 97) || $strnum > 122) && (($strnum < 48) || ($strnum > 57))) 
					{
//			$charproblem = "1";
					}
				}
		if(isset($charproblem)) 
			{
			$error = "$usernameerror2";
			}
		} else {
			$error = "$usernameerror3";
			}
// End Username Check

// Error Message
		if(isset($error))
			{
	   	echo("
        <table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
          <tr bgcolor=\"#A6A6A6\"> 
            <td align=\"center\"><b><font face=\"$mainfont\">Account Creator</font></b></td>
          </tr>
          <tr> 
          <td valign=\"top\">
            <p><font face=\"$mainfont\">Sorry but the following error occured:</font></p>
            <p><font face=\"$mainfont\" size=\"-2\">
			");
			echo("$error");
	echo("
			</font></p>
            <p><font face=\"$mainfont\">please go back and try again.</font></p>
            </td>
          </tr>
        </table>
			");
			} else {
			echo("
	<form name=\"accountcreator\" method=\"post\" action=\"$PHP_SELF?page=createaccountstep3\">
        <br>
        <table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
          <tr bgcolor=\"#A6A6A6\"> 
            <td align=\"center\"><b><font face=\"$mainfont\">Account Creator</font></b></td>
          </tr>
          <tr> 
            <td valign=\"top\"><font face=\"$mainfont\">Please confirm that the following 
              information is correct:<br>
              <br>
              Username: $username<br>
              Password: $password<br>
              <br>
              If this information is correct please click the next button to finalize 
              the account creation process. Again, make sure you 'member password.<br><br><font face=\"$mainfont\" size=\"-1\">Note: The next step will take a minute to process, please do not hit the button twice.</font></font></td>
          </tr>
          <tr>
            <td align=\"center\"> 
              <input type=\"submit\" name=\"step3\" value=\" Next -&gt; \">
			  <input type=\"hidden\" name=\"username\" value=\"$username\">
			  <input type=\"hidden\" name=\"password\" value=\"$password\">
            </td>
          </tr>
        </table>
	    </form>
					");
	}
} else if ($page == "createaccountstep3") 
				  {
// Username Check
		if ($username == "") {
		$error = "$usernameerror1";
		} else if (strlen($username) <= "20") 
			{
			for ($i = 0; $i < strlen($username); $i++) 
				{ 
				$strnum = ord($username[$i]);
					if (($strnum < 65 || $strnum > 90) && (($strnum < 97) || $strnum > 122) && (($strnum < 48) || ($strnum > 57))) 
					{
//			$charproblem = "1";
					}
				}
		
		if(isset($charproblem)) 
			{
			$error = "$usernameerror2";
			}
		} else {
			$error = "$usernameerror3";
			}
// End Username Check

// Error Message
		if(isset($error))
			{
	   	echo("
        <table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
          <tr bgcolor=\"#A6A6A6\"> 
            <td align=\"center\"><b><font face=\"$mainfont\">Account Creator</font></b></td>
          </tr>
          <tr> 
          <td valign=\"top\">
            <p><font face=\"$mainfont\">Sorry but the following error occured:</font></p>
            <p><font face=\"$mainfont\" size=\"-1\">
			");
			echo("$error");
	echo("
			</font></p>
            <p><font face=\"$mainfont\">please go back and try again.</font></p>
            </td>
          </tr>
        </table>
			");
	} else {
	
	$gr_result = mysqli_query($ADMIN['mysqlconnect'],"SELECT * FROM graal_users WHERE account='" . $username . "'");
	
	if ( mysqli_num_rows($gr_result) != 0  )
			{
			$error = "<font size=\"-2\">The username <b>$username</b> is already registered.</font> <br>";
			}
		}
// Error Message
		if(isset($error))
			{
	   	echo("
        <table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
          <tr bgcolor=\"#A6A6A6\"> 
            <td align=\"center\"><b><font face=\"$mainfont\">Account Creator</font></b></td>
          </tr>
          <tr> 
          <td valign=\"top\">
            <p><font face=\"$mainfont\">Sorry but the following error occured:</font></p>
            <p><font face=\"$mainfont\" size=\"-1\">
			");
			echo("$error");
	echo("
			</font></p>
            <p><font face=\"$mainfont\">please go back and try again.</font></p>
            </td>
          </tr>
        </table>
			");
		} else {

		$gr_salt = substr(md5(uniqid(rand(), true)), 0, 3);
		$gr_pass = md5(md5($_POST['password']) . $gr_salt);
		
		$ADMIN['mysqlquery'] = "
		INSERT INTO graal_users
		(account, password, salt, activated)  
		VALUES
		('" . $username . "', '" . $gr_pass . "', '" . $gr_salt . "', '1')
		";
		
		$ADMIN['mysqldoquery'] = mysqli_query($ADMIN['mysqlconnect'],$ADMIN['mysqlquery']) or die("Couldn't execute query.");

$welcomeemailemail = "theexpanse@graalmail.com";
$welcomeemail = "
Welcome to The uhh Not Expanse server

Here is your login information:
Username: $username
Password: $password

Server IP: expanse.2y.net
Server Port: 14900

In game server commands:
sethead headname.gif  -  Changes your current head graphic
setsword swordname.gif - Changes your current sword graphic
setshield shieldname.gif - Changes your current shield graphic
setnick nickname - Changes your current nickname
showname - Shows your current name.
showap - Shows your current Alignment.
showdeaths - Shows the current ammount of times you were killed on the server.
showkills - Shows the current ammount of times you killed someone on the server.
showonlinetime - Shows your current online time on the server.
showguild guildname - Shows a list of everyone currently online in the specified guild
showadmins - Shows a list of server administrators currently online. 
unstuck me - Warps you to the servers start location incase you get stuck in a level.
toguild: - Sends a message to everyone in your guild that is currently online.
toall: - Sends a public message to everyone that is currently on the server.

Enjoy the server!

Sincerely,
The uhh Not Team
";

//		mail("$email","The uhh Not - Account: $username Created","$welcomeemail","From: The Expanse <$welcomeemailemail>");

	echo("			          
		<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
          <tr bgcolor=\"#A6A6A6\"> 
            <td align=\"center\"><b><font face=\"$mainfont\">Account Creator</font></b></td>
          </tr>
          <tr> 
            
          <td valign=\"top\"> 
            <p><font face=\"$mainfont\">Account created sucessfully.</font></p>
            </td>
          </tr>
        </table>
			");
		}
	
} else {
	echo("
     <form name=\"accountcreator\" method=\"post\" action=\"$PHP_SELF?page=createaccountstep1\">
        <br>
        <table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
          <tr bgcolor=\"#A6A6A6\"> 
            <td align=\"center\"><b><font face=\"$mainfont\">Account Creator</font></b></td>
          </tr>
          <tr> 
            <td valign=\"top\"><font face=\"$mainfont\">Welcome to The uhh Not Expanse Account Creator. You 
              will be able to create yourself an account and be able to play on 
              our server in just minutes! That's right, it's all automated. Before 
              you go onto the next step there are a few things you should know. 
              Your username can only have letters a-z, and numbers 0-9. Continue with the account 
              creation process by clicking the next button below.</font></td>
          </tr>
          <tr>
            <td align=\"center\"> 
              <input type=\"submit\" name=\"step1\" value=\" Next -&gt; \">
            </td>
          </tr>
        </table>
	    </form>
		   ");
}
?>
      <br>
    </td>
  </tr>
  <tr> 
    <td width="640" valign="top" bgcolor="#CCCCCC" bordercolor="#000000" align="center"><font face="Verdana" size="2">all 
      original content copyright &copy; 2001 uhh Not Expanse</font></td>
  </tr>
</table>
</body>
</html>
