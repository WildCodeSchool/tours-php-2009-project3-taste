/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../styles/caterer.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

$('form input').on('blur input focus', function() {
    let $field = $(this).closest(".A, .B, .C, .D, .E, .F, .G, .H, .I");
    if (this.value) {
        $field.addClass("filled");
    } else {
        $field.removeClass("filled");
    }
});

$('form input').on('focus', function() {
    let $field = $(this).closest(".A, .B, .C, .D, .E, .F, .G, .H, .I");
    if (this) {
        $field.addClass("filled");
    } else {
        $field.removeClass("filled");
    }
});