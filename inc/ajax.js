(function ($) {

  $(document).ready(function () {
   
  $('#load_more').on('click',function(){
      
   let form_data = $('#form_id').serializeArray()
   let page = $('#page_no').val((c,p)=>{
    return ++p;
   });
   let data = {};
   $.each(form_data, function (i, field) {
       data[field.name] = field.value;
   });
   
    console.log(form_data);
         
          $.ajax({
            method: 'POST',
            url: php_data.admin,
            data: {
              ...data, 
              action:'my_action'
            },
            success: function (res) {
              
              $('#properties_div').html((cur,pre)=>{
               // console.log(pre)
                pre += res;
                return pre;
              });
            }
  });
     
  });

});

})(jQuery);

