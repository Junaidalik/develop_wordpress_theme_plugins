let currentPage = 1;
$('#load-more').on('click', function() {
  currentPage++;

	      let data= $("#form_id").serialize();

  $.ajax({
    type: 'POST',
    url: 'admin_url',
    dataType: 'html',
    data: data,
    success: function (res) {
    //   $('.publication-list').append(res);
    }
  });
});

