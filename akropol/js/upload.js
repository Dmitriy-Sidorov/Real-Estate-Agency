/*множественная загрузка изображений*/
jQuery(function(jQuery) {
  jQuery('.custom_upload_file_button').click(function() {
    formfield = jQuery(this).siblings('.custom_upload_image');
    preview = jQuery(this).siblings().parent("div").siblings();;
    console.log(preview);
    tb_show('', 'media-upload.php?type=file&TB_iframe=true');
    window.send_to_editor = function(html) {
      fileUrl = jQuery(html).attr('src');
      fileName = jQuery(html).text();
      formfield.val(fileUrl);
      preview.attr('src', fileUrl);
      tb_remove();
    }
    return false;
  });

  jQuery('.repeatable-add').click(function() {
    field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
    fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
    jQuery('img', field).attr('src', "http://placehold.it/100x100");
    console.log(field);
    jQuery('input', field).val('').attr('name', function(index, name) {
      return name.replace(/(\d+)/, function(fullMatch, n) {
        return Number(n) + 1;
      });
    })
    field.insertAfter(fieldLocation, jQuery(this).closest('td'))
    return false;
  });

  jQuery('.repeatable-remove').click(function(){
    jQuery(this).parent().parent().remove();
    return false;
  });

  jQuery('.custom_repeatable').sortable({
    opacity: 0.6,
    revert: true,
    cursor: 'move',
    handle: '.sort'
  });

});