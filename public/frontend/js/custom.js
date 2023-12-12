$(document).ready(function() {

    

    //for owl crousel//

    	jQuery('.username').click(function(){

		jQuery('.submenu').toggleClass('showsbmenu');

	});	



        var owl = $('.owl-carousel');

              owl.owlCarousel({

                margin: 10,
                stagePadding: 50,

                nav: true,

                loop: true,

                responsive: {

                  0: {

                    items: 1

                  },

                  600: {

                    items: 3

                  },

                  1000: {

                    items: 6

                  }

                }

              })

           

    

    $.ajaxSetup({

        headers: {

            'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    

    $("#myForm").submit(function(e) {

       $('#myForm input').parent().removeClass('has-error');

       $('#myForm .invalid-feedback strong').text('');

       

          e.preventDefault();

          var formData = $("#myForm").serialize();

           $.ajax({

                 url: window.Laravel.url + '/register',

                 type:'POST',

                 data:formData,

                 success:function(data){

                   console.log(data);

                   $(".result").html(data);

                   $('#myForm').trigger('reset');

                  

                 },

                 error: function(data){

                 var errors = data.responseJSON;

                 

                  $.each( errors.errors, function( key, value ) {

                    var input = '#myForm input[name=' + key + ']';

                        $(input + '+span>strong').text(value[0]);

                        $(input).parent().addClass('has-error');

                    });

                }

         });

    });

    

    jQuery('#searchbtn').click(function(){

        var formdata = jQuery('#searchform').serialize();

        $.ajax({

            type: 'POST',

            url: window.Laravel.url + '/ajaxrequest/savesearchresult',

            data: formdata, // here $(this) refers to the ajax object not form

            success: function (data) {

               

            },
            complete:function(){
                jQuery('#searchform').submit();
            }

        });

    });

    jQuery('#searchbtnpublic').click(function(){

        jQuery('#searchform').submit();

    });



    

    jQuery('#newsletter_button').click(function(){

          var email = $(".subcribe_input").val();

          if(email==''){

              $('input.subcribe_input').css('border','2px solid red');

              $.notify("Please enter your email", "danger");

          }

          else{

              $('input.subcribe_input').css('border','2px solid transparent');

           $.ajax({

                 url: window.Laravel.url + '/newsletter',

                 type:'post',

                 data: {'_token': window.Laravel.csrfToken, 'email':email },

                 dataType: 'JSON',

                 success:function(data){

                   console.log(data);

                   $(".subcribe_input").val('');

                   $.notify("You have subscribed successfully", "success");

                 },

                 error: function(data){

                     $.notify("Error While Subriber", "error");

                }

            });

          }

    });

    

    

});



function filterusers() {

    var group = document.getElementById('user_group').value;

    var gender = document.getElementById('genderInfodisplay').value;

    $.ajax({

       url: window.Laravel.url + '/ajaxrequest/filteruser',

       type: 'POST',

       data: {'_token': $('input[name=_token]').val(), 'group': group, 'gender': gender},

       dataType: 'JSON',

       success: function (data) {

          var htmldata = '';

           if( data.status ){

               $('#filterusersdata').html(data.htmlinfo);

           }

       }

   });

}



function getGoup(user_group_id, type = 'radio') { 

    $.ajax({

       url: window.Laravel.url + '/frontend/getGroup/' + user_group_id ,

       type: 'POST',

       data: {'_token': $('input[name=_token]').val()},

       dataType: 'JSON',

       success: function (data) {

          var htmldata = '';

           if( data.status ){

                for (var i = 0; i < data.genderInfo.length; i++) {

                    if( type == 'select'){

                        htmldata += '<option value="'+ data.genderInfo[i].id +'">'+ data.genderInfo[i].title + '</option>';

                    }else{

                        htmldata += ' <input type="radio" name="gender" value="'+ data.genderInfo[i].id +'"> '+ data.genderInfo[i].title;

                    }

                }

              jQuery('#genderInfodisplay').html(htmldata);  

              if( type == 'select'){

                  filterusers();

              }

           }

       }

   });

}





















