
	
	  // for tab selection //

    
    // for drag drop images // 
     Dropzone.options.imageUpload = {
            maxFilesize  : 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            maxFiles: 1,
            success: function(file, response) {
              //alert(response);
              var error = '';
              var obj = JSON.parse(response);
              error = response;
              
              if(obj.error_upgrade){
                error = obj.error_upgrade+" <a class='btn btn-success btnupgrd' href='"+window.Laravel.url + '/pricing'+"'>Upgrade</a>";
              }
              if(obj.error_fupgrade){                
                error = obj.error_fupgrade+" <a class='btn btn-success btnupgrd' href='"+window.Laravel.url + '/pricing'+"'>Upgrade</a>";
              }
              if(obj.error_normal){                
                error = obj.error_normal;
              }

              $('.modal-body .error_sec').html('<h4 class="hideresponse alert alert-danger">'+ error +'</h4>');
              setTimeout(function(){
                $('.hideresponse').remove();
              }, 2500);
              
              setTimeout(function(){
                location.reload();
              }, 2500);
            }
        };
        


      // for reset the model //  
       $('#myModal').on('hidden.bs.modal', function () {
           location.reload();
           
      
});

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

$("div.profile-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.profile-tab>div.profile-tab-content").removeClass("active");
        $("div.profile-tab>div.profile-tab-content").eq(index).addClass("active");
    });


