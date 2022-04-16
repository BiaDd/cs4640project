// Author: Matthew Morelli
// This file uses jQuery & AJAX to load the upcoming events into the sidebar on the left
// of the calendar view.

// Will likely be modified in the future, for instance limiting the number of items that appear in the list.
$(document).ready(function() {
    $.get("?command=upcomingloader", function(data){
        
        var data = JSON.parse(data);
        var events = JSON.parse(data['events']);
        var load_msg = data['load_msg'];
        const mabbrs = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ];
        if (!load_msg) {
            events.forEach(function (event) {
                let title = event['title'];
                if (title.length > 24) { // Handles titles that are too long to fit in the sidebar list.
                    titleInsert = title.slice(0,25)+"...";
                } else {
                    titleInsert = title;
                }

                let dtime = new Date(Date.parse(event['dtime'])); // Converts into datetime format so that I can make the tags in the sidebar pretty.
                let mo = mabbrs[dtime.getMonth()];
                let day = dtime.getDate().toString();
                let dateTag = mo+" "+day;
                $('#upcoming').append(`<a href='?command=eventpage&eventID=${event['id']}' class='list-group-item list-group-item-action'>${titleInsert}<span class='badge bg-primary' style='float: right;'>${dateTag}</span></a>`);
            });
        } else { // Places the load message inside, whatever the message may be. It comes from the php handler upcomingLoader.
            $('#upcoming').append("<li class='list-group-item text-center py-2'>"+load_msg+"</li>");
        }

        console.log(events);
    })
})