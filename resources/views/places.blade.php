<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Walk Is Fun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <link rel="stylesheet" href="/css/easy-autocomplete.min.css"/>
    <link rel="stylesheet" href="/css/easy-autocomplete.themes.min.css"/>
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
        <div class="col-md-5 col-sm-12 places-list-wrapper">
            <div class="place" style="width: 100%; height: 100px; ">
                <span><div class="description inline">Description</div></span>
            </div>
            <hr/>
            <div class="place" style="width: 100%; height: 100px; ">
                <span><div class="description inline">Description</div></span>
            </div>
            <hr/>
            <div class="place" style="width: 100%; height: 100px; ">
                <span><div class="description inline">Description</div></span>
            </div>
            <a class="finishWalk" href="" title="Закончить">Закончить</a>
        </div>
    </div>
</div>


<!--JS section-->
<script src="/js/home.js"></script>
<script src="/js/jquery.easy-autocomplete.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbGEXuYmz4bt3I7XrQFa5H3OBZ8lyTPtc&libraries=geometry&callback=initialize"
        async defer></script>

<script>
    var json = {
        "overview_polyline": {
            "points": "uiyqBfb~zQgGwAgCtM}DfVpDrBeBbFqDjFmHfXkOzh@cKxNuGlW_BzSiJxZcBfHuS~NqK`Ia@lFgIpC{fAoDcW~BmEbBeqAmIaEoBgB{KB}J}OoJcBwAeHuAwDaBkCnCwKjLcNgBkIc@oDtD}EhG{GjAgVcDsN{Bm@|FaAvOiE|Va`@xw@}Jh]dPhcArEzQuIpXkMna@sDbPb@fGdDxE|O~E~ZzH`ThQtdA|jA|NfRxC~Jc@p[iEd`@WbSvKza@rTlf@~ArMfFtJrChOjQfM~JzX@~VnOn]g@jMcBdLkGzHg@|DyGfEcEjLgEvHaKoAgNiEoLsCoKUkUz@_CtBqI?eDhAeGeDsIRyK`IqIfIkPtEuUbNcLpOuPpZ]rHpHtQpLnOlEvIEpJfId[pShc@z@th@cLx@yNnGk`@rVsLfLm|@v|@_VxKgZ`XmR~VeH~^~@jIsAvLeD~LiCre@mGhP}Eda@D`YqBt[aIna@iI|Db@pENpDtAzCc@pG{@bFuQlGcLxGuUz@}PhBUhIcD`Eof@rMwUfEk^|Ck}@tFcMjDiP~GeN`RcF]}CxBmEc@{BvAoGdCsKpFmOgEuB\\eEjKjB~GwGvBiDsDgEyGwD`JeDTgCyGuCOcGvFmGzJeC_DwCa@WvM{@rC_CJuHoIiFEgBwC{HeJuCm@sAxAf@fFoBvBmDx@iNm@mCxD{DkAwMrDcJrF}IhSsDbB{D{AyY_CoK~AuP`@uPm@eKbC}Lq@eNsCeDeC_Jj@wIb@mEr@eHgBiGoKiGyJeDgI}CmHG{KiCyO}P}IgNkNaUoKkCkDYiB{Bg@sFwAaDeDsSwT}PY{KaEeIBqTfEiEeEgDkLyUyIkT}BoP{DyGiGwHiW{Is^kOiScLmTeIqGsPcTqD_FgMaDwNqMwOuVqHy\\yFkMmGwEaHeAqBmCr@aU_CiBoSpDyHBkH}Kc[kTq[mPyYiOyVyR_Sc\\{ZsRwfA{]wh@oPaNVyIiFeHKmE~AqAhEwNgDiNmFgL~H}Cs@oIxH{DRsFqG_FoA}GfEgP~MuFi@}Sh@yDdDgInBaGh@w[cCwH~AeGeFeLcUD_LkAiDwUaJuMXaQuGyBgB|LkLhL{JnPoGhIuQfACz@kEqCgBF}F~@qL{AaHa@qJCcHiAsBeH]{PiHeJoCu@{BxCwC[cFiVePaGt@}KoH_NyMyNiGyWwMeIgFiLmIod@lEoSaf@eIrF{@oG}C_@{B{CsEmAmDgCcAoL_AaFs@oCl@mD\\eMkHkFaJqFkEiPN}HrBvKdEzExA|FJJ"
        }
    };

    function initialize() {
        var map = new google.maps.Map(
            document.getElementById("map"), {
                center: new google.maps.LatLng(37.4419, -122.1419),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        var polyline = new google.maps.Polyline({
            path: google.maps.geometry.encoding.decodePath(json.overview_polyline.points),
            map: map
        });
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < polyline.getPath().getLength(); i++) {
            bounds.extend(polyline.getPath().getAt(i));
        }
        map.fitBounds(bounds);
    }
</script>
</body>
</html>