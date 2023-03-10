import "../sass/app.scss";
import "./bootstrap";

// JQuery
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

// Toastr
import toastr from "toastr";
window.toastr = toastr;

$(() => {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
});
