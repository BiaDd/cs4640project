
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
                if (title.length > 24) {
                    titleInsert = title.slice(0,25)+"...";
                } else {
                    titleInsert = title;
                }

                let dtime = new Date(Date.parse(event['dtime']));
                let mo = mabbrs[dtime.getMonth()];
                let day = dtime.getDate().toString();
                let dateTag = mo+" "+day;
                $('#upcoming').append("<li class='list-group-item'>"+titleInsert+"<span class='badge bg-primary' style='float: right;'>"+dateTag+"</span></li>");
            });
        } else {
            $('#upcoming').append("<li class='list-group-item text-center py-2'>"+load_msg+"</li>");
        }

        console.log(events);
    })
})