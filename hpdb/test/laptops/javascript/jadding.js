function add(path, id)
{
	var form = document.createElement("form");
//	form.setAttribute("method", "POST");
	form.setAttribute("action", path);
//	var hiddenField = document.createElement("input");
//	hiddenField.setAttribute("name", "id");
//	hiddenField.setAttribute("value",id );
//	hiddenField.setAttribute("type", "hidden");
//	form.appendChild(hiddenField);
	document.body.appendChild(form);
	form.submit();
}
