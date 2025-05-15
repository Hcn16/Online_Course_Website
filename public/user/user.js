// inputdocument.addEventListener('DOMContentLoaded', () => {
//     const form = document.querySelector('form');
//     form.addEventListener('submit', (event) => {
//         const email = form.querySelector('input[type="email"]').value;
//         if (!email.includes('@')) {
//             alert('Please enter a valid email address.');
//             event.preventDefault();
//         }
//     });
// });


////course_exercise
$('#exercise').click(function() {
    $(this).addClass('active')
    $('#exercise_done').removeClass('active')
    $('.exercise_done').css('display', 'none');
    $('.exercise').css('display', 'block');
})
$('#exercise_done').click(function() {
    $(this).addClass('active')
    $('#exercise').removeClass('active')
    $('.exercise_done').css('display', 'block');
    $('.exercise').css('display', 'none');
})
/////-------------------//////

//////course_document
$('#content_course').click(function() {
    $(this).addClass('active')
    $('#file').removeClass('active')
    $('.file').css('display', 'none');
    $('.content_course').css('display', 'block');
})
$('#file').click(function() {
    $(this).addClass('active')
    $('#content_course').removeClass('active')
    $('.file').css('display', 'block');
    $('.content_course').css('display', 'none');
})

/////////