$(document).ready(function(e){rload();});

function show(e){
	document.getElementById(e).style.visibility="visible";
	document.getElementById('add'+e).style.visibility="visible";
	document.getElementById('close'+e).style.visibility="visible";
	document.getElementById('open'+e).style.visibility="hidden";
	document.getElementById(e).style.position="relative";
	document.getElementById('add'+e).style.position="relative";
	document.getElementById('close'+e).style.position="relative";
	document.getElementById('open'+e).style.position="absolute";
}
function hide(e){
	document.getElementById(e).style.visibility="hidden";
	document.getElementById('add'+e).style.visibility="hidden";
	document.getElementById('open'+e).style.visibility="visible";
	document.getElementById('close'+e).style.visibility="hidden";
	document.getElementById(e).style.position="absolute";
	document.getElementById('add'+e).style.position="absolute";
	document.getElementById('open'+e).style.position="relative";
	document.getElementById('close'+e).style.position="absolute";
}

function addbranch(x){
	//console.log(document.forms['ab'+x]);
	var bran=document.forms['ab'+x]['branch'+x].value;
	var pre=document.forms['ab'+x]['pre'+x].value;
	var course=document.getElementById('cour_list'+x).value;
	var type=(x==1?'degree':'diploma');
	$.ajax({
		url:'addbranch.php',
		type:'POST',
		data:{add:'branch',course:course,branch:bran,pre:pre,type:type},
		success:function(data){
			data=$.trim(data);
			//console.log(data);
			if(data.localeCompare('Branch added successfully!')==0){
			var toappend='<div class="row" style="margin-top:8px"><input type="text" style="width:60px" class="form-control col-sm-1" value="'+pre.toUpperCase()+'"><input type="text" style="width:360px;margin-left:15px;" class="form-control col-sm-6" value="'+bran+'"></div>';
			if(document.getElementById('message'+x)!== null){
				document.getElementById(x).innerHTML=toappend;
			}
			else
			$('#'+x+' div.row:last').after(toappend);
			if(document.forms['del_bran']['type'].value.localeCompare(type)==0 && document.forms['del_bran']['cour'].value.localeCompare(course)==0){
				if(document.getElementById('branmes')==null){
				var node=document.createElement('option');
				node.innerHTML=bran;
				document.forms['del_bran']['bran'].appendChild(node);
				}
				else{
					var toappend='<select  class="btn btn-default" name="bran"><option>'+bran+'</option></select>';
					document.getElementById('bran_space').innerHTML=toappend;
					document.getElementsByClassName('clumsy')[0].style.visibility='visible';
				}
			}
			}
			else{
			}
			clearfield('ab'+x);
		}
	});
}

function addcourse(){
	var form=document.forms['add_course'];
	var course=form['name'].value;
	var type=form['type'].value;
	var pre=form['cour_pre'].value;
	var branch='';
	var prefix='';
	var len=form['count'].value;
	var flag=0;
	for(var i=1;i<=len;i++){
		if(emptystr(form['branch'+i].value))
			continue;
		if(flag==0){
			branch+=form['branch'+i].value;
			prefix+=form['pref'+i].value;
			flag=1;
		}
		else{
			branch+=','+form['branch'+i].value;
			prefix+=','+form['pref'+i].value;
		}
	}
	var x=0;
	//console.log(branch);
	$.ajax({
		url:'addbranch.php',
		type:'POST',
		data:{add:'course',course:course,branch:branch,pre:pre,type:type,bran_pre:prefix},
		success:function(data){
			data=$.trim(data);
			if(data.localeCompare('Course Added Successfully!')==0){
			var a=(type.localeCompare('degree')==0?1:2);
			var node=document.createElement('option');
			node.innerHTML=course;
			document.getElementById('cour_list'+a).appendChild(node);
			showcour(1);
			showcour(2);
			}
			else{
			}
			clearfield('add_course');
		}
	});
}

function emptystr(str){
	return (str.localeCompare('')==0?1:0);
}

function removebranch(){
	var m=document.forms['del_bran']["cour"].value;
	var n=document.forms['del_bran']["bran"].value;
	var t=document.forms['del_bran']["type"].value;
	var x=confirm("Are you sure you want to delete "+n+" branch from "+m+" course?" );
	if(x)
	{
	$.ajax({
		url:'remove.php',
		type:'POST',
		data:{rembran:n,cour:m,type:t},
		success:function(data){
			console.log(data);
			showbran(0);
			var a=(t.localeCompare('degree')==0?1:2);
			fill_data(a);
		}
	});
	}
}
function removecourse(){
	var n=document.forms['del_cour']["cour"].value;
	var t=document.forms['del_cour']['type'].value;
	var x=confirm("Are you sure you want to delete "+n+" from course?" );
	if(x)
	{
	$.ajax({
		url:'remove.php',
		type:'POST',
		data:{remcour:n,type:t},
		success:function(data){
			var a=(t.localeCompare('degree')==0?1:2);
			var val=document.getElementById('cour_list'+a).value;
			if(n.localeCompare(val)==0){
				fill_cour(1);
				fill_cour(2);
			}
			else{
				var html=document.getElementById('cour_list'+a).innerHTML;
				html=html.replace('<option>'+n+'</option>','');
				document.getElementById('cour_list'+a).innerHTML=html;
			}
			showcour(1);
			showcour(2);
		}
	});
	}
}
function rload(){
	var req;
	if(window.XMLHttpRequest)
	req=new XMLHttpRequest();
	else
	req=new ActiveXObject("Microsoft.XMLHTTP");
	req.open("GET","courses_help.php",false);
	req.send();	
	document.getElementById("main_body").innerHTML=req.responseText;
	fill_cour(1);
	fill_cour(2);
	fill_data(1);
	fill_data(2);
	showcour(1);
	showcour(2);
	branchpre();
	//document.getElementById('cour_list1').options[0].selected=true;
	//document.getElementById('cour_list2').options[0].selected=true;
	document.forms['add_course']['count'].options[0].selected=true;
}

function showcour(x){
	var tag=(x==1?'del_cour':'del_bran');
	var type=document.forms[tag]['type'].value;
	$.ajax({
		url:'remove.php',
		type:'POST',
		data:{showcour:'a',type:type},
		success:function(data){
			if(x==1){
				document.getElementById("cour_space1").innerHTML=data;
				document.getElementById("cour_space1").options[0].selected=true;
			}
			if(x==2){
				document.getElementById("cour_space2").innerHTML=data;
				document.getElementById("cour_space2").options[0].selected=true;
			}
			showbran(0);
		}
	});
}

function showbran(x){
	var course=document.forms['del_bran']['cour'].value;
	var type=document.forms['del_bran']['type'].value;
	$.ajax({
		url:'remove.php',
		type:'POST',
		data:{showbran:'show',course:course,type:type},
		success:function(branch){
			//console.log(branch);
			branch=branch.split(',');
			if(branch.length==1 && emptystr(branch[0])==1){
				document.getElementsByClassName('clumsy')[0].style.visibility='hidden';
				var toappend='<div id="branmes" class="alert alert-info" style="height:40px;font-size:12px;padding:4px 5px 3px 9px;width:250px;margin-top:9px">No Branch To Delete!</div>';
			}
			else{
				document.getElementsByClassName('clumsy')[0].style.visibility='visible';
				var toappend='<select  class="btn btn-default" name="bran">';
				for(var i=0;i<branch.length;i++){
					toappend+='<option>'+branch[i]+'</option>';
				}
				toappend+='</select>';
			}
			document.getElementById('bran_space').innerHTML=toappend;
			if(document.forms['del_bran']['bran']!=null)
			document.forms['del_bran']['bran'].options[0].selected=true;
			if(x==1)
			rload();
		}
	});
}

function branchpre(){
	var val=document.getElementById('pre').value;
	var toappend='';
	for(var i=1;i<val;i++){
		toappend+='<div><input type="text" name="pref'+i+'" class="form-control col-sm-5" placeholder="PRE" style="margin-top:6px;margin-left:30px;width:60px"><input type="text" name="branch'+i+'" class="form-control col-sm-7" style="margin-left:20px;margin-top:6px;width:240px;" placeholder="BRANCH"></div>';
	}
	toappend+='<div><input type="text" name="pref'+i+'" class="form-control col-sm-5" placeholder="PRE" style="margin-top:6px;margin-left:30px;width:60px;margin-bottom:10px"><input type="text" name="branch'+i+'" class="form-control col-sm-7" style="margin-left:20px;margin-top:6px;width:240px;" placeholder="BRANCH"></div>';
	document.getElementById('addbox').innerHTML=toappend;
}
function fill_data(x){
	var opt=document.getElementById('cour_list'+x).value;
	document.getElementById('cour_name'+x).innerHTML=opt;
	var type;
	type=(x==1?'degree':'diploma');
	$.ajax({
		url:'addbranch.php',
		type:'POST',
		data:{cname:opt,type:type},
		success:function(data){
			//console.log(data);
			var json=JSON.parse(data);
			form_fill(json,x);
		}
	})
	.fail(function(){
		
	});
}

function form_fill(json,x){
	//console.log(JSON.stringify(json));
	document.forms['setpre'+x]['pre'+x].value=(json.cour_pre).toUpperCase();
	var b=json.branch;
	var branch=b.split(',');
	var p=json.pre;
	var prefix=p.split(',');
	var empty='';
	if(branch.length>0 && branch[0].localeCompare(empty)!=0){
	var toappend='<div style="margin-left:-12px">PREFIX&nbsp;&nbsp;&nbsp;BRANCH</div>';
	for(var i=0;i<branch.length;i++){
		toappend+='<div class="row" style="margin-top:8px"><input type="text" style="width:60px" class="form-control col-sm-1" value="'+prefix[i].toUpperCase()+'"><input type="text" style="width:360px;margin-left:15px;" class="form-control col-sm-6" value="'+branch[i]+'"></div>';
	}
	toappend+='<button id="bitbutton" style="margin-top:10px" class="btn btn-primary btn-sm" onclick="savedit('+x+')">Save Changes</button>';}
	else
	var toappend='<div id="message'+x+'" class="alert alert-info" style="height:40px;font-size:12px;padding:4px 5px 3px 9px;width:250px;margin-left:10px;margin-top:9px">This Course doesnt have any branch!</div>';
	document.getElementById(x).innerHTML=toappend;
}

function savedit(x){
	var div=document.getElementById(x);
	var prefix='';
	var branch='';
	var inp=div.getElementsByTagName('input');
	//console.log(inp.length);
	if(inp.length>0){
		prefix+=inp[0].value;
		branch+=inp[1].value;
	}
	for(var i=2;i<inp.length;i+=2){
		prefix+=','+inp[i].value;
		branch+=','+inp[i+1].value;
	}
	var course=document.getElementById('cour_list'+x).value;
	var type=(x==1?'degree':'diploma');
	$.ajax({
		url:'addbranch.php',
		type:'POST',
		data:{update:'brapre',course:course,bran:branch,pre:prefix,type:type},
		success:function(data){
			fill_data(x);
			showbran(0);
		}
	});
}

function savpre(x){
	var pre=document.forms['setpre'+x]['pre'+x].value;
	var course=document.getElementById('cour_list'+x).value;
	var type=(x==1?'degree':'diploma');
	$.ajax({
		url:'addbranch.php',
		type:'POST',
		data:{update:'pre',course:course,pre:pre,type:type},
		success:function(data){
			
		}
	});
}

function fill_cour(x){
	var type=(x==1?'degree':'diploma');
	$.ajax({
		url:'addbranch.php',
		type:'GET',
		async:false,
		data:{dide:type},
		success:function(data){
			document.getElementById('cour_list'+x).innerHTML=data;
			document.getElementById('cour_list'+x).options[0].selected=true;
			fill_data(x);
		}
	});
}

function clearfield(id){
	var inp=document.forms[id].getElementsByTagName('input');
	for(var i=0;i<inp.length;i++){
		inp[i].value='';
	}
}