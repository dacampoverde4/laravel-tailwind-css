jQuery(document).ready(function(){

    var modal_user_list_who_liked   =   jQuery('#modal_user_list_who_liked');

    jQuery('.like_btn').click(function(){
        var link_btn_obj=$(this);
        var user_id = link_btn_obj.data('user');
        var own_profile = parseInt(jQuery('#own_profile').val());

        var liked_user=parseInt(link_btn_obj.attr('data-liked-user'));
        if(!own_profile) {
            if (!liked_user) {
                jQuery.ajax({
                    url: window.Laravel.url + '/ajaxrequest/like',
                    type: 'POST',
                    data: {'_token': window.Laravel.csrfToken, 'user': user_id},
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status) {
                            jQuery('.match_btn').html('<i style="font-size:30px" class="fa fa-check-square-o" aria-hidden="true"></i> ' + data.matchcount + ' Matches');
                            if (data.like) {
                                link_btn_obj.attr('data-liked-user', 1);
                                link_btn_obj.html('<i style="font-size:30px" class="fa">&#xf087;</i> ' + data.likecount + ' Likes');
                                $.notify("Liked successfully", "success");
                            } else {
                                link_btn_obj.html('<i style="font-size:30px" class="fa">&#xf087;</i> ' + data.likecount + ' Likes');
                                //$.notify("Disliked successfully", "success");
                            }

                        }
                    },
                    statusCode: {
                        401: function (response) {
                            //$.notify("Please refresh page and login again.", "success");
                            //$.notify("Please refresh page and login again.", "info");
                            //$.notify("Please refresh page and login again.", "error");
                        }
                    }
                });
            }
            else {
                modal_user_list_who_liked.modal('show');
            }
        } 
    });


    jQuery('.anc_unlike_user').click(function(){

        var link_btn_obj=$('.like_btn');
        var user_id = jQuery('#hdn_profile_id').val();

        jQuery.ajax({
            url: window.Laravel.url + '/ajaxrequest/like',
            type: 'POST',
            data: {'_token': window.Laravel.csrfToken, 'user':user_id },
            dataType: 'JSON',
            success: function (data) {
                if( data.status ){
                    jQuery('.match_btn').html('<i style="font-size:30px" class="fa fa-check-square-o" aria-hidden="true"></i> '+ data.matchcount +' Matches');
                    if( data.like ){
                        link_btn_obj.attr('data-liked-user',1);
                        link_btn_obj.html('<i style="font-size:30px" class="fa">&#xf087;</i> '+ data.likecount +' Likes');
                        $.notify("Liked successfully", "success");
                    }else{
                        link_btn_obj.attr('data-liked-user',0);
                        link_btn_obj.html('<i style="font-size:30px" class="fa">&#xf087;</i> '+ data.likecount +' Likes');
                        $.notify("Unliked successfully", "success");
                        modal_user_list_who_liked.modal('hide');
                    }

                }
            }
        });
    });


    modal_user_list_who_liked.on('shown.bs.modal', function (e) {

        jQuery('.modal_user_list_who_liked_loading').show();
        var user_id=jQuery('#hdn_profile_id').val();

        //jQuery('.modal_user_list_who_liked_container').html('');

        jQuery.ajax({
            url: window.Laravel.url + '/ajaxrequest/profile/'+user_id+'/users-who-liked',
            type: 'POST',
            data: {'_token': window.Laravel.csrfToken, 'user':user_id },
            dataType: 'JSON',
            success: function (response,textStatus,xhr) {

                var html = '';

                if(response.success) {
                    var users=response.info.users;

                    if(users.length>0) {
                        for(var i=0;i<users.length;i++)
                        {
                            html += '' +
                                '   <div class="col-md-4">'+
                                '       <div class="media">'+
                                '           <div class="media-left">'+
                                '               <a target="_blank" href="'+users[i].profile_url+'">'+
                                '                   <img class="media-object"  src="'+users[i].profile_pic_url+'" alt="Profile Image">'+
                                '               </a>'+
                                '           </div>'+
                                '           <div class="media-body">'+
                                '               <div class="media-heading">'+
                                '               <div class="custom-img">'+
                                '                   <a target="_blank" href="'+users[i].profile_url+'">'+
                                                        users[i].displayname+
                                '                   </a>'+
                                '               </div>'+
                                '               </div>'+
                                '           </div>'+
                                '       </div>'+
                                '   </div>';
                            /*if(i<users.length-1)
                                html+='<div class="row modal_user_list_who_liked_row_separator"></div>';*/
                        }
                    }

                    jQuery('.modal_user_list_who_liked_container').html(html);

                }
                else
                {
                    html = getAlertBoxHtmlContainingErrorsReturnedFromServer(response);

                    jQuery('.modal_user_list_who_liked_submit_msg').html(html);

                    modal_user_list_who_liked.animate({scrollTop: 0}, 'slow');
                }
            },
            error: function(xhr, textStatus, errorThrown) {

            },
            complete: function(xhr, textStatus) {
                jQuery('.modal_user_list_who_liked_loading').hide();
            }
        });

    });

    var modal_user_match   =   jQuery('#modal_user_match');

    jQuery('.match_btn').click(function(){

        var own_profile=parseInt(jQuery('#own_profile').val());
        var user_id = jQuery('#hdn_profile_id').val();

        //if(!own_profile) {
            jQuery.ajax({
                url: url_auth_check,
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    var html = '';

                    if(response.success) {

                        modal_user_match.modal('show');
                    }
                    else
                    {
                        $.notify("Please refresh page and login again.", "error");
                    }

                },
                error: function(xhr, textStatus, errorThrown) {

                },
                complete: function(xhr, textStatus) {

                },
                statusCode: {
                    401: function (response) {
                        $.notify("Please refresh page and login again.", "error");
                    }
                }
            });

        //}
    });

    modal_user_match.on('shown.bs.modal', function (e) {

        jQuery('.modal_user_match_loading').show();
        var user_id = jQuery('#hdn_profile_id').val();

        jQuery.ajax({
            url: window.Laravel.url + '/ajaxrequest/profile/'+user_id+'/match/me/',
            type: 'post',
            data: {'_token': window.Laravel.csrfToken, 'user':user_id },
            dataType: 'JSON',
            success: function (response) {
                console.log(response);
                var html = '';
                if(response.flag == 1){
                var users=response.info.profile_user;
                var authuser=response.info.match_user;

                html +='<div class="col-md-12 text-right"><a href="'+window.Laravel.url+'/mymatches" class="btn btn-primary">View Matches</a></div>';
                for(var i=0;i<5;i++)
                {
                    html += '<div class="row">'+
                                    '   <div class="col-xs-12 col-sm-4">'+
                                    '       <div class="thumbnail">'+
                                    '           <div class="img_cont">'+
                                    '               <img src="'+users[i].profile_pic_url+'" alt="...">'+
                                    '           </div>'+
                                    '           <div class="caption">'+
                                    '               <h5>'+users[i].displayname+'</h5>'+
                                    '           </div>'+
                                    '       </div>'+
                                    '   </div>'+
                                    '   <div class="col-xs-12 col-sm-4 text-center">'+
                                    '       <img src="'+window.Laravel.url+'/uploads/matches_icon.png" class="matchesIcon" />'+
                                    '   </div>'+
                                    '   <div class="col-xs-12 col-sm-4">'+
                                    '       <div class="thumbnail">'+
                                    '           <div class="img_cont">'+
                                    '               <img src="'+authuser[i].profile_pic_url+'" alt="...">'+
                                    '           </div>'+
                                    '           <div class="caption">'+
                                    '               <h5>'+authuser[i].displayname+'</h5>'+
                                    '           </div>'+
                                    '       </div>'+
                                    '   </div>'+
                                    '</div></div>';
                }
                jQuery('.modal_user_match_container').html(html);

                }else if(response.flag == 0){

                    if(response.success) {

                        if(response.message)
                        {
                            html+=''+
                                '<div class="alert alert-success alert-dismissible fade in" role=alert>'+
                                '   <p>'+response.message+'</p>'+
                                '</div>';
                        }
                        else
                        {
                            html+=''+

                                    '<div class="col-md-12"><div class="row alert alert-success">'+
                                    '   <p class="matchesMessage">Congratulation <b>'+response.info.match_user.displayname+', </b>You and <span>'+response.info.profile_user.displayname+'</span> are a match!</p>'+
                                    '     <p class="matchesMessage">Join '+response.info.profile_user.himHerStatus+' in a <a href="'+window.Laravel.url+'/chat">Chat</a>';
                                    if(response.info.profile_user.sentReqTrial == 1){
                                      html += '     or schedule a <a href="'+window.Laravel.url+'/schedule/'+response.info.profile_user.id+'">Trial Date</a> !';
                                      html += '   </p>'+
                                      '</div>';
                                    }else{

                                        if(response.info.profile_user.message != ''){
                                          html += '   </p>'+
                                          '</div>';
                                          html += '<div class="row alert alert-info">'+response.info.profile_user.message+
                                        '</div>';
                                      }else{
                                        html += '   </p>'+
                                        '</div>';
                                      }

                                    }

                                    html += '<div class="row">'+
                                    '   <div class="col-xs-12 col-sm-4">'+
                                    '       <div class="thumbnail">'+
                                    '           <div class="img_cont">'+
                                    '               <img src="'+response.info.profile_user.profile_pic_url+'" alt="...">'+
                                    '           </div>'+
                                    '           <div class="caption">'+
                                    '               <h5>'+response.info.profile_user.displayname+'</h5>'+
                                    '           </div>'+
                                    '       </div>'+
                                    '   </div>'+
                                    '   <div class="col-xs-12 col-sm-4 text-center">'+
                                    '       <img src="'+window.Laravel.url+'/uploads/matches_icon.png" class="matchesIcon" />'+
                                    '   </div>'+
                                    '   <div class="col-xs-12 col-sm-4">'+
                                    '       <div class="thumbnail">'+
                                    '           <div class="img_cont">'+
                                    '               <img src="'+response.info.match_user.profile_pic_url+'" alt="...">'+
                                    '           </div>'+
                                    '           <div class="caption">'+
                                    '               <h5>'+response.info.match_user.displayname+'</h5>'+
                                    '           </div>'+
                                    '       </div>'+
                                    '   </div>'+
                                    '</div></div>';
                        }

                        jQuery('.modal_user_match_container').html(html);

                        jQuery(".matchesAdoption-btn").click(function(){
                            jQuery("#modal_user_match").modal('hide');
                        });
                    }
                    else
                    {

                        html = getAlertBoxHtmlContainingErrorsReturnedFromServer(response);

                        jQuery('.modal_user_match_submit_msg').html(html);

                        modal_user_match.animate({scrollTop: 0}, 'slow');
                    }
                }
            },
            error: function(xhr, textStatus, errorThrown) {

            },
            complete: function(xhr, textStatus) {
                jQuery('.modal_user_match_loading').hide();
            },
            statusCode: {
                401: function (response) {
                    $.notify("Please refresh page and login again.", "error");
                }
            }
        });
    });




    jQuery('.addtowishlist').click(function(){
        var $this =  jQuery(this);
        var user_id = $this.data('user');
        jQuery.ajax({
           url: window.Laravel.url + '/ajaxrequest/addtowishlist',
           type: 'POST',
           data: {'_token': window.Laravel.csrfToken, 'user':user_id },
           dataType: 'JSON',
           success: function (data) {
                   if( data.iswished ){
                       $this.removeClass('fa-heart-o');
                       $this.addClass('fa-heart colorred');
                       $('.hearttext').html('Save Heart');
                       $.notify("Saved the user to your heart.", "success");
                   }else{
                       $this.removeClass('fa-heart colorred');
                       $this.addClass('fa-heart-o');
                       $('.hearttext').html('Add Heart');
                       $.notify("You've removed the user from your My Hearts", "success");
                   }
           }
        });
    });
    jQuery(".storetrial").click(function(){
    	var macherid = jQuery('#macher_id').val();
    	var trialid = jQuery('#trialid').val();
    	var date = jQuery('#datetimepicker1').val();
    	var time = jQuery('.time').val();
    	if( !date || !time ){
    	    $.notify("Please enter date and time to start trial", "error");
    	    return true;
    	}
    	var datetime = date+' '+time;
		jQuery.ajax({
           url: window.Laravel.url + '/trials/store',
           type: 'POST',
           data: {'_token': window.Laravel.csrfToken, 'macherid':macherid,'datetime':datetime, 'trialid': trialid},
           success: function (data) {
               var reponse = jQuery.parseJSON(data);
              if( reponse.status ){
                  $('#mytrial')[0].reset();
                  $.notify(reponse.msg, "success");
                  $('div#myModal').modal('hide');
              }else{
                  $.notify(reponse.msg, "error");
              }
           }
       });
    });

    jQuery('.show_error_if_found').click(function() {
        var error = jQuery(this).data('errormsg');
        var subnotrequired = jQuery(this).data('subnotrequired');
        if( error && subnotrequired != 1 ){
            $.notify(error, "error");
        }
    });

});
