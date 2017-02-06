$(document).ready(function(){$(".megamenu").megamenu();});

// $(function(){
//     SyntaxHighlighter.all();
// });
$(window).load(function(){
    $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
            $('body').removeClass('loading');
        }
    });
});
