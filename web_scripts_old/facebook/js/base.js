
// === Get/Hide/Show/Toggle ===

function ge()
{
  var ea;
  for( var i = 0; i < arguments.length; i++ ) {
    var e = arguments[i];
    if( typeof e == 'string' )
      e = document.getElementById(e);
    if( arguments.length == 1 )
      return e;
    if( !ea )
      ea = new Array();
    ea[ea.length] = e;
  }
  return ea;
}

function show()
{
  for( var i = 0; i < arguments.length; i++ ) {
    var element = ge(arguments[i]);
    if (element && element.style) element.style.display = '';
  }
  return false;
}

function hide()
{
  for( var i = 0; i < arguments.length; i++ ) {
    var element = ge(arguments[i]);
    if (element && element.style) element.style.display = 'none';
  }
  return false;
}

function shown(el) {
    el = ge(el);
    return (el.style.display != 'none');
}

function toggle()
{
  for( var i = 0; i < arguments.length; i++ ) {
    var element = ge(arguments[i]);
    element.style.display = (element.style.display == 'block') ? 'none' : 'block';
  }
  return false;
}

// === Event Info Access ===

function mouseX(event)
{
  return event.pageX || (event.clientX +
    (document.documentElement.scrollLeft || document.body.scrollLeft));
}

function mouseY(event)
{
  return event.pageY || (event.clientY +
    (document.documentElement.scrollTop || document.body.scrollTop));
}

function pageScrollX()
{
  return document.body.scrollLeft || document.documentElement.scrollLeft;
}

function pageScrollY()
{
  return document.body.scrollTop || document.documentElement.scrollTop;
}

function elementX(obj)
{
  var curleft = 0;
  if (obj.offsetParent) {
    while (obj.offsetParent) {
      curleft += obj.offsetLeft;
      obj = obj.offsetParent;
    }
  }
  else if (obj.x)
    curleft += obj.x;
  return curleft;
}

function elementY(obj)
{
  var curtop = 0;
  if(obj.offsetParent) {
    while (obj.offsetParent) {
      curtop += obj.offsetTop;
      obj = obj.offsetParent;
    }
  }
  else if (obj.y)
    curtop += obj.y;
  return curtop;
}

// === Onload Registry ===

var onloadRegistry = new Array();

function onloadRegister(handler)
{
  onloadRegistry.push(handler);
}

function onloadRun()
{
  for( var index in onloadRegistry )
    onloadRegistry[index]();
}

window.onload = onloadRun;

// === Placeholder Text ===

function placeholderSetup(id) {
	var el = ge(id);
	if(!el) return;
	if(el.type != 'text') return;
	if(el.type != 'text') return;
	
	var ph = el.getAttribute("placeholder");
	if( ph && ph != "" ) {
		el.value = ph;
		el.style.color = '#777';
		el.is_focused = 0;
		el.onfocus = placeholderFocus;
		el.onblur = placeholderBlur;
	}
}

function placeholderFocus() {
  if(!this.is_focused) {
    this.is_focused = 1;
    this.value = '';
    this.style.color = '#000';

    var rs = this.getAttribute("radioselect");
    if( rs && rs != "" ) {
      var re = document.getElementById(rs);
      if(!re) { return; }
      if(re.type != 'radio') return;

      re.checked=true;
    }
  }
}

function placeholderBlur() {
  var ph = this.getAttribute("placeholder")
  if( this.is_focused && ph && this.value == "" ) {
		this.is_focused = 0;
    this.value = ph;
    this.style.color = '#777';
  }
}

// === Log Stub ===

function Log(){};
Log.prototype.show = function (){alert('log disabled')};
Log.prototype.error = function (){};
Log.prototype.warning = function (){};
Log.prototype.note = function (){};
Log.prototype.time = function (){};
log = new Log();

// === String Utilities ===

function escapeQuotes(word) {

  // jsesq is a key/acronym for javascript escaped single quote
  // jsdsq is a key/acronym for javascript escaped double quote

  escaped = word.replace(/'/g, ":jsesq:"); 
  escaped = escaped.replace(/"/g, ":jsedq:"); 
  escaped = escaped.replace(/\[/g, ":jselb:"); 
  escaped = escaped.replace(/\]/g, ":jserb:"); 

  return escaped;
}

function unescapeQuotes(word) {

  // jsesq is a key/acronym for javascript escaped single quote
  // jsdsq is a key/acronym for javascript escaped double quote

  escaped = word.replace(/:jsesq:/g, "'"); 
  escaped = escaped.replace(/:jsedq:/g, '"'); 
  escaped = escaped.replace(/:jselb:/g, '\['); 
  escaped = escaped.replace(/:jserb:/g, '\]'); 

  return escaped;
}

// === URI Handling ===

function escapeURI(u)
{
    if(encodeURIComponent) {
        return encodeURIComponent(u);
    }
    if(escape) {
        return escape(u);
    }
}

function goURI(href) {
  window.location.href = href;
}

//13th parallel
function getViewportWidth() {
  var width = 0;
  if( document.documentElement && document.documentElement.clientWidth ) {
    width = document.documentElement.clientWidth;
  }
  else if( document.body && document.body.clientWidth ) {
    width = document.body.clientWidth;
  }
  else if( window.innerWidth ) {
    width = window.innerWidth - 18;
  }
  return width;
};

function getViewportHeight() {
  var height = 0;
  if( document.documentElement && document.documentElement.clientHeight ) {
    height = document.documentElement.clientHeight;
  }
  else if( document.body && document.body.clientHeight ) {
    height = document.body.clientHeight;
  }
  else if( window.innerHeight ) {
    height = window.innerHeight - 18;
  }
  return height;
};

// === Deprecated ===
// --- Delete checkAgree when user profile picture editing moves to picture widget

function checkAgree() {
  if (document.frm.pic.value) {
    if (document.frm.agree.checked) {
      document.frm.submit();
    } else {
      show("error");
    }
  }
}

function isIE() {
 return (navigator.userAgent.toLowerCase().indexOf("msie") != -1);
}   
    
function getTableRowShownDisplayProperty() {
  if (isIE()) {
    return  'inline';
  } else {
    return 'table-row';
  }
}
  
function showTableRow()
{ 
  for( var i = 0; i < arguments.length; i++ ) {
    var element = ge(arguments[i]);
    if (element && element.style) element.style.display =
        getTableRowShownDisplayProperty();
  }
  return false;
} 
  
function getParentRow(el) {
    el = ge(el);
    while (el.tagName && el.tagName != "TR") {
        el = el.parentNode;
    }
    return el;
} 

function stopPropagation(e) {
    if (!e) var e = window.event;
    e.cancelBubble = true;
    if (e.stopPropagation) {
        e.stopPropagation();
    }
}

function show_standard_status(status) {
  s = ge('standard_status');
  if (s) {
    var header = s.firstChild;
    header.innerHTML = status;
    show('standard_status');
  }
}

function adjustImage(obj) {
  var max=0;
  var pn=obj.parentNode;
  while (pn.className.indexOf('note_content')==-1)
    pn=pn.parentNode;
  if (pn.offsetWidth)
    max=pn.offsetWidth;
  else
    max=400;
  obj.className=obj.className.replace('img_loading', 'img_ready');
  if (obj.width>max) {
    if (window.ActiveXObject) {
      try {
        var img_div=document.createElement('div');
        img_div.style.filter='progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' + obj.src.replace('"', '%22') + '", sizingMethod="scale")';
        img_div.style.width=max+'px';
        img_div.style.height=((max/obj.width)*obj.height)+'px';
        if (obj.parentNode.tagName=='A')
          img_div.style.cursor='pointer';
        obj.parentNode.insertBefore(img_div, obj);
        obj.removeNode(true);
      }
      catch (e) {
        obj.style.width=max+'px';
      }
    }
    else
      obj.style.width=max+'px';
  }
}
