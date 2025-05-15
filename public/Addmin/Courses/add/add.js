$(".tag_select_choose").select2({
    tags: true,
    tokenSeparators: [',','']
});

$(".selectParent").select2({
    placeholder: "Select a state",
    allowClear: true
});


$(".selectParent2").select2({
    placeholder: "Select a state",
    allowClear: true
});


$(".selectParent3").select2({
   
    allowClear: false
});



$(document).ready(function() { $('.back').click(function() { history.back(); }); });





