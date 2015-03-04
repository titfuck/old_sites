function toggle_access_str(option) {
    if (widgets[option]) {
        if (widgets[option]['on']) {
            // take it out
            widgets[option]['on'] = 0;
        } else {
            // put it in 
            widgets[option]['on'] = 1;
        }
    }
    for (access_id in access_data) {
        if (access_el = ge(access_id)) {
            num_widgets_on = get_num_widgets_on();
            if (num_widgets_on > 0) {
                access_el.innerHTML = access_data[access_id]['first_half_text']
                    + make_widget_str(num_widgets_on, 
                            access_data[access_id]['elements_already_in_list'])
                    + "."; 
            } else {
                access_el.innerHTML = access_data[access_id]['no_widget_text'];
            }
        }
    }
}

function get_num_widgets_on() {
    var num_widgets_on = 0;

    for (widget in widgets) {
        if (widgets[widget]['on'] ==  1) {
            num_widgets_on++;
        }
    }
    return num_widgets_on;
}

function make_widget_str(num_widgets_on, elements_already_in_list) {
    var str = "";

    var total_list_items = num_widgets_on + elements_already_in_list;
    var i =  elements_already_in_list; 
    for (widget in widgets) {
        if (widgets[widget]['on'] ==  1) {
            if (i > 0 && (total_list_items > 2)) str += ", ";
            if (i > 0 && (i == total_list_items-1)) str += " and "; 
            str += widgets[widget]['text'];
            i++;
        }
    }
    return str;
}

//set the access strings in javascript
function set_access_strings(options)
{
    //nothing in there, for each one we want to set, toggle it
    for (option in options) {
        if (options[option] > 0) {
            widgets[option]['on'] = 1;
        }
    }
    toggle_access_str(null);
}

function check_category_selected(){
    type_sel = document.getElementById('two_level_category').selectedIndex;
    sub_sel = document.getElementById('two_level_subcategory').selectedIndex;
    return (type_sel > 0 && sub_sel > 0);
}

function check_network_selected(){
    var net;
    var network = ge('network');
    if (network) {
        if (network.value) {
            return true;
        } else {
            return (ge('network').selectedIndex > 0);
        }
    }
    return true;
}

function check_phone_number() {
    // http://developer.apple.com/internet/webcontent/validation.html
    var phone = ge('phone').value;
    if (phone) {
        var stripped = phone.replace(/[\(\)\.\-\ ]/g, '');
        //strip out acceptable non-numeric characters
        if (isNaN(parseInt(stripped)) || stripped.length < 7) {
            return false;
        }
    }
    return true;
}

function check_email_address() {
    // http://developer.apple.com/internet/webcontent/validation.html
    var email = ge('email').value;
    if (email) {
        var email_filter=/^.+@.+\..{2,4}$/;
        var illegal_chars= /[\(\)\<\>\,\;\:\\\/\"\[\]]/;
        if (!(email_filter.test(email)) || (email.match(illegal_chars))) {
            return false;
        }
    }
    return  true;
}
