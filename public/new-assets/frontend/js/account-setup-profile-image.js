
    jQuery(document).ready(function(){

        var profile_image_crop_container    =       jQuery('#profile_image_crop_container');
        var modal_upload_profile_image      =       jQuery('#modal_upload_profile_image');
        var profile_image_preview_container =       jQuery('#profile_image_preview_container');
        var file_profile_image_input        =       jQuery('#file_profile_image');

        var btn_upload                      =       jQuery('.btn_profile_image_upload');
        var btn_preview                     =       jQuery('.btn_profile_image_preview');
        var btn_cancel                      =       jQuery('.btn_profile_image_cancel');
        var btn_open_modal                  =       jQuery('#btn_open_modal_upload_profile_image');


        modal_upload_profile_image.on('shown.bs.modal', function (e) {

            var view_port_width=200;
            var profile_image_crop_container_parent_width;

            profile_image_crop_container_parent_width=profile_image_crop_container.parent().width();

            //if(profile_image_crop_container_parent_width<=200)
            profile_image_crop_container_parent_width=240;

            profile_image_crop_container.width(profile_image_crop_container_parent_width);

            profile_image_preview_container.width(profile_image_crop_container_parent_width);
            profile_image_preview_container.height(profile_image_crop_container_parent_width);

            if(typeof $uploadCrop!="undefined")
                $uploadCrop.croppie('destroy');

            $uploadCrop = profile_image_crop_container.croppie({
                enableExif: true,
                viewport: {
                    width: view_port_width,
                    height: view_port_width
                    //type: 'circle'
                },
                boundary: {
                    width: profile_image_crop_container_parent_width,
                    height:profile_image_crop_container_parent_width
                }
            });
        });

        modal_upload_profile_image.on('hidden.bs.modal', function () {
            btn_upload.hide();
            btn_preview.hide();
            $('.cr-image').removeAttr("src");
            profile_image_preview_container.html("");
            $('.frm_account_setup_profile_image_submit_msg').html('');
            file_profile_image_input.closest('.fileinput').wrap('<form>').closest('form').get(0).reset();
            file_profile_image_input.closest('.fileinput').unwrap();
            $('#hdn_image_uploaded').valid();
        });

        var selected_file_name="";

        file_profile_image_input.on('change', function (){

            var reader = new FileReader();

            reader.fileName = this.files[0].name;
            reader.onload = function (e){

                selected_file_name=e.target.fileName;
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function (){
                    console.log('jQuery bind complete');
                });
            };

            reader.readAsDataURL(this.files[0]);
            btn_preview.show();

        });


        btn_upload.on('click', function (ev){

            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp){

                $.ajax({
                    url: account_setup_profile_image_by_string_submit_url,
                    type: "POST",
                    data: {"selected_file_name":selected_file_name,"image": resp},
                    headers: { 'X-CSRF-TOKEN' : csrf_token },
                    success: function (response){

                        var html='';

                        if(response.success)
                        {
                            html+=''+
                                '<div class="alert alert-success alert-dismissable">'+
                                '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'+
                                response.message +
                                '</div>';

                            jQuery('.frm_account_setup_profile_image_submit_msg').html(html);

                            $('img',$('.profile_image_display_container')).prop('src',image_folder_url+'/'+response.image_path);

                            modal_upload_profile_image.animate({ scrollTop: 0 }, 'slow');
                            jQuery('#hdn_image_uploaded').val(1);

                            setTimeout(function(){

                                modal_upload_profile_image.modal('hide');
                            },3000);

                        }
                        else
                        {
                            html=getAlertBoxHtmlContainingErrorsReturnedFromServer(response);

                            jQuery('.frm_account_setup_profile_image_submit_msg').html(html);

                            modal_upload_profile_image.animate({ scrollTop: 0 }, 'slow');

                        }
                    }
                });
            });
        });

        btn_preview.on('click', function (ev){

            var html='';
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp){

                html = '<img src="' + resp + '" />';
                profile_image_preview_container.html(html);
                btn_upload.show();

            });

        });

        btn_open_modal.on('click',function(){
            modal_upload_profile_image.modal('show');
        });


        btn_cancel.on('click', function (ev){
            modal_upload_profile_image.modal('hide');

        });
    });