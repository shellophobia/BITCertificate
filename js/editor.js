
$(document).ready(function(){
	$("#edit").click(function(){
	$(".styler").slideDown();
	$("#data_field").slideDown();
	});
	$("#done").click(function(){
	$(".styler").slideUp();	
	$("#data_field").slideUp();
	});
});
function hide()
{
document.getElementById('edit').style.visibility="hidden";
document.getElementById('edit').style.position="absolute";
document.getElementById('done').style.visibility="visible";
document.getElementById('done').style.position="relative";
}
function show()
{
document.getElementById('done').style.visibility="hidden";
document.getElementById('done').style.position="absolute";
document.getElementById('edit').style.visibility="visible";
document.getElementById('edit').style.position="relative";
}
function iFrameOff(){
	richTextField.document.designMode = 'Off';
}
function iFrameOn(){
	richTextField.document.designMode = 'On';
}
function iBold(){
	richTextField.document.execCommand('bold',false,null);
}
function iUnderline(){
	richTextField.document.execCommand('underline',false,null);
}
function iItalic(){
	richTextField.document.execCommand('italic',false,null); 
}
function iFontSize(){
	var size = document.fsize.f_s.value;
	richTextField.document.execCommand('FontSize',false,size);
}
function sure()
{
	var m=confirm("WHEN YOU WILL CHANGE THE DATA ALL THE CHANGES IN THE STYLE WILL BE LOST     ARE YOU SURE YOU WANT TO SUBMIT THIS FORM");
	if(m)
	document.getElementById("data_field").submit();
	else
	return false;
	
}
function submit_form(e)
{
	var theForm = document.getElementById("myform");
	theForm.elements["myTextArea"].value = window.frames['richTextField'].document.body.innerHTML;
	var m=theForm.elements["myTextArea"].value;
	var arr=m.split("<b></b>");
	m=escape(arr[1]);
	var req;
		if(window.XMLHttpRequest)
		req=new XMLHttpRequest();
		else
		req=new ActiveXObject("Microsoft.XMLHTTP");
		req.onreadystatechange = function ()
		{
			if(req.readyState==4 && req.status==200)
			{
				alert('The Current Format of Certificate Has Been Saved As Custom Certificate Successfully');
			}
		}
		req.open("POST","design.php?"+e+"="+m,true);
		req.send();
}
function save(e)
{
	var m=confirm("ARE YOU SURE YOU WANT TO SAVE THE DATA AND PRINT THE CERTIFICATE");
	if(m)
	{
		window.print();
		window.onbeforeunload=function(){
			sendreq(e);
			return '';
		};
	}
	else
	return false;
}

function sendreq(e){
		if(window.XMLHttpRequest)
			req=new XMLHttpRequest();
			else
			req=new ActiveXObject("Microsoft.XMLHTTP");
		 if(e.localeCompare('mig')==0)
		 {
			var a=document.forms['change']['name'].value;
			var b=document.forms['change']['roll'].value;
			var c=document.forms['change']['exte'].value;
			var d=document.forms['change']['dide'].value;
			var e=document.forms['change']['yofj'].value;
			var f=document.forms['change']['yofp'].value;
			req.open("GET","save.php?mig=submit&name="+a+"&roll="+b+"&exte="+c+"&dide="+d+"&yofj="+e+"&yofp="+f,false);
			req.send();
		 } 
		 else
		 {
			var a=document.forms['change']['name'].value;
			var b=document.forms['change']['roll'].value;
			var c=document.forms['change']['exte'].value;
			var d=document.forms['change']['dide'].value;
			var e=document.forms['change']['cour'].value;
			var f=document.forms['change']['bran'].value;
			var g=document.forms['change']['cgpa'].value;
			var h=document.forms['change']['moff'].value;
			var i=document.forms['change']['yoff'].value;
			req.open("GET","save.php?pro=submit&name="+a+"&roll="+b+"&exte="+c+"&dide="+d+"&cour="+e+"&bran="+f+"&cgpa="+g+"&moff="+h+"&yoff="+i,false);
			req.send();
			return req.responseText;
		 }
}