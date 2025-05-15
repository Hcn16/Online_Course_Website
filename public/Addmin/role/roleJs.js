
$('.input_role').on('click', function(){               
    $(this).parents('.card').find('.input_item').prop('checked', $(this).prop('checked'));
});
