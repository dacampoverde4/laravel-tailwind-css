

    var AccountSetupStep2FormValidation = function() {

        // Apply validation logic on property create form
        var handleValidation = function() {

            var formObj=$('#frm_account_setup_step2');
            var error = $('.alert-danger', formObj);
            var success = $('.alert-success', formObj);
            var errorContainer=$('.frm_account_setup_step2_error_msg', formObj);


            formObj.validate({
                ignore: "", // validate all fields including form hidden input
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                errorContainer: errorContainer,
                errorLabelContainer: $("div", errorContainer),
                //wrapper: 'div',
                rules: {
                    hdn_image_uploaded: {
                        required: true,
                        normalizer: function(value) {
                            return $.trim(value);
                        },
                        profile_image_uploaded_check:function(){ return {
                            'profile_image_uploaded_check_value':jQuery('#hdn_image_uploaded').val()
                        };
                        },
                    },
                    about: {
                        required: true,
                        minlength: 3,
                        normalizer: function(value) {
                            return $.trim(value);
                        }
                    },
                    "my_funs[]": {
                        required: true,
                        minlength: 1
                    }
                },
                messages: { // custom messages for radio buttons and checkboxes
                    hdn_image_uploaded: {
                        required: "Please upload profile image."
                    },
                    about: {
                        required: "Please provide about text.",
                        minlength: "Please enter at least three characters for about text."
                    },
                    "my_funs[]": "Please select at least one fun."

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
                        url:       account_setup_step_2_submit_url  ,       // override for form's 'action' attribute
                        //type:      'post'  ,      // 'get' or 'post', override for form's 'method' attribute
                        dataType:   'json',     // 'xml', 'script', or 'json' (expected server response type)

                        // $.ajax options can be used here too, for example:
                        //timeout:   3000,
                        success: function(response, textStatus, xhr, form) {

                            var html='';

                            if(response.success)
                            {
                                html+=''+
                                    '<div class="alert alert-success alert-dismissable">'+
                                    '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+
                                    response.message +
                                    '</div>';

                                jQuery('.frm_account_setup_step2_submit_msg',jQuery(form)).html(html);

                                setTimeout(function(){
                                    location.href=home_url;
                                },2000);

                            }
                            else
                            {
                                html=getAlertBoxHtmlContainingErrorsReturnedFromServer(response);

                                jQuery('.frm_account_setup_step2_submit_msg',jQuery(form)).html(html);

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

        $('.frm_account_setup_step2_error_msg .close').on('click',function(){
            $(this).parent().hide();
        });

        jQuery.validator.addMethod("profile_image_uploaded_check", function (value, element, params){

            var profile_image_uploaded_check_value=0;
            if(typeof params.profile_image_uploaded_check_value !='undefined')
                profile_image_uploaded_check_value=params.profile_image_uploaded_check_value;

            if(profile_image_uploaded_check_value==0)
            {
                $.validator.messages["profile_image_uploaded_check"] = "Please upload profile image.";
                return false;

            }

            return true;

        }, jQuery.validator.format("Please enter the correct value"));



        AccountSetupStep2FormValidation.init();

    });