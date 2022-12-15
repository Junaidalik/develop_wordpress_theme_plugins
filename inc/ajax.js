(function ($) {
  Dropzone.autoDiscover = false;
  
  $(document).ready(function (e) {

    // <----------------------- search page function to get data from backend and load more button ---------------->

    // e.preventDefault();
    // $('#load_more').on('click',my_function)
    $("#load_more").click(my_function);
    $(window).on("load", my_function);


    //  <---------------- function on form submit create post on backend ---------------->
    $("#control_form_id").on('submit' , function(e){

       e.preventDefault();
      let control_form_data = $("#control_form_id").serialize();
      // console.log("hey here is ?");
      $.ajax({
        method: "POST",
        url: php_data.admin,
        data: {
          form_data: control_form_data,
          action: "widget_action",
        },
        success: function (res) {
            // console.log(res)
        },
      });
    
    });


  // <--------------------------  dropzone start  -------------------------------->

    var acceptedFileTypes = "image/*";
    var fileList = new Array;
    var i = 0;
    var ajax_url = php_data.admin;

    $("#event_dropzone").dropzone({
        addRemoveLinks: true,
        paramName: "my_file_upload",
        url: ajax_url + "?action=upload_sb_pro_events_images&is_update=" + $('#is_update').val(),
        parallelUploads: 5,
        dictRemoveFileConfirmation: null,
        
        init: function () {
          
            var thisDropzone = this;
            // <----------------- get from backend image functionality ----------------------->
            $.post(ajax_url, {action: 'get_event_images', is_update: $('#is_update').val()}).done(function (res)
            {

               data = res.data.images;
            
                if (data != 0)
                {
                    $.each(data, function (key, value) {

                        var mockFile = {name: value.dispaly_name, size: value.size};

                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);

                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.name);
                        $('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", value.id);
                        i++;
                        $(".dz-progress").remove();
                    });
                }
                if (i > 0)
                    $('.dz-message').hide();
                else
                    $('.dz-message').show();
            });

            this.on("addedfile", function (file) {
                $('.dz-message').hide();
            });
            this.on("success", function (file, responseText) {
              
                if (responseText.success == true)
                {
                    $('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", responseText);
                    i++;
                    $('.dz-message').hide();
                } else
                {
                    if (i == 0)
                        $('.dz-message').show();
                    this.removeFile(file);
                    alert(responseText.data.message);
                }

            });
            // <----------------- Remove image functionality ----------------------->
            this.on("removedfile", function (file) {

                var img_id = file._removeLink.attributes[2].value;
                // console.log(img_id);
                if (img_id != "")
                {
                    i--;
                    if (i == 0)
                        $('.dz-message').show();
                    $.post(ajax_url, {action: 'delete_event_image', img: img_id, is_update: $('#is_update').val(), }).done(function (response)
                    {
                        if ($.trim(response) == "1")
                        {
                            //   $("#listing_msgz").hide();
                            this.removeFile(file);
                        }
                    });
                }
            });
            this.on("maxfilesexceeded", function (file) {
                alert('can upload only one image');
                this.removeFile(file);
            });
        },
    });

      // <---------------------------------- dropzone end ---------------------------------->

      // <--------------- function on title field onblur event create post on backend -------------->

      $( "#title" ).blur(function(e){

        // alert("here is blur fucn");

        e.preventDefault();
       let control_field_data = $("#title").serialize();
       // console.log("hey here is ?");
       $.ajax({
         method: "POST",
         url: php_data.admin,
         data: {
           form_data: control_field_data,
           action: "title_action",
         },
         success: function (res) {
             // console.log(res)
         },
       });
     
     });

      



  });

  // <------------------------------------- function for page-search ------------------------>

  let my_function = function () {
    let form_data = $("#form_id").serialize();

    let page = $("#page_no").val((cur, pre) => {
      return ++pre;
    });
    // console.log("here the val",page)

    if ($("#page_no").val() - 1 == $("#total_pages").val()) {
      // document.querySelector('#load_more').style.display = "none";
      $("#load_more").css({ display: "none" });
    }
    // console.log('qwerty k');

    $.ajax({
      method: "POST",
      url: php_data.admin,
      data: {
        form_data: form_data,
        action: "my_action",
      },
      success: function (res) {
        $("#properties_div").html((cur, pre) => {
          // console.log(pre)
          pre += res;
          return pre;
        });
      },
    });
  };


    




})(jQuery);



