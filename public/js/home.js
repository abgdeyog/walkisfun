/**
 * Created by Nastya on 21.10.2017.
 */

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "https://walkisfun.com/api/method/categories.get",
        success: function (data) {
            var data1 = JSON.parse(data);
            var select = $("#categories-checkbox");
            for (var i = 0; i < Object.keys(data1).length; i++) {
                var category = data1[i].title;
                var id = data1[i].id;
                select.append('<input type="checkbox" id="' + id + '" name="cats[]"><label for="' + id + '">' + category + '</label>');
            }
        }
    });

    $(".to-next").on("click", function (e) {
        e.preventDefault();
        while (true) {
            waitForInput();
            break;
        }
    });

});