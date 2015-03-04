function ajaxreq(url, data) {
//    var myAjax = new Ajax.Request( url,
//        {method: 'post', parameters: data, onComplete: ajaxreply} );
    var myAjax = new Ajax.Request( url,
        {method: 'get', parameters: data} );
}

/*
function ajaxreply(originalRequest) {
	eval(originalRequest.responseText);
    //if(!bHasRedirect) {
	//	eval(originalRequest.responseText);
	//	alert(originalRequest.responseText);
    //} else {
    //	bHasRedirect = false;
    //	ajaxreq(originalRequest.responseText, "");
    //}
}
*/

function ajaxcall(data) {
	ajaxreq("rpc.php", data);
	return false;
}

function popAdjust(n) {
	Form.disable('checkin');
	var q = {
		partyPop: $F('partyPop'),
		popAdjust: n,
		partyID: $F('partyID')
	};
	var h = $H(q);
	ajaxcall(h.toQueryString());
}
