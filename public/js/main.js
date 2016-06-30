$(document).ready(function () {
    var $alarm = $('<audio src="sound/alarm3.wav" id="alarm"></audio>');
    $("body").append($alarm);
    var table = $("#commutator_table > tbody");

    var netswitches_comfirmed = [];
    if (localStorage.netswitches_comfirmed) {
        netswitches_comfirmed = JSON.parse(localStorage.netswitches_comfirmed || "[]")
    }

    $(document).on('click', '#districtTabs a', function (e) {
        e.preventDefault();
        $(this).tab('show');
        filter = $(this).data('district');
        table.empty();
        checkStatus();
    });

    $(document).on('click', ".mute", function () {
        $(this).children().removeClass("glyphicon-volume-up");
        $(this).children().addClass("glyphicon-volume-off");

        var row = $(this).closest("tr");
        row.css("background-color", "yellow");

        var netswitch_id = row.data('netswitch-id');
        netswitches_comfirmed.push(netswitch_id);
        localStorage.netswitches_comfirmed = JSON.stringify(netswitches_comfirmed);
    });

    $(document).on('click', ".unmute", function () {
        $(this).children().removeClass("glyphicon-volume-off");
        $(this).children().addClass("glyphicon-volume-up");

        var row = $(this).closest("tr");

        var netswitch_id = row.data('netswitch-id');
        netswitches_comfirmed.splice($.inArray(netswitch_id, netswitches_comfirmed), 1);
        localStorage.netswitches_comfirmed = JSON.stringify(netswitches_comfirmed);
    });

    $.ajaxSetup({cache: false});



    var checkStatus = function () {
        $.getJSON("/status/district/" + filter, function (data) {
            table.empty();
            $.each(data, function (key, netswitch) {
                var status = netswitch.status;

                table.append($('<tr data-netswitch-id="' + netswitch.id + '" data-status="' + status + '">')
                    .append($('<td>')
                        .text(key)
                    )
                    .append($('<td>')
                        .text(netswitch.guard)
                    )
                    .append($('<td>')
                        .text(netswitch.name)
                    )
                    .append($('<td>')
                        .text(netswitch.status)
                    )
                    .append($('<td>')
                        .text(netswitch.updated_at)
                    )
                    .append($('<td>')
                        .append($('<button type="button" class="mute btn btn-default">')
                            .append($('<span class="glyphicon glyphicon-volume-up">'))
                        )
                    )
                );
            });

            $('tr').each(function () {
                var row = $(this);
                var netswitch_id = row.data('netswitch-id');
                if (row.data('status') == 'alarm') {
                    if ($.inArray(netswitch_id, netswitches_comfirmed) > -1) {
                        row.css("background-color", "yellow");
                        row.find("span").removeClass("glyphicon-volume-up");
                        row.find("span").addClass("glyphicon-volume-off");
                        row.find("button").removeClass("mute");
                        row.find("button").addClass("unmute");
                    } else {
                        row.css("background-color", "red");
                        alarm.play();
                    }
                } else {
                    if ($.inArray(netswitch_id, netswitches_comfirmed) > -1) {
                        netswitches_comfirmed.splice($.inArray(netswitch_id, netswitches_comfirmed), 1);
                        localStorage.netswitches_comfirmed = JSON.stringify(netswitches_comfirmed);
                    }
                }
            });

        });
    };

    checkStatus();
    setInterval(checkStatus, 1500);
});
