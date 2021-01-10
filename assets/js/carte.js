import $ from 'jquery';

const section = $('li');

function toggleAccordion() {
    section.removeClass('active');
    $(this).addClass('active');
}

section.on('click', toggleAccordion);
