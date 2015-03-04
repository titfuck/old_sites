var widgets = { "guestlist":  {"text":"the guest list",      "on": 0 },
                "wall":       {"text":"the wall",            "on": 0 },
                "photos":     {"text":"photos of the event", "on": 0 }}

var common_public_access_text =  "People can add themselves to the guest " +
                                 "list and invite others to the event. " +
                                 "Anyone can see the event information";
var common_closed_access_text =  "Only people you invite will be on the guest "+
                                 "list.  People can request invitations. "+
                                 "Anyone can see the event information";
var common_private_access_text = "The event will not appear in search results."+
                                 " Only people you invite can see the event "+
                                 "information";

var access_data = {
    "public_access":  {"first_half_text": common_public_access_text, 
                        "no_widget_text": common_public_access_text + ".", 
                       "elements_already_in_list": 1 },
    "closed_access":  {"first_half_text": common_closed_access_text + ", but "+
                                         "only those invited can see ", 
                       "no_widget_text": common_closed_access_text + ".", 
                       "elements_already_in_list": 0 },
    "private_access": {"first_half_text": common_private_access_text, 
                       "no_widget_text": common_private_access_text + ".",  
                       "elements_already_in_list": 1 }}

function submit_form() {
    //hide any already displaying erros
    ge('error').style.display = 'none';

    //if anything positive is displaying, kill it
    if (ge('statuses')) hide('statuses');

    var num_missing = 0;
    var missing_items = new Array();
    var num_bad = 0;
    var bad_items = new Array();

    //public methods for the span
    var event_span = ((start_time_end_time_timespan.get_end_ts() - 
                      start_time_end_time_timespan.get_start_ts()) / 
                      (1000*60*60*24));

    if (event_span > 31)  // 31 days
    {
        //if month error
        show_editor_error('Please check the event start and end time.',
               'A Facebook event must end within 31 days from when it starts.');
        window.location.hash = "errors_hash";
        return;
    }

    if (event_span < 0)  // 31 days
    {
        //if month error
        show_editor_error('Please check the event start and end time.',
               'An event must not end before it begins.');
        window.location.hash = "errors_hash";
        return;
    }


    if (ge('name').value == "") {
        missing_items[num_missing] = 'Name'; num_missing++;
    } 
    if (!check_network_selected()) {
        missing_items[num_missing] = 'Network'; num_missing++;
    } 
    if ((ge('host') && ge('host').value == "") &&  
               (ge('host_id') && ge('host_id').selectedIndex <= 0)) {
        missing_items[num_missing] = 'Host'; num_missing++;
    } 
    if ((ge('host_with_groups') && ge('host_with_groups').value == "")&& 
               (ge('host_id') && ge('host_id').selectedIndex <= 0)) {
        missing_items[num_missing] = 'Host'; num_missing++;
    } 
    if (ge('desc').value == "") {
        missing_items[num_missing] = 'Description'; num_missing++;
    } 
    if (!check_category_selected()) {
        missing_items[num_missing] = 'Event Type'; num_missing++;
    } 
    if (ge('location').value == "") {
        missing_items[num_missing] = 'Venue'; num_missing++;
    } 
    if (!check_phone_number()) { 
        bad_items[num_bad] = 'Phone'; num_bad++;
    } 
    if (!check_email_address()) { 
        bad_items[num_bad] = 'Email'; num_bad++;
    }
    
    if (num_missing == 0 && num_bad == 0) {
        //all good, submit
        ge('event_info_form').submit();
    } else {
        if (num_missing > 0) {
            var str = "Please fill in all of the required fields."; 
            exp = make_explanation_list(missing_items, num_missing,
                    "are", "is", "required.");
        } else {
            var str = "Please make sure all of your information is correct."; 
            exp = make_explanation_list(bad_items, num_bad,
                    "appear", "appears", "invalid.");
        }
        show_editor_error(str, exp);
        window.location.hash = "errors_hash";
    }
}
