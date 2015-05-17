load();
function load()
{
var x;
var y=document.forms["history"]["option"].value;
var z=document.forms["history"]["cert"].value;
if (window.XMLHttpRequest)
  {
  x=new XMLHttpRequest();
  }
else
  {
  x=new ActiveXObject("Microsoft.XMLHTTP");
  }
x.onreadystatechange=function()
  {
	if (x.readyState==4 && x.status==200)
    {
		var mars=x.responseText;
                if(mars.length>249)
		document.getElementById("history").innerHTML='<center>'+x.responseText+'</center>';
		else
		document.getElementById("history").innerHTML="<h2>No Result To Show</h2>";
    }
	else
	{
	document.getElementById("history").innerHTML="<center><img src='img/loading.gif'></img></center>";
    }
  }
x.open("GET","load.php?his="+y+"&cert="+z,true);
x.send();
}

function put_between()
{
	var opt= document.forms["history"]["option"].value;
	if(opt==7)
	{
		document.getElementById("between").style.visibility="visible"; 
		document.getElementById("between").style.position="relative"; 
	}
	else if(opt==0||opt==1||opt==2||opt==3||opt==4||opt==5||opt==6)
	{
	document.getElementById("between").style.visibility="hidden"; 
	document.getElementById("between").style.position="absolute"; 
	load();
	}
}
function put_date_time()
{

var x;
var z=document.forms["history"]["cert"].value;
var v1=document.forms["history"]["st_date"].value;
var v2=document.forms["history"]["st_month"].value;
var v3=document.forms["history"]["st_year"].value;
//var v4=document.forms["history"]["st_time"].value;
var v5=document.forms["history"]["fi_date"].value;
var v6=document.forms["history"]["fi_month"].value;
var v7=document.forms["history"]["fi_year"].value;
//var v8=document.forms["history"]["fi_time"].value;
var date1=v3+"-"+v2+"-"+v1;
var date2=v7+"-"+v6+"-"+v5;
if (window.XMLHttpRequest)
  {
  x=new XMLHttpRequest();
  }
else
  {
  x=new ActiveXObject("Microsoft.XMLHTTP");
  }
x.onreadystatechange=function()
  {
  if (x.readyState==4 && x.status==200)
    {

		var mars=x.responseText;
                if(mars.length>209)
		document.getElementById("history").innerHTML='<center>'+x.responseText+'</center>';
		else
		document.getElementById("history").innerHTML="<h2>No Result To Show</h2>";
	}
	else
	{
		document.getElementById("history").innerHTML="<center><img src='img/loading.gif'></img></center>";
	}
  }
x.open("GET","load.php?his=7&date1="+date1+"&date2="+date2+"&cert="+z,true);
x.send();
}
