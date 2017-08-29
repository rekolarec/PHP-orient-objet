$(function() {
    $.ajax({
        url: "http://localhost/phpobjet/myshop/single/" + idItem,
        method: "POST"
    }).done(function(data) {
        var data = JSON.parse(data);
        // console.log(data);
        // picture
        $("div.sp-wrap").html("");
        for (var i = 0; i < data.pictures.length; i++) {
            $("div.sp-wrap").append("<a href=" + data.pictures[i].url + "><img src=" + data.pictures[i].url + " alt=''></a>");
        }

        // reviews
        $("#elem-reviews").text(data.reviews.length + "Reviews(s)");
        //$("div.sp-wrap").append('<a href="images/demoi.jpg"><img src="' + data + '"></a>');
    }).fail(function(jqXHR, textStatus) {

    })

});