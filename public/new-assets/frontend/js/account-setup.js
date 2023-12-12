
    function fillGenderSelectValues(user_group_id) {

        var html = '';

        html = '' +
            '<select name="gender" id="gender">';

        if (typeof user_groups_gender_family_roles_json['user_group_' + user_group_id] != 'undefined') {
            var user_group = user_groups_gender_family_roles_json['user_group_' + user_group_id];

            var i = 0;
            var selected_gender_role_id = 0;
            for (var a in  user_group.gender_roles) {
                if (user_group.gender_roles.hasOwnProperty(a)) {
                    if (i == 0) {
                        selected_gender_role_id = user_group.gender_roles[a].id;
                    }
                    html += '' +
                        '<option value="' + user_group.gender_roles[a].id + '">' + user_group.gender_roles[a].title + '</option>';
                }
                i++;
            }

        }

        html += '' +
            '</select>';

        jQuery('.account_setup_gender_cont').html(html);

        setFamilyRolesHtml(user_group_id, selected_gender_role_id);

    }

    function setFamilyRolesHtml(user_group_id, gender_role_id) {

        var user_group = null;
        var gender_role = null;

        if (typeof user_groups_gender_family_roles_json['user_group_' + user_group_id] != 'undefined') {
            user_group = user_groups_gender_family_roles_json['user_group_' + user_group_id];

            if (typeof user_group.gender_roles['gender_role_' + gender_role_id] != 'undefined') {
                gender_role = user_group.gender_roles['gender_role_' + gender_role_id];

            }
        }

        var html = '';
        if (user_group && gender_role) {
            for (var a in  user_group.family_roles) {

                if (user_group.family_roles.hasOwnProperty(a)) {

                    var family_role = user_group.family_roles[a];

                    if (family_role.gender == gender_role.gender) {

                        html += '' +
                            '<div class="col-md-4">' +
                            '   <div class="input_group cl_ble">' +
                            '       <a href="javascript:void(0);" data-color="success" class="btn btn-primary btn_family_role">' +
                            '           <i class="fa fa-square-o"></i>' + family_role.title +
                            '       </a>' +
                            '       <input name="family_roles[]" id="family_role_'+family_role.id+' " type="checkbox" class="hidden" value="'+family_role.id+'" />' +
                            '   </div>' +
                            '</div>';

                    }
                }
            }

            jQuery('.btn_family_role_row').html(html);
        }
    }

    function fillAgeSelectValues(user_group_id) {

        var html = '';

        html = '' +
            '<select name="age" id="age">';

        if (typeof user_groups_gender_family_roles_json['user_group_' + user_group_id] != 'undefined') {
            var user_group = user_groups_gender_family_roles_json['user_group_' + user_group_id];

            var min_age = parseInt(user_group.minage);
            var max_age = parseInt(user_group.maxage);

            if (min_age && max_age) {

                for (var i = min_age; i <= max_age; i++) {
                    html += '' +
                        '<option value="' + i + '">' + i + '</option>';
                }
            }

        }

        html += '' +
            '</select>';

        jQuery('.account_setup_age_cont').html(html);

    }

    $(document).ready(function() {

        var user_name_availability_check_time_out = null; // this used for hold few seconds to made ajax request

        var loading_html = '<i class="fa fa-spinner"></i>'; // just an loading image or we can put any texts here

        //when button is clicked
        $('#user_name').keyup(function(e){

            // when press the following key we need not to make any ajax request, you can customize it with your own way
            switch(e.keyCode)
            {
                //case 8:   //backspace
                case 9:     //tab
                case 13:    //enter
                case 16:    //shift
                case 17:    //ctrl
                case 18:    //alt
                case 19:    //pause/break
                case 20:    //caps lock
                case 27:    //escape
                case 33:    //page up
                case 34:    //page down
                case 35:    //end
                case 36:    //home
                case 37:    //left arrow
                case 38:    //up arrow
                case 39:    //right arrow
                case 40:    //down arrow
                case 45:    //insert
                    //case 46:  //delete
                    return;
            }
            if (user_name_availability_check_time_out != null)
                clearTimeout(user_name_availability_check_time_out);
            user_name_availability_check_time_out = setTimeout(accountSetupUserNameAvailabilityCheck, 1000);  // delay delay ajax request for 1000 milliseconds
            //$('#user_msg').html(loading_html); // adding the loading text or image


        });
    });
    function accountSetupUserNameAvailabilityCheck(){


        $('.account_setup_user_name_msg').html('');

        //get the username
        var user_name = $('#user_name').val();

        if(user_name) {

            jQuery('.account_setup_user_name_loader').show();

            //make the ajax request to check is username available or not

            jQuery.ajax({
                url: user_name_availability_check_url,
                type: "post",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'user_name': user_name
                },
                dataType: 'json',
                success: function (response) {
                  $('.text-danger').html('');
                  $('.account_setup_user_name_msg_success').html('');

                    if (response.success) {
                        $('.account_setup_user_name_msg_success').html('<span class="text-success">Username available</span>');
                        jQuery('#user_name_check_value').val(2);
                        $('#user_name').valid();

                    }
                    else {
                        jQuery('#user_name_check_value').val(1);
                        $('.text-danger').html(response.errors.displayname);
                        $('#user_name').valid();
                    }
                },
                error: function (xhr, textStatus, errorThrown) {

                },
                complete: function (xhr, textStatus) {
                    jQuery('.account_setup_user_name_loader').hide();
                }
            });
        }

    }

    var AccountSetupFormValidation = function() {

        // Apply validation logic on property create form
        var handleValidation = function() {

            var formObj=$('#frm_account_setup');
            var error = $('.alert-danger', formObj);
            var success = $('.alert-success', formObj);
            var errorContainer=$('.frm_account_setup_error_msg', formObj);


            formObj.validate({
                ignore: "", // validate all fields including form hidden input
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: true, // do not focus the last invalid input
                errorContainer: errorContainer,
                errorLabelContainer: $("div", errorContainer),
                //wrapper: 'div',
                rules: {
                    user_group: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                    },
                    user_name: {
                        required: true,
                        username_availability_check:function(){ return {
                            'username_availability_check_value':jQuery('#user_name_check_value').val()
                            };
                        },
                    },
                    "family_roles[]": {
                        required: true,
                        minlength: 1
                    }

                },
                messages: { // custom messages for radio buttons and checkboxes
                    user_group: {
                        required: "Please choose user group."
                    },
                    user_name: {
                        required: "Please provide username."
                    },
                    "family_roles[]": "Please select at least one family role."

                },
                invalidHandler: function(event, validator) { //display error alert on form submit
                    //$('.alert-danger', $('.login-form')).show();
                },
                highlight: function(element) { // highlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group

                },
                success: function(label) {
                    //console.log(label);
                    label.closest('.form-group').removeClass('has-error');
                    label.remove();
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.input-icon'));
                },
                submitHandler: function (form) {

                    success.show();
                    error.hide();
                    //form.submit(); // submit the form

                    var html='';
                    html+=''+
                        '<div class="alert alert-info">'+
                        '   Please wait! This may take a little time. ' +
                        '   <i class="fa fa-spinner fa-spin" style=""></i>'+
                        '</div>';

                    jQuery('.frm_account_setup_submit_msg',jQuery(form)).html(html);
                    //jQuery('.btn_account_setup_next').prop('disabled', true);

                    jQuery(form).ajaxSubmit({


                        // other available options:
                        url:       account_setup_submit_url  ,       // override for form's 'action' attribute
                        //type:      'post'  ,      // 'get' or 'post', override for form's 'method' attribute
                        dataType:   'json',     // 'xml', 'script', or 'json' (expected server response type)

                        // $.ajax options can be used here too, for example:
                        //timeout:   3000,
                        success: function(response, textStatus, xhr, form) {



                            var html='';

                            if(response.success)
                            {
                                                                console.log("response");

                                html+=''+
                                    '<div class="alert alert-success alert-dismissable">'+
                                    '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+
                                    response.message +
                                    '</div>';

                                jQuery('.frm_account_setup_submit_msg',jQuery(form)).html(html);

                                setTimeout(function(){
                                    location.href=account_setup_profile_info_url;
                                },2000);

                            }
                            else
                            {
                                console.log("error",response.errors);

                                html=getAlertBoxHtmlContainingErrorsReturnedFromServer(response);

                                jQuery('.frm_account_setup_submit_msg',jQuery(form)).html(html);

                                // jQuery('.frm_account_setup_error_msg_').show();
                                jQuery('.frm_account_setup_submit_msg').show();

                            }

                        },
                        error: function(xhr, textStatus, errorThrown) {

                        },
                        complete: function(xhr, textStatus) {
                            jQuery('.btn_account_setup_next').prop('disabled', false);
                        }
                    });


                    // !!! Important !!!
                    // always return false to prevent standard browser submit and page navigation
                    return false;

                }

            });

            $('input',formObj).keypress(function(e) {
                if (e.which == 13) {
                    if (formObj.validate().form()) {
                        formObj.submit();
                    }
                    return false;
                }
            });

            formObj.trigger('reset');
            //console.log('enter');


        };

        return {
            //main function to initiate the module
            init: function() {

                handleValidation();

            }
        };
    }();



    jQuery(document).ready(function () {

        $('.frm_account_setup_error_msg .close').on('click',function(){
            $(this).parent().hide();
        });

        jQuery.validator.addMethod("username_availability_check", function (value, element, params){

            var username_availability_check_value=0;
            if(typeof params.username_availability_check_value !='undefined')
                username_availability_check_value=params.username_availability_check_value;

            if(username_availability_check_value==0)
            {
                $.validator.messages["username_availability_check"] = "Please enter valid username.";
                return false;

            }
            else if(username_availability_check_value==1)
            {
                $.validator.messages["username_availability_check"] = "Username not available.";
                return false;

            }

            return true;

        }, jQuery.validator.format("Please enter the correct value"));

        jQuery(".account_setup_gender_cont").on("change", "#gender", function () {

            var gender_role_id = jQuery(this).val();
            var user_group_id = 0;

            jQuery('.account_setup_user_group').each(function () {

                if (jQuery(this).is(':checked')) {
                    user_group_id = jQuery(this).val();
                }
            });

            setFamilyRolesHtml(user_group_id, gender_role_id);

        });

        jQuery(".btn_family_role_row").on("click", ".btn_family_role", function () {

            var btn_parent = jQuery(this).parent();
            var check_box_obj = jQuery('input:checkbox', btn_parent);

            if (check_box_obj.is(':checked')) {
                check_box_obj.prop('checked', false);
            }
            else {
                check_box_obj.prop('checked', true);
            }

            if (check_box_obj.is(':checked')) {
                jQuery(this).removeClass('btn-primary');
                jQuery(this).addClass('btn-success');
                jQuery('i', jQuery(this)).removeClass('fa-square-o');
                jQuery('i', jQuery(this)).addClass('fa-check-square-o')
            }
            else {
                jQuery(this).addClass('btn-primary');
                jQuery(this).removeClass('btn-success');
                jQuery('i', jQuery(this)).addClass('fa-square-o');
                jQuery('i', jQuery(this)).removeClass('fa-check-square-o')
            }

            $('input[name="family_roles[]"]').valid();


        });

        jQuery('.account_setup_user_group').each(function () {

            jQuery(this).click(function () {

                if (jQuery(this).is(':checked')) {
                    jQuery('.account_setup_second_sec').show();
                    var user_group_name = jQuery(this).data('user-group-name');
                    var html = '';
                    html = 'You\'ve successfully activated your <b>User Group</b>, and you\'re now a<span>' + user_group_name + '</span>.';
                    jQuery('.account_setup_user_group_selected_success_msg p').html(html);

                    fillGenderSelectValues(jQuery(this).val());
                    fillAgeSelectValues(jQuery(this).val());
                }

            });

        });

        AccountSetupFormValidation.init();
    });
