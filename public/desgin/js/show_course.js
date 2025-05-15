
///show Course


$('.arrow1').on('click', function toggleContent() {
    var arrow = $(this);

    var content = arrow.parents('.title').find('.content');
    console.log(arrow.attr('class'));
    if (content.css('display') === 'none') {
        content.css('display', 'block');
        arrow.parents('.title').find('.arrow').addClass('down');
    } else {
        content.css('display', 'none');
        arrow.parents('.title').find('.arrow').removeClass('down');
    }
});


