window.onload = function (){
        var list = document.getElementsByTagName("input");
        for(var i=0; i<list.length; i++){
        if(list[i].type == 'text' || list[i].type == 'password'){
            list[i].onkeypress = function (event){
                return enterKeyInvalid(event);
            };
        }
    }
}

function editInputNum(form)
{
	var tmp = form.value;
}

function displayInputNum(form,len)
{
	var tmp = form.value;
	while(tmp.length < len)
	{
		tmp = " " + tmp;
	}
	form.value = tmp;
}

function enterKeyInvalid(e){
    if (!e) var e = window.event;

    if(e.keyCode == 13)
        return false;
}
