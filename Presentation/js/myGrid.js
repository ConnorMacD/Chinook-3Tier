$(document).ready(function(){
    $('#grid').dataTable();

    $('#grid tbody').on("click", '.add', function(event) {
        //event.preventDefault();
        if ($(this).hasClass("enabled")) {
            $(this).text("Added");
            //$(this).removeAttr("href");
            $(this).removeClass("enabled");
            $(this).attr("disabled",true);
            //$(this).off();
            console.log("clicky clicky");
        }
    });
});