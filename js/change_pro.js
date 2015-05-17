function seeCourse()
{
	
	var m=document.forms["change"]["dide"].value;
	var xmlDoc,xmlhttp;
	if (window.XMLHttpRequest)
	  xmlhttp=new XMLHttpRequest();
	else
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.open("GET","addbranch.php?dide="+m,false);
	xmlhttp.send();
	var ext=xmlhttp.responseText;
	document.getElementById("cour_select").innerHTML=ext;
	seeBranch();
}
function seeBranch()
{
	var m=document.forms["change"]["cour"].value;
	var xmlDoc,xmlhttp;
	if (window.XMLHttpRequest)
	  xmlhttp=new XMLHttpRequest();
	else
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.open("GET","addbranch.php?cour="+m,false);
	xmlhttp.send();
	var ext=xmlhttp.responseText;

	document.getElementById("bran_select").innerHTML=ext;
}
