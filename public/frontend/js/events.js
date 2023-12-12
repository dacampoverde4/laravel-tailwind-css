$(document).ready(function() {

    var xhr=null;
    var event_save_action=0;

    jQuery('.save_event').click(function(){

        var save_event_obj=jQuery(this);
        var event_id=$(this).data("event-id");
        if(event_save_action==0) {

            event_save_action = 1;

            xhr = $.ajax({
                url: window.Laravel.url + '/ajaxrequest/save-event-in-user-list',
                type: "POST",
                data: {event_id: event_id},
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': csrf_token},
                success: function (response) {

                    if (response.success) {
                        $.notify(response.msg, "success");
                        // alert(response.msg);
                        if (response.msg == 'Event saved successfully.') {
                            save_event_obj.addClass('saved');
save_event_obj.text('Saved');
                        }
                        else {
                            save_event_obj.removeClass('saved');
                            save_event_obj.text('Save Event');
                        }
                    }
                    else {
                        $.notify(response.error, "error");
                        // alert(response.error);
                    }

                },
                error: function (xhr, textStatus, errorThrown) {

                },
                statusCode: {
                    401: function () {
                        window.location.href = window.Laravel.url + '/login';
                    }
                },
                complete: function (xhr, textStatus) {
                    event_save_action=0;
                }
            });
        }

    });

});