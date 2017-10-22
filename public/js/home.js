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

        $("#from").easyAutocomplete(startOptions);
        $("#to").easyAutocomplete(endOptions);
    }

    if ($('.finish-page').length > 0) {
        get = new URLSearchParams(window.location.search);

        var places = get.get('places').split(',');

        $.each(places, function (key, value) {
            $.ajax({
                type: "GET",
                url: "https://walkisfun.com/api/method/place.getTitle?id=" + value,
                success: function (data) {
                    data = data.response;

                    $('.places-grade-wrapper').append('<div class="gradePlace">\n' +
                        '                            <div class="row">\n' +
                        '                            <div class="col-md-6 gradeDescription">\n' +
                        '                                <h4 class="text-left">' + data + '</h4>\n' +
                        '                            </div>\n' +
                        '                            <div class="col-md-6 gradeButtons">\n' +
                        '                                <a class="thumbs-up" href="/api/method/place.like?placeID=' + value + '" title="Да">Да</a>\n' +
                        '                                <a class="thumbs-down" href="/api/method/place.dislike?placeID=' + value + '" title="Нет">Нет</a>\n' +
                        '                            </div>\n' +
                        '                            </div>\n' +
                        '                        </div>');
                }
            });

        });
    }

});

function getQueryParams(name) {
    qs = location.search;

    var params = [];
    var tokens;
    var re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        if (decodeURIComponent(tokens[1]) == name)
            params.push(decodeURIComponent(tokens[2]));
    }

    return params;
}

function initialize() {
    get = new URLSearchParams(window.location.search);

    var cats = getQueryParams('categories[]').join(',');

    $.ajax({
        type: "GET",
        url: "https://walkisfun.com/api/method/route.build?from=" + get.get('from_id') + "&to=" + get.get('to_id') + "&time=" + get.get('time') + "&categories=" + cats,
        success: function (data) {
            var from = data.response.route.from;
            var to = data.response.route.to;

            var places = data.response.places;

            var placesIds = [];

            $.each(places, function (key, value) {
                var smallDescription = value.description.substr(0, 130);
                smallDescription = smallDescription.substr(0, Math.min(smallDescription.length, smallDescription.lastIndexOf(" "))) + "...";


                $('.places-list-wrapper').append('<div class="place">' +
                    '                <span class="place-title">' + value.title + '</span>' +
                    '<span class="smallDescription">' + smallDescription + '</span>' +
                    '<span class="description">' + value.description + '</span>' +
                    '            </div>');

                placesIds.push(value.id);
            });
            $('.loading-icon-wrapper').hide();

            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13
            });
            directionsDisplay.setMap(map);

            var waypts = [];
            $.each(places, function (key, value) {
                waypts.push({
                    location: new google.maps.LatLng(value.gps_x, value.gps_y),
                    stopover: true
                });
            });

            directionsService.route({
                origin: new google.maps.LatLng(from.gps_x, from.gps_y),
                destination: new google.maps.LatLng(to.gps_x, to.gps_y),
                waypoints: waypts,
                optimizeWaypoints: false,
                travelMode: 'WALKING'
            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    $(".finishWalk").attr("href", "/finish?places=" + placesIds.join(','));
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

    });
}

$(document).on('click', '.place', function () {
    $(this).addClass('selected');
});

$(document).on('click', '.thumbs-up', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
        }
    });

    $(this).parent().html('<span>Спасибо за голос!</span>');
});

$(document).on('click', '.thumbs-down', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
        }
    });

    $(this).parent().html('<span>Обязательно исправимся!</span>');
});