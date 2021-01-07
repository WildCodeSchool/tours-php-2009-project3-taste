import $ from 'jquery';
var section = $('li');

function toggleAccordion() {
    section.removeClass('active');
    $(this).addClass('active');
}

section.on('click', toggleAccordion);