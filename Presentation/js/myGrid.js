$(document).ready(function(){
    $('#grid').dataTable();

    $('#grid tbody').on("click", '.add', function(event) {
        if ($(this).hasClass("enabled")) {
            var id = parseInt($(this).parent().siblings(".id").text());
            console.log(id);
            $(this).attr("disabled",true);
            $(this).load("ShoppingCart.php?addId=" + id);
            $(this).removeClass("enabled");
            console.log("clicky clicky");
        }
    });
});