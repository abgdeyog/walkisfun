<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Walk Is Fun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="result-page">

<div class="container-fluid places-wrapper">
    <div class="row">
        <div class="col-md-7 col-sm-12 map-wrapper">
            <div id="map"></div>
        </div>
        <div class="col-md-5 col-sm-12 places-list-column">
            <div class="places-list-wrapper"></div>
            <div class="finishWalk text-center">
                <a class="finishWalk" href="" title="Завершить маршрут">Завершить маршрут</a>
            </div>
        </div>
    </div>
</div>

<div class="loading-icon-wrapper">
    <div class="loading-icon">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
<script src="/js/home.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbGEXuYmz4bt3I7XrQFa5H3OBZ8lyTPtc&libraries=geometry&callback=initialize"
        async defer></script>
</body>
</html>