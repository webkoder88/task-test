$(function () {
  $('.edit-task').on('click', function () {
    let id = $(this).attr('data-id');
    let name = $(this).attr('data-name');
    let email = $(this).attr('data-email');
    let description = $(this).attr('data-description');
    let completed = $(this).attr('data-completed');

    $('#update-form').show();

    $('#u-id').val(id);
    $('#u-name').val(name);
    $('#u-email').val(email);
    $('#u-description').val(description);

    if(completed === '1'){
      $('#u-completed').prop('checked', true);
    }else{
      $('#u-completed').prop('checked', false);
    }

  });
  $('#update-close').on('click', () => {
    $('#update-form').hide();
  });
  $('.remove-task').on('click',function () {
    if(confirm('Are you really want to delete this item ?')){
      $(this).next().submit();
    }
  })
});
