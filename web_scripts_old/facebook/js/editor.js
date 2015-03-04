
function editor_two_level_change(selector, subtypes_array, sublabels_array)
{
  selector = ge(selector);
  if( selector.getAttribute("typefor") )
    subselector = ge(selector.getAttribute("typefor"));
  
  if( selector && subselector ) {    
    // Clear Old Options
    subselector.options.length = 1;
    type_value = selector.options[selector.selectedIndex].value;
    
    // Fill with New Options
    index = 1;
    suboptions = subtypes_array[type_value];
    for(var key in suboptions) {
      subselector.options[index] = new Option(suboptions[key], key);
      index++;
    }

    if (sublabels_array)  {
        if (sublabels_array[type_value]) {
            subselector.options[0] = new Option(sublabels_array[type_value], "");
            subselector.options[0].selected = true;
        } else {
            subselector.options[0] = new Option("---", "");
            subselector.options[0].selected = true;
        }
    } 

    // Potentially Disable Subtype Selector
    subselector.disabled = (type_value == "" || subselector.options.length <= 1);
  }
}

function editor_two_level_set_subselector(subselector, value)
{
  subselector = ge(subselector);
  if( subselector ) {
    opts = subselector.options;
    for( var index=0; index < opts.length; index++ ) {
      if ((opts[index].value == value) || ( value === null && opts[index].value == '' )) {
        subselector.selectedIndex = index;
      }
    }
  }
}

function editor_rel_change(selector, prefix, orig_value)
{
  selector = ge(selector);
  // Show New Partner Box
  if( selector && ge(prefix+'_new_partner') ) {
    if( selector.value > 1 ) {
      show(prefix+'_new_partner');

      // these values are hard-coded, which sucks. but it works, which is good.
      if ( selector.value == 4 || selector.value == 5 ) {
        hide(prefix+'_new_partner_with');
        show(prefix+'_new_partner_to');
      } else {
        show(prefix+'_new_partner_with');
        hide(prefix+'_new_partner_to');
      }      
    } else {
      hide(prefix+'_new_partner');
      hide(prefix+'_new_partner_with');
      hide(prefix+'_new_partner_to');
    }
  
  } else {
    if ( selector.value == 4 || selector.value == 5 ) {
      hide(prefix+'_rel_with');
      show(prefix+'_rel_to');
    } else if ( selector.value > 1 ) {
      show(prefix+'_rel_with');
      hide(prefix+'_rel_to');
    }
  }
    
  // Cancel or Uncancel Relationship based on new status value
  if( selector && ge(prefix+'_rel_uncancel') ) {
    if( selector.value > 1 )
      editor_rel_uncancel(selector, prefix, selector.value);
    else
      editor_rel_cancel(selector, prefix);
  }
  
  // Toggle Awaiting
  editor_rel_toggle_awaiting(selector, prefix, orig_value);
}

function editor_rel_toggle_awaiting(selector, prefix, orig_value)
{
  // Toggle awaiting or required notices based on orig_value
  selector = ge(selector);
  if( selector && ge(prefix+'_rel_required') ) {
    if( selector.value == orig_value ) {
      hide(prefix+'_rel_required');
      show(prefix+'_rel_awaiting');
    }
    else {
      show(prefix+'_rel_required');
      hide(prefix+'_rel_awaiting');
    }
  }  
}

function editor_rel_cancel(selector, prefix)
{
  if( ge(prefix+'_rel_uncancel') )
    show(prefix+'_rel_uncancel');
  if( ge(prefix+'_rel_cancel') )
    hide(prefix+'_rel_cancel');
  selector = ge(selector);
  if( ge(selector) && ge(selector).selectedIndex > 1 )
    editor_rel_set_value(selector, 1);
}

function editor_rel_uncancel(selector, prefix, rel_value)
{
  if( ge(prefix+'_rel_uncancel') )
    hide(prefix+'_rel_uncancel');
  if( ge(prefix+'_rel_cancel') )
    show(prefix+'_rel_cancel');
  
  if ( rel_value == 4 || rel_value == 5 ) {
    hide(prefix+'_rel_with');
    show(prefix+'_rel_to');
  } else if ( rel_value > 1 ) {
    show(prefix+'_rel_with');
    hide(prefix+'_rel_to');
  }

  if( ge(selector) && ge(selector).selectedIndex <= 1 )
    editor_rel_set_value(selector, rel_value);
  editor_rel_toggle_awaiting(selector, prefix, rel_value);
}

function editor_rel_set_value(selector, value)
{
  selector = ge(selector);
  if( selector ) {
    opts = selector.options;
    opts_length = opts.length;
    for( var index=0; index < opts_length; index++ ) {
      if ((opts[index].value == value) || ( value === null && opts[index].value == '' )) {
        selector.selectedIndex = index;
      }
    }
  }
}

function enableDisable(gainFocus, loseFocus) {
    loseFocus = ge(loseFocus);
    if (loseFocus) { 
        if (loseFocus.value) loseFocus.value = "";
        if (loseFocus.selectedIndex) loseFocus.selectedIndex= 0;
    }
}

function show_editor_error(error_text, exp_text)
{
    ge('editor_error_text').innerHTML = error_text;
    ge('editor_error_explanation').innerHTML = exp_text;
    show('error');
}

function make_explanation_list(list, num, verb_plur, verb_sing, postfix) {
    var exp = "";
    var item;
    for (item in list) {
        if (item > 0 && num > 2) exp += ", ";
        if (item > 0 && (item == num-1)) exp += " and ";
        exp += list[item];
    }
    exp += " ";
    if (num > 1) {
        exp += verb_plur;
    } else {
        exp += verb_sing;
    }
    exp += " " + postfix;
    return exp;
}

function TimeSpan(start_prefix, end_prefix, span, auto) {

    // Public Methods 

    //gets the timestamp from the start date fields
    this.get_start_ts = function () {
        return _get_date_time_ts(_start_month, _start_day, _start_year, 
                _start_hour, _start_min, _start_ampm);
    }

    //gets the current timestamp from the end date fields
    this.get_end_ts = function () {
        var start_ts = _get_date_time_ts(_start_month, _start_day, _start_year, 
                _start_hour, _start_min, _start_ampm);
        var end_ts   = _get_date_time_ts(_end_month, _end_day, _end_year, 
                _end_hour, _end_min, _end_ampm);
        if (start_ts > end_ts && !(_start_year && _end_year)) {
            //push end_ts to the future by a year
            var future_date = new Date();
            future_date.setTime(end_ts);
            future_date.setFullYear(future_date.getFullYear() + 1);
            return future_date.getTime();
        } else {
            return end_ts;
        }
    }

    // Private Variables and Methods

    var _start_month = ge(start_prefix+'_month');
    var _start_day = ge(start_prefix+'_day');
    var _start_hour = ge(start_prefix+'_hour');
    var _start_year = ge(start_prefix+'_year');
    var _start_min = ge(start_prefix+'_min');  
    var _start_ampm = ge(start_prefix+'_ampm');

    var _end_month = ge(end_prefix+'_month');
    var _end_day = ge(end_prefix+'_day');
    var _end_year = ge(end_prefix+'_year');
    var _end_hour = ge(end_prefix+'_hour');
    var _end_min = ge(end_prefix+'_min');  
    var _end_ampm = ge(end_prefix+'_ampm');

    var _bottom_touched;
    if (auto) {
        _bottom_touched = false;
    } else {
        _bottom_touched = true;
    }

    var _start_touched  = function() {
        if (!_bottom_touched) {
            _propogate_time_span(_start_month, _start_day, _start_year,
                    _start_hour, _start_min, _start_ampm);
        }
    }

    var _end_touched = function () {
        _bottom_touched = true;
    }

    var _propogate_time_span = function () {
        // 1) make the timestamp
        var start_ts = _get_date_time_ts(_start_month, _start_day, _start_year, 
                                          _start_hour, _start_min, _start_ampm);

        // 2) make the offset timeSpan
        var end_ts = start_ts + span * 60000; //60,000 milis in minute

        // 3) propogate the endtime
        _set_date_time_from_ts(end_ts, _end_month, _end_day, _end_year, 
                _end_hour, _end_min, _end_ampm);
    }

    var _get_date_time_ts = function (m, d, y, h, min, ampm) {

        var this_date = new Date();
        var date_this_day = this_date.getDate();
        var date_this_month = this_date.getMonth();
        var date_this_year = this_date.getFullYear();

        var month = m.value-1;
        var date = d.value;
        var hour;
        var minutes = min.value;
        var year;

        hour = parseInt(h.value);
        if (hour == 12) hour = 0;
        if (ampm.value == 'pm') {
            hour = hour + 12;
        } 
        //below infers the year from current time
        if (!y) {
            if (month < date_this_month) {
                year = date_this_year + 1;
            } else {
                if (month == date_this_month && date < date_this_day) {
                    year = date_this_year + 1;
                } else {
                    year = date_this_year;
                }
            }
        } else {
            year = y.value;
        }

        var new_date = new Date(year, month, date, hour, minutes, 0, 0);
        var ts = new_date.getTime();
          
        return ts;
    }

    var _set_date_time_from_ts = function (ts, m, d, y, h, min, ampm) {

        var new_date = new Date();
        new_date.setTime(ts);

        var old_month = m.value;

        var new_month   = new_date.getMonth() + 1; //not zero indexed
        var new_day     = new_date.getDate();
        var new_hour    = new_date.getHours();
        var new_minutes = new_date.getMinutes();
        var new_year    = new_date.getFullYear();
        var new_ampm;

        if (new_hour > 11) {
            new_ampm = 'pm';
            if (new_hour > 12) {
                new_hour = new_hour - 12; 
            }
        } else {
            if (new_hour == 0) new_hour = 12;
            new_ampm = 'am';
        }

        
        if (new_minutes < 10) {
            // handle case where new_minutes = "05"
            new_minutes = "0" + new_minutes;
        }

        m.value = new_month;
        d.value = new_day;
        if (y) {
            y.value = new_year;
        }
        h.value = new_hour; 
        min.value = new_minutes; 
        ampm.value = new_ampm;

        if (old_month != new_month) {
            //changing month, make sure our days are good
            editor_date_month_change(m, d);
        }
        
    }

    var _start_month_touched = function() {
        _start_touched();
        editor_date_month_change(_start_month, _start_day);
    }

    var _end_month_touched = function() {
        _end_touched();
        editor_date_month_change(_end_month, _end_day);
    }

    //set the event handlers
    _start_month.onchange = _start_month_touched;
    _start_day.onchange = _start_touched;
    if (_start_year) {
        _start_year.onchange = _start_touched;
    }
    _start_hour.onchange = _start_touched;
    _start_min.onchange = _start_touched;
    _start_ampm.onchange = _start_touched;

    _end_month.onchange = _end_month_touched;
    _end_day.onchange = _end_touched;
    if (_end_year) {
        _end_year.onchange = _end_touched;
    }
    _end_hour.onchange = _end_touched;
    _end_min.onchange = _end_touched;
    _end_ampm.onchange = _end_touched;
}

function editor_date_month_change(month_el, day_el) {
    month_el = ge(month_el);
    day_el = ge(day_el);

    if (day_el.options[0].value == '') {
        //date_month_not_required
        offset = 1;
    } else {
        offset = 0;
    }
    current_num_days = day_el.options.length - offset;
    new_month = month_el.value - 1; //make it zero indexed
    new_num_days = month_get_num_days(new_month);
    
    if (new_num_days < current_num_days) {
        day_el.options.length = new_num_days + offset;
    } else {
        if (new_num_days > current_num_days) {
            for (i = current_num_days+1; i <= new_num_days; i++) {
                day_el.options[offset+i-1] = new Option(i);
            }
        }
    }
}

function month_get_num_days(m) {
  var temp_date, d;

  temp_date = new Date();
  //set it to the first so no weirdness if called on the 31st and set
  // to a month that doesn't have 31 days
  temp_date.setDate(1); 
  temp_date.setMonth(m);
  d = 29;
  do {
    d++;
    temp_date.setDate(d);
  } while (temp_date.getMonth() == m);

  return d - 1;
}

function toggleEndWorkSpan(prefix) {
    if (shown(prefix+'_endspan')) {
        hide(prefix+'_endspan');
        show(prefix+'_present');
    } else {
        show(prefix+'_endspan');
        hide(prefix+'_present');
    }
}

function regionCountryChange(label_id, country_id, region_id) {
    switch(country_id) {
        case '326': //canada
            show(region_id);
            ge(label_id).innerHTML='Province';
        break;
        case '398': //usa
            show(region_id);
            ge(label_id).innerHTML='State';
        break;
        default:
            ge(label_id).innerHTML='Country';
            hide(region_id);
        break;
    }
}

function textLimit(ta, count) {
  var text = ge(ta);
  if(text.value.length > count) {
    text.value = text.value.substring(0,count);
    if(arguments.length>2) { // id of an error block is defined
      ge(arguments[2]).style.display='block';
    }
  }
}

function calcAge(month_el, day_el, year_el) {
  bYear  = parseInt(ge(year_el).value);
  bMonth = parseInt(ge(month_el).value);
  bDay   = parseInt(ge(day_el).value);

  theDate = new Date();
  year    = theDate.getFullYear();
  month   = theDate.getMonth() + 1;
  day     = theDate.getDate();

  age = year - bYear;
  if((bMonth > month) || (bMonth == month && day < bDay)) age--;

  return age;
}

function genYearOptionList(yearStart, yearEnd, curYear, name, parent) {
  var theSelect = document.createElement('select');
  theSelect.name = name;
  theSelect.id = name;
  var blank = document.createElement('option');
  blank.innerHTML = 'Year:';
  theSelect.appendChild(blank);

  for (var i = yearEnd; i >= yearStart; i--) {
    var element = document.createElement('option');
    if(curYear!=0 && curYear==i) {
      element.setAttribute('selected', 'selected');
    }
    element.setAttribute('value', i);
    element.innerHTML = i;
    theSelect.appendChild(element);
  }
  ge(parent).appendChild(theSelect);
}

function genMonthOptionList(curMonth, name, parent) { // optional onchange code param
  var theSelect = document.createElement('select');
  theSelect.name = name;
  theSelect.id = name;
  if(arguments.length > 3) {
    theSelect.setAttribute('onchange', arguments[3]);
  }
  var blank = document.createElement('option');
  blank.innerHTML = 'Month:';
  theSelect.appendChild(blank);
  var months = new Array();
  months[0] = 'January';
  months[1] = 'February';
  months[2] = 'March';
  months[3] = 'April';
  months[4] = 'May';
  months[5] = 'June';
  months[6] = 'July';
  months[7] = 'August';
  months[8] = 'September';
  months[9] = 'October';
  months[10] = 'November';
  months[11] = 'December';
  for(var i = 1; i<=12; i++) {
    var element = document.createElement('option');
    if(curMonth!=0 && curMonth==i) {
      element.setAttribute('selected', 'selected');
    }
    element.setAttribute('value', i);
    element.innerHTML = months[i-1];
    theSelect.appendChild(element);
  }
  ge(parent).appendChild(theSelect);
}

