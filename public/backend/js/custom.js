jQuery(document).ready(function(){
	// Top Right User Sub Menu
	jQuery('.username').click(function(){
		jQuery('.submenu').toggleClass('showsbmenu');
	});

	$("div.profile-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        console.log(index);
        $("div.profile-tab>div.profile-tab-content").removeClass("active");
        $("div.profile-tab>div.profile-tab-content").eq(index).addClass("active");
    });

    $(document).on("change",".selectanswertype", function() {
        var answertype = $(this).val();
        if( answertype == 2 || answertype == 3 || answertype == 5){
            var fetchhtml = getoptionhtml();
            var optionhtml = '<div class="newoptions">'+ fetchhtml +'<button type="button" class="btn btn-primary pull-right addmoreoptions"><i class="fa fa-plus"></i></button></div>';
            if( $(this).parents('.create').find('.newoptions').length == 0 ){
                $(this).parents('.create').append(optionhtml);
            }
        }else{
            $(this).parents('.create').find('.newoptions').remove();
        }
    });


    $(document).on("click",".addmorequestion", function() {
        var numItems = $('.create').length+1;

        $('.htmldata').append('<div class="create"><div class="form-group"><div class="row"><i class="fa fa-times removeQuestions"></i><div class="col-md-4"><label for="question">Question Title</label></div><div class="col-md-8"><input type="text" class="form-control" name="question['+numItems+'][title]"></div></div></div><div class="form-group"><div class="row"><div class="col-md-4"><label for="email">Answer Type</label></div><div class="col-md-8"> <select class="selectanswertype" name="question['+numItems+'][type]"><option value="1">Text</option><option value="2">Select</option><option value="3">checkbox</option><option value="4">Teaxtarea</option> </select></div></div></div></div>');
    });

    $(document).on("click",".addmoreoptions", function() {
        var fetchhtml = getoptionhtml();
        $(this).parents('.newoptions').append(fetchhtml);
    });

    $(document).on("click",".removeQuestions", function() {
        $(this).parents('.create').remove();
    });

    $(document).on("click",".removeoptions", function() {
        if( $(this).parents('.create').find('.newaddedoption').length > 1 ){
            $(this).parents('.newaddedoption').remove();
        }
    });

    $(document).on("click",".removeoptions", function() {

    });

    // Add minus icon for collapse element which is open by default
    $(".collapse.in").each(function () {
        $(this).siblings(".panel-heading").find(".fa").addClass("fa-minus").removeClass("fa-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function () {
        $(this).parent().find(".fa").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function () {
        $(this).parent().find(".fa").removeClass("fa-minus").addClass("fa-plus");
    });

    $(".announcementmessages").click(function(){
        var id = $(this).attr("close-id");
        $.ajax({
          url: window.Laravel.url + '/ajaxrequest/removeAnnouncement',
           type: 'POST',
           data: {'_token': window.Laravel.csrfToken, 'id':id },
           dataType: 'JSON',
           success: function (data) {
              var htmldata = '';
               if( data.status ){
                   console.log('Success');
               }
           }
        });
    });

    jQuery('.notify').click(function(){

        var id =  jQuery(this).attr('notify_id');
        jQuery.ajax({
           url: window.Laravel.url + '/ajaxrequest/notificationSeen',
           type: 'POST',
           data: {'_token': window.Laravel.csrfToken, 'id':id },
           dataType: 'JSON',
           success: function (data) {
               var htmldata = '';
               if( data.status ){
                   console.log('Success');
               }
           }
        });
    });
    jQuery('.envelopemessage').click(function(){

        var id =  jQuery(this).attr('envelope_id');
        jQuery.ajax({
           url: window.Laravel.url + '/ajaxrequest/envelopeMessageSeen',
           type: 'POST',
           data: {'_token': window.Laravel.csrfToken, 'id':id },
           dataType: 'JSON',
           success: function (data) {
               var htmldata = '';
               if( data.status ){
                   console.log('Success');
               }
           }
        });
    });

    jQuery('.heartneedseen').click(function(){
        var id =  jQuery(this).attr('heart_id');
        jQuery.ajax({
           url: window.Laravel.url + '/ajaxrequest/heartSeen',
           type: 'POST',
           data: {'_token': window.Laravel.csrfToken, 'id':id },
           dataType: 'JSON',
           success: function (data) {
               var htmldata = '';
               if( data.status ){
                   console.log('Success');
               }
           }
        });

    });


    jQuery('#reciever_ids').on('change', function(){
       var hiddenId =  jQuery('#hiddenid').val();
       alert(hiddenId);
       if(hiddenId<1){
           var textareaVal =  jQuery('.textareanote textarea').val();
           var reciever_ids =  jQuery('#reciever_ids').val();
           var SelectVal = jQuery('#noteselect').val();
           var note='';
           if(SelectVal){  note = SelectVal;  }
           else{  note = textareaVal;  }

           jQuery.ajax({
               url: window.Laravel.url + '/ajaxrequest/draftmessage',
               type: 'POST',
               data: {'_token': window.Laravel.csrfToken, 'id':reciever_ids, 'message':note },
               dataType: 'JSON',
               success: function (data) {
                   jQuery('#hiddenid').val(data);
               }
            });
       }
    });
    $('#myModalNote').on('click', '#subbtn', function(){
       var textareaVal =  jQuery('.textareanote textarea').val();
       var reciever_ids =  jQuery('#reciever_ids').val();
       var SelectVal = jQuery('#noteselect').val();
       var rowId =  jQuery('#hiddenid').val();
       var note='';
       if(SelectVal){  note = SelectVal;  }
       else{  note = textareaVal;  }
       jQuery.ajax({
           url: window.Laravel.url + '/ajaxrequest/usermessage',
           type: 'POST',
           data: {'_token': window.Laravel.csrfToken, 'id':reciever_ids, 'message':note, 'rowid':rowId },
           dataType: 'JSON',
           success: function (data) {
               var htmldata = '';
               if( data.status ){
                   console.log('Success');
               }
           }
        });

    });

    jQuery('.dropdown').on('show.bs.dropdown', function(e){
        jQuery(this).find('.dropdown-menu').first().stop(true, true).slideDown(500);
    });

    jQuery('.dropdown').on('hide.bs.dropdown', function(e){
        jQuery(this).find('.dropdown-menu').first().stop(true, true).slideUp(300);
    });

    jQuery('.matchseen').click(function(){
        var id =  jQuery(this).attr('match_id');
        jQuery.ajax({
           url: window.Laravel.url + '/ajaxrequest/matchSeen',
           type: 'POST',
           data: {'_token': window.Laravel.csrfToken, 'id':id },
           dataType: 'JSON',
           success: function (data) {
               var htmldata = '';
               if( data.status ){
                   console.log('Success');
               }
           }
        });
    });
});
var i =0;
function getoptionhtml(){
    //alert(i);
    var numItems = $('.create').length;
    i++;
    return '<div class="form-group newaddedoption"><div class="row"><div class="col-md-4"><i class="fa fa-times removeoptions"></i><label for="question">Options</label></div><div class="col-md-8"><input type="text" class="form-control" name="question[options][]"></div></div></div>';


}

function getGoup(user_group_id) {
     $.ajax({
       url: window.Laravel.url + '/frontend/getGroup/' + user_group_id ,
       type: 'POST',
       data: {'_token': $('input[name=_token]').val()},
       dataType: 'JSON',
       success: function (data) {
          var htmldata = '';
           if( data.status ){
              for (var i = 0; i < data.genderInfo.length; i++) {
                 htmldata += ' <input type="radio" name="gender" value="'+ data.genderInfo[i].id +'"> '+ data.genderInfo[i].title;
              }
              jQuery('#genderInfodisplay').html(htmldata);
           }
       }
   });
}

function getGenderInfo(user_group_id,gender_id) {

    $.ajax({
        url: window.Laravel.url + '/frontend/getGroup/' + user_group_id ,
        type: 'POST',
        data: {'_token': $('input[name=_token]').val()},
        dataType: 'JSON',
        success: function (data) {
            var htmldata = '';
            if( data.status ){
                for (var i = 0; i < data.genderInfo.length; i++) {
                    if(data.genderInfo[i].id==gender_id)
                        htmldata += ' <input type="radio" name="gender" value="'+ data.genderInfo[i].id +'" checked> '+ data.genderInfo[i].title;
                    else
                        htmldata += ' <input type="radio" name="gender" value="'+ data.genderInfo[i].id +'"> '+ data.genderInfo[i].title;
                }
                jQuery('#genderInfodisplay').html(htmldata);
            }
        }
    });
}


function deleteItem(item_id,action_url)
{
    if(typeof action_url=='undefined')
        action_url='';

    title='<div>Are you sure you want to delete? <br>This action cannot be undone and will delete all information.<div>';
    content='' +
        '<form name="frm_delete_item" id="frm_delete_item" method="post" action="'+action_url+'">' +
        '   <input type="hidden" name="_method" value="DELETE">'+
        '   <input type="hidden" name="hdn_item_id" value="'+item_id+'">' +
        '   <input type="hidden" name="_token" value="'+window.Laravel.csrfToken+'">'+
        //'   <h4>Please enter delete in capital letters to delete this item.</h4>'+
        '   <div class="form-group">'+
        '       <div class="error_class_div ">'+
        '           <input type="text" id="txt_ps_delete" name="txt_ps_delete" placeholder="Please enter delete in capital letters to delete this item." class="form-control">'+
        '           <span  class="help-block" style="display:none;">Please enter delete in capital letters.</span>'+
        '       </div>'+
        '   </div>' +
        '</form>';

    bootbox.dialog({
        message: content,
        title: title,
        buttons: {
            success: {
                label: "Ok",
                className: "btn-danger btn_ok",
                callback: function() {
                    var txt_ps_delete_obj=jQuery("#txt_ps_delete");
                    var val = txt_ps_delete_obj.val();

                    if (!val)
                    {
                        txt_ps_delete_obj.parents('.error_class_div').addClass('has-error');
                        jQuery('.help-block',txt_ps_delete_obj.parents('.error_class_div')).show();
                        return false;
                    }
                    else
                    {
                        if(val=='DELETE')
                        {
                            txt_ps_delete_obj.parents('.error_class_div').removeClass('has-error');
                            jQuery('.help-block',txt_ps_delete_obj.parents('.error_class_div')).hide();

                            jQuery('#frm_delete_item').submit();
                        }
                        else
                        {
                            txt_ps_delete_obj.parents('.error_class_div').addClass('has-error');
                            jQuery('.help-block',txt_ps_delete_obj.parents('.error_class_div')).show();
                            return false;
                        }
                    }
                }
            },
            danger: {
                label: "Cancel",
                className: "btn-warning",
                callback: function() {
                    return true;
                }
            }
        }
    });
}
$(document).on('keypress', '#frm_delete_item input', function(e) {

    if (e.which == 13) {

        $('.btn_ok',$(this).parents('.modal-dialog')).click();
        return false;
    }
});
