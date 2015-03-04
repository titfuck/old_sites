
populateSelector = function(event)
{
  if(!event && window.event)
  {
    event = window.event;
  }

  if(event && event.keyCode == 13)
  {
    submitSearch()
    return false;

  }
  var filterEl = ge('selector_name');
  if(!filterEl) { return; }
  var filter = filterEl.value.toLowerCase();

  if(filter == "duchess")
  {
    window.location = "http://www.patinagroup.com/patina";
  }

  var listEl = ge('friends_list');
  if(!listEl) { return; }

  var regex = new RegExp("^" + filter + "|\\s" + filter, "i");

  var len = listEl.childNodes.length;
  for(var i = 0; i < len; i++)
  {
    var childEl = listEl.childNodes[i];
    if(!childEl) { continue; }
    var name = childEl.getAttribute('u_name');
    var id = childEl.getAttribute('u_id');
    childEl.style.display = '';
    if(regex.exec(name))
    {
      childEl.style.display = '';
    }
    else
    {
      childEl.style.display = 'none';
    }
  }
}

submitSearch = function()
{
  var filterEl = ge('selector_name');
  if(!filterEl) { return; }
  
  var s = filterEl.value;
  var nStr = "";
  if(_networkKey)
  {
    nStr = "&n=" + _networkKey;
  }
  window.location = "/s.php?k=10008&q=" + s + "&a=" + _inviteType + "&aa=" + _oid + nStr;
}

update_pending_count = function(){
  var num_pending = document.getElementById('invitations').childNodes.length;
  
  if(num_pending == 1) {
    document.getElementById('pending_count').innerHTML = "1 person has not been sent an invitation yet.";
  } else {
    document.getElementById('pending_count').innerHTML = (num_pending + " people have not been sent invitations yet.");
  }

}

onPendingAdd = function(objEl, parentEl)
{
  var ajax = new Ajax(onPendingAddDone, onAjaxFail);
  ajax.parentEl = parentEl;
  ajax.objEl = objEl;

  var id = objEl.getAttribute('u_id');
  populateSelector();

  var listEl = ge('friends_list');
  if(!listEl) { return; }
  listEl.removeChild(parentEl);

  ajax.post('/objectinvite_ajax.php', "oid=" + _oid + "&id=" + id + "&lp=1");

  var listEl = ge('friends_list');
  if(!listEl) { return; }

  var id = objEl.getAttribute('u_id');
  var name = objEl.getAttribute('u_name');

  var pendingList = ge('invitations');
  
  var li = document.createElement("li");
  li.id = "p_" + id;
  var nameEl = document.createElement("div"); 
  nameEl.className = 'name_row';
  nameEl.innerHTML = '<a href="/profile.php?id=' + id + '">' + name + '</a>';

  var removeEl = document.createElement("div");
  removeEl.innerHTML = "<a href='#' u_id='" + id + "' u_name='" + name + "' onclick='onPendingRemove(this, ge(\"p_" + id + "\")); return false'>Remove</a>";

  li.appendChild(nameEl);
  li.appendChild(removeEl);

// Show pending list if it's hidden
  pendingList.insertBefore(li, pendingList.firstChild); 
  update_pending_count();

  if(document.getElementById('invitation_list').style.display == 'none') {
    show('invitation_list');
//    ge('status_bar').style.marginTop='-10px';
  } else {
    ge('status_bar').style.marginTop='0px';
  }
  
}

onPendingRemove = function(objEl, parentEl)
{
  var ajax = new Ajax(onPendingRemoveDone, onAjaxFail);
  ajax.parentEl = parentEl;
  ajax.objEl = objEl;          

  var id = objEl.getAttribute('u_id');
  var name = objEl.getAttribute('u_name');
  insertIntoSelector(id, name);
  populateSelector();

  ajax.post('/objectinvite_ajax.php', "oid=" + _oid + "&id=" + id + "&lr=1");

  var pendingList = ge('invitations');
  if(!pendingList) { return; }

// Hide pending list if it's visible and there are no more elements in it
  pendingList.removeChild(parentEl);   
  update_pending_count();

  if(!(document.getElementById('invitations').hasChildNodes())) hide('invitation_list');
}

insertIntoSelector = function(id, name)
{
  var listEl = ge('friends_list');
  var childEl = listEl.childNodes[0];
  var el = document.createElement('span');
  el.id = "u_" + id;
  el.setAttribute('u_id', id);
  el.setAttribute('u_name', name);
  el.innerHTML = "<input u_id='" + id + "' name='" + id + "' u_name='" + name + "' type='checkbox' onclick='onPendingAdd(this, ge(\"u_" + id + "\"))'><label>" + name + "</label><br>";
  listEl.insertBefore(el, childEl);
}

onPendingAddDone = function(ajaxObj, responseText)
{
}

onPendingRemoveDone = function(ajaxObj, responseText)
{
}

onAjaxFail = function(ajaxObj, responseText)
{
}

function moveAndShow(dialog, rootEl) {
    if (rootEl = ge(rootEl)) {
        var x = elementX(rootEl) + 90;
        var y = elementY(rootEl) - 60; 
    }
    if (dialog) {
        dialog.style.left = x + "px";
        dialog.style.top = y + "px";
        dialog.style.display = "block";
    }
}

function showMakeAdminDialog(rootEl, name, id) {
  showDialog = ge('admin_dialog');
  ge('admin_name').innerHTML = unescapeQuotes(name);
  ge('admin_uid').value = id;
  moveAndShow(showDialog, rootEl);
}

function showRemoveAdminDialog(rootEl, name, id) {
  showDialog = ge('remove_admin_dialog');
  ge('remove_admin_name').innerHTML = unescapeQuotes(name);
  ge('remove_admin_uid').value = id;
  moveAndShow(showDialog, rootEl);
}


function showRemoveDialog(rootEl, name, id) {
  showDialog = ge('remove_dialog');
  ge('remove_name').innerHTML = unescapeQuotes(name);
  ge('remove_uid').value = id;
  moveAndShow(showDialog, rootEl);
}


