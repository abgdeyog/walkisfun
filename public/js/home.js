$(document).ready(function () {
    if ($('.form-page').length > 0) {
        $.ajax({
            type: "GET",
            url: "https://walkisfun.com/api/method/categories.get",
            success: function (data) {
                data = data.response;
                var select = $("#categories-checkbox");

                $.each(data, function (key, value) {
                    var category = value.title;
                    var id = value.id;
                    select.append('<div class="category-wrapper"><input type="checkbox" id="' + id + '" value="' + id + '" name="categories[]" checked><label for="' + id + '">' + category + '</label></div>');
                });
            }
        });

        $("#to-next-1").on("click", function (e) {
            e.preventDefault();
            $("#to-next-1").addClass('rotated');
            $('.step-2').slideDown();
        });

        $("#to-next-2").on("click", function (e) {
            e.preventDefault();
            $("#to-next-2").addClass('rotated');
            $('.step-3').slideDown();
        });

        var startOptions = {
            url: function (phrase) {
                return "api/method/places.suggest?input=" + phrase;
            },

            listLocation: function (data) {
                return data["response"]["predictions"];
            },

            list: {
                onSelectItemEvent: function () {
                    var value = $("#from").getSelectedItemData().place_id; //get the id associated with the selected value
                    $("#from_id").val(value).trigger("change"); //copy it to the hidden field
                }
            },

            getValue: "description",

            requestDelay: 300
        };

        var endOptions = {
            url: function (phrase) {
                return "api/method/places.suggest?input=" + phrase;
            },

            listLocation: function (data) {
                return data["response"]["predictions"];
            },

            list: {
                onSelectItemEvent: function () {
                    var value = $("#to").getSelectedItemData().place_id; //get the id associated with the selected value
                    $("#to_id").val(value).trigger("change"); //copy it to the hidden field
                }
            },

            getValue: "description",

            requestDelay: 300
        };
        $("#start_place").easyAutocomplete(startOptions);
        $("#end_place").easyAutocomplete(endOptions);
    }

    // if ($('.result-page').length > 0) {
    //     var address = "https://walkisfun.com/api/method/route.build?from="+from+"&to="+to+"&time="+time+"&categories="+cats;
    //     alert(address);
    // }
});