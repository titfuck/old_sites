// NOTE: requires css/dialog.css

function toggle_dynamic_dialog_custom(rootEl, innerHTML) {
        /* because of the way IE renders select boxes, we should put an 
         * an iframe underneath our dynamic dialog so that select boxes
         * don't shine through, yuck. -jared m. 
         * actually we want this for everything - Firefox has the same
         * problem with scrollbars. -ari s.
         * 
         * this lays the iframe_holder, at the end of the function
         * we'll dynamically get the size of the dynamic dialog and
         * then we'll drop in the appropriately sized iframe.
         *
         * booyakasha. 
         */
        var ieHTML;
        ieHTML =  '<div id="ie_iframe_holder"></div>';
        ieHTML += '<div style="position: absolute; z-index: 100;">';
        innerHTML = ieHTML + innerHTML + '</div>';
    var dynamic_dialog = ge('dynamic_dialog');
    if (dynamic_dialog) {
        //reuse it
        if (shown(dynamic_dialog) && same_place(rootEl, dynamic_dialog)) {
            hide(dynamic_dialog);
        } else {
            move_here(rootEl, dynamic_dialog);  
	    dynamic_dialog.innerHTML = unescapeQuotes(innerHTML);
            show('dynamic_dialog');
        }
    } else {
        //create it
        var dynamic_dialog = document.createElement("div");
        dynamic_dialog.id = 'dynamic_dialog';
        dynamic_dialog.innerHTML = unescapeQuotes(innerHTML);
        move_here(rootEl, dynamic_dialog);
        ge('content').appendChild(dynamic_dialog);
    }
        // now dynamically get the size and drop the iframe in
        var height, width, ieIframeHTML;
        height = ge('dialog').offsetHeight;
        width  = ge('dialog').offsetWidth;
        ieIframeHTML = '<iframe width="' + width + ' "height=' + height + '" ';
        ieIframeHTML += 'style="position: absolute; z-index: 99; border: none;"></iframe>';
        ge('ie_iframe_holder').innerHTML = ieIframeHTML;
    return false;
}

function same_place(rootEl, dynamic_dialog) {
    if (rootEl = ge(rootEl)) {
        if (elementY(rootEl) + 20 == elementY(dynamic_dialog))
            return true;
    }
    return false;
}

function move_here(rootEl, el) {
    var x = getViewportWidth()/2 - 120;
    var y = elementY(rootEl) + 20;
    el.style.left = x + "px";
    el.style.top = y + "px";
}

function toggle_dynamic_dialog(rootEl, headingText, contentText, 
        confirmText, confirmLocation) {
    
    var form_check_string = (ge('post_form_id') ? 
    ('<input type="hidden" name="post_form_id" value="'+ge('post_form_id').value+'"/>') : '');
    
    var innerHTML = 
   "<form action=\"" + confirmLocation + "\" method=\"post\">\n" +
   "<table id=\"dialog\" border=\"0\" cellspacing=\"0\" width=\"360\">" +
   "<tr>\n" + 
   "<td class=\"dialog\">\n" + 
   "<h4>" + headingText + "</h4>\n" + 
   "<p>" + contentText + "</p>" +
   "<div class=\"buttons\">\n" +
   form_check_string +
   "<input type=\"hidden\" name=\"next\" value=\"" + window.location.pathname.substr(1) + window.location.search + "\"/>\n" +
   "<input type=\"submit\" id=\"confirm\" name=\"confirm\" class=\"inputsubmit\" value=\"" + confirmText + "\"/>&nbsp;<input type=\"button\" id=\"cancel\" name=\"cancel\" onclick=\"hide('dynamic_dialog');\" class=\"inputbutton\" value=\"Cancel\" />\n" + 
   "</div>\n" + 
   "</td>\n" + 
   "</tr>\n" +
   "</table>\n" +
   "</form>\n";
    return toggle_dynamic_dialog_custom(rootEl, innerHTML);
}

function toggle_dynamic_dialog_js(rootEl, headingText, contentText, 
        confirmText, confirmJS, remove_cancel_option) {
    
    var innerHTML = 
   "<table id=\"dialog\" border=\"0\" cellspacing=\"0\" width=\"360\">" +
   "<tr>\n" + 
   "<td class=\"dialog\">\n" + 
   "<h4>" + headingText + "</h4>\n" + 
   "<p>" + contentText + "</p>" +
   "<div class=\"buttons\">\n" +
   "<input type=\"button\" id=\"confirm\" name=\"confirm\" class=\"inputsubmit\"  value=\"" + confirmText + "\" onclick=\"" + confirmJS + "\"/>&nbsp;";
   if (!remove_cancel_option) {
     innerHTML += "<input type=\"button\" id=\"cancel\" name=\"cancel\" onclick=\"hide('dynamic_dialog');\" class=\"inputbutton\" value=\"Cancel\" />\n";
   }
   innerHTML += "</div>\n" + 
   "</td>\n" + 
   "</tr>\n" +
   "</table>\n";
    return toggle_dynamic_dialog_custom(rootEl, innerHTML);
}

// This little guy takes a get style request except it does it as a POST
function do_post(url) {
  var pieces=/(^([^?])+)\??(.*)$/.exec(url);
  var form=document.createElement('form');
  form.action=pieces[1];
  form.method='post';
  form.style.display='none';
  var sparam=/([\w]+)(?:=([^&]+)|&|$)/g;
  var param=null;
  if (ge('post_form_id'))
    pieces[3]+='&post_form_id='+ge('post_form_id').value;
alert(pieces[3]);
  while (param=sparam.exec(pieces[3])) {
    var input=document.createElement('input');
    input.type='hidden';
    input.name=param[1];
    input.value=param[2];
    form.appendChild(input);
  }
  document.body.appendChild(form);
  form.submit();
  return false;
}
