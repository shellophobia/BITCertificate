var totalPrefix=0;
put_doc();
function fixpre(e)
{
	var m=document.forms[e]["pre"].value;
	totalPrefix=m;
	var s='';
	var i=0;
	for(i=1;i<=m;i++)
	{
		s=s+'<input type="text" name="pref'+i+'" class="form-control col-sm-3" style="width:70px;padding:0px;margin:0px" required >';
	}
	document.getElementById("prefix"+e).innerHTML=s;
}
function showRoll(e)
{
	
	var s='';
	for(i=1;i<=totalPrefix;i++)
	{
		s=s+document.forms[e]["pref"+i].value+'/';
	}
	s=s+document.forms[e]["rnum"].value+'/';
	s=s+document.forms[e]["ryea"].value;
	document.forms[e]["roll"].value=s;	
	var xmlDoc,xmlhttp;
	if (window.XMLHttpRequest)
	  xmlhttp=new XMLHttpRequest();
	else
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange=function()
        {
	    if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
		document.getElementById("notice").innerHTML='<center>'+xmlhttp.responseText+'</center>';
	     }
             else
	     {
	        document.getElementById("notice").innerHTML="<center><img src='img/loading.gif' width='100px' height='100px'></img></center>";
             }
        }
        xmlhttp.open("GET","checkroll.php?roll="+s+"&type="+e,true);
	xmlhttp.send();
}
function seeCourse()
{
	var m=document.forms["pro"]["type"].value;
	var xmlDoc,xmlhttp;
	if (window.XMLHttpRequest)
	  xmlhttp=new XMLHttpRequest();
	else
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.open("GET","addbranch.php?dide="+m,false);
	xmlhttp.send();
	var ext=xmlhttp.responseText;
	document.getElementById("cour").innerHTML=ext;
	seeBranch();
}
function seeBranch()
{
	var m=document.forms["pro"]["cour"].value;
	var xmlDoc,xmlhttp;
	if (window.XMLHttpRequest)
	  xmlhttp=new XMLHttpRequest();
	else
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			var ext=xmlhttp.responseText;
			document.getElementById("bran").innerHTML=ext;
		}
	}
	xmlhttp.open("GET","addbranch.php?cour="+m,true);
	xmlhttp.send();
}
function load_xml(e)
{
	
	var xmlDoc,xmlhttp;
	if (window.XMLHttpRequest)
	  xmlhttp=new XMLHttpRequest();
	else
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.open("GET","addbranch.php?exte=yes",false);
	xmlhttp.send();
	var ext=xmlhttp.responseText;
	document.getElementById("mig_exte").innerHTML=ext;
	document.getElementById("pro_exte").innerHTML=ext;
}
function put_doc()
{
	seeBranch();
	var cert= document.form.cert.value;
	if(cert.localeCompare('MIGRATION')==0)
	{
	
		document.getElementById("pro_det").style.visibility="hidden"; 
		document.getElementById("mig_det").style.visibility="visible";
		document.getElementById("mig_det").style.position="relative";
		document.getElementById("pro_det").style.position="absolute";
	}
	else
	{
	
		document.getElementById("mig_det").style.visibility="hidden"; 
		document.getElementById("mig_det").style.position="absolute"; 
		document.getElementById("pro_det").style.visibility="visible"; 
		document.getElementById("pro_det").style.position="relative"; 
	}
}
