$( document ).ready(function () {
    $( "input[name$=\\[created\\]]" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });
});
