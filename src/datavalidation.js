function checkifvalid(e,idvalue)
{
    var x=document.getElementById(idvalue);
    var data=x.value;
    //alert(data);

    var keynum;
    var keychar;

    if(window.event) // IE8 and earlier
    {
	keynum = e.keyCode;
    }
    else if(e.which) // IE9/Firefox/Chrome/Opera/Safari
    {
	keynum = e.which;
    }
		
    if((keynum==8)||(!keynum)||(keynum==13))
    {
	return true;
    }
    keychar = String.fromCharCode(keynum);
    //alert(keychar);

    data=data+keychar;
    //alert(data);
		
    var tempchar;
    var dotcount=0;//if dotcount is greater than 1 then return false
    var i=0;
    if(data==null || data.length==0)
    {
	return true;
    }
    for(i=0;i<data.length;i++)
    {
	tempchar=data.charAt(i);
	if(tempchar=='-')
	{
	    if(i!=0)
	    {
		return false;
	    }
	}
	else if(tempchar=='.')
	{
	    if(i==0)
	    {
		return false;
	    }
	    if(dotcount>=1)
	    {
		return false;
	    }
	    else
	    {
		dotcount=dotcount+1;
	    }
	}
	else if((tempchar<'0')||(tempchar>'9'))
	{
	    return false;
	}
    }
    return true;
};

function checkiffloat(e,idvalue)
{
    var x=document.getElementById(idvalue);
    var data=x.value;
    //alert(data);
    var keynum;
    var keychar;
    if(window.event) // IE8 and earlier
    {
	keynum = e.keyCode;
    }
    else if(e.which) // IE9/Firefox/Chrome/Opera/Safari
    {
	keynum = e.which;
    }
	
    if((keynum==8)||(!keynum)||(keynum==13))
    {
	return true;
    }
    keychar = String.fromCharCode(keynum);
    //alert(keychar);
    data=data+keychar;
    //alert(data);
    var tempchar;
    var dotcount=0;//if dotcount is greater than 1 then return false
    var i=0;
    if(data==null || data.length==0)
    {
	return true;
    }
    for(i=0;i<data.length;i++)
    {
	tempchar=data.charAt(i);
	if(tempchar=='.')
	{
	    if(i==0)
	    {
		return false;
	    }
	    if(dotcount>=1)
	    {
		return false;
	    }
	    else
	    {
		dotcount=dotcount+1;
	    }
	}
	else if((tempchar<'0')||(tempchar>'9'))
	{
	    return false;
	}
    }
    return true;
};

function checkifint(e,idvalue)
{
    var x=document.getElementById(idvalue);
    var data=x.value;
    //alert(data);
    var keynum;
    var keychar;
    if(window.event) // IE8 and earlier
    {
	keynum = e.keyCode;
    }
    else if(e.which) // IE9/Firefox/Chrome/Opera/Safari
    {
	keynum = e.which;
    }
	
    if((keynum==8)||(!keynum)||(keynum==13))
    {
	return true;
    }
    keychar = String.fromCharCode(keynum);
    //alert(keychar);
    data=data+keychar;
    //alert(data);
    var tempchar;
    var i=0;
    if(data==null || data.length==0)
    {
	return true;
    }
    for(i=0;i<data.length;i++)
    {
	tempchar=data.charAt(i);
	if((tempchar<'0')||(tempchar>'9'))
	{
	    return false;
	}
    }
    return true;
};

function checkifrange(e,idvalue)
{
    var x=document.getElementById(idvalue);
    var data=x.value;
    //alert(data);
    var keynum;
    var keychar;
    if(window.event) // IE8 and earlier
    {
	keynum = e.keyCode;
    }
    else if(e.which) // IE9/Firefox/Chrome/Opera/Safari
    {
	keynum = e.which;
    }
	
    if((keynum==8)||(!keynum)||(keynum==13))
    {
	return true;
    }
    keychar = String.fromCharCode(keynum);
    //alert(keychar);
    data=data+keychar;
    //alert(data);
    var tempchar;
    var dotcount=0;//if dotcount is greater than 1 then return false
    var i=0;
    if(data==null || data.length==0)
    {
	return true;
    }
    for(i=0;i<data.length;i++)
    {
	tempchar=data.charAt(i);
		    
	if(tempchar=='-')
	{
	    if(i==0)
	    {
		return false;
	    }
	    if(dotcount>=1)
	    {
		return false;
	    }
	    else
	    {
		dotcount=dotcount+1;
	    }
	}
	else if((tempchar<'0')||(tempchar>'9'))
	{
	    return false;
	}
    }
    return true;
};