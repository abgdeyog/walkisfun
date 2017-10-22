<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Walk Is Fun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/easy-autocomplete.css"/>
    <link rel="stylesheet" href="/css/easy-autocomplete.themes.css"/>
    <link rel="stylesheet" href="/css/main.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="form-page">

<header class="Header" role="banner">
    <div class="Header-Content" style="padding-top: 25px;">
        <h1 class="Header-Logo" title="Walk is fun">WalkIsFun</h1>
    </div>
</header>

<div class="container-fluid text-left">
    <div class="container content">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 col-sm-12 text-center form ">
                <div class="text-center" style="padding:50px 0">
                    <div class="logo">Начинаем стоить маршрут.<br/>Специально для тебя.</div>
                    <!-- Main Form -->
                    <div class="positions-form">
                        <form id="pos-form" class="text-left" action="/route" method="get">
                            {{ csrf_field() }}
                            <div class="main-pos-form step-1">
                                <div class="positions-group">
                                    <div class="form-group">
                                        <input type="hidden" id="from_id" name="from_id">
                                        <input type="text" class="form-control" id="from" name="from"
                                               placeholder="Откуда начинаем?" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="to_id" name="to_id">
                                        <input type="text" class="form-control" id="to" name="to"
                                               placeholder="Куда идем?" required>
                                    </div>
                                </div>
                                <button id="to-next-1" class="login-button to-next rotate-button"><i
                                            class="fa fa-chevron-right"></i></button>
                            </div>
                            <div class="main-pos-form step-2">
                                <div class="positions-group">
                                    <div class="wrapper-header">
                                        <span>Что планируешь посетить?</span>
                                    </div>
                                    <div class="form-group categories-checkbox " id="categories-checkbox">
                                    </div>
                                </div>
                                <button type="submit" id="to-next-2" class="login-button to-next rotate-button"><i
                                            class="fa fa-chevron-right"></i></button>
                            </div>

                            <div class="main-pos-form step-3">
                                <div class="positions-group">
                                    <div class="wrapper-header">
                                        <span>Сколько свободного времени?</span>
                                    </div>
                                    <div class="form-group time-checkbox" id="time-checkbox">
                                        <div class="time-wrapper">
                                            <input type="radio" id="30" value="30" name="time" checked
                                                   required>
                                            <label for="30">30 минут</label>
                                        </div>
                                        <div class="time-wrapper">
                                            <input type="radio" id="60" value="60" name="time">
                                            <label for="60">1 час</label>
                                        </div>
                                        <div class="time-wrapper">
                                            <input type="radio" id="180" value="180" name="time">
                                            <label for="180">3 часа</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="to-next-3"
                                        class="login-button to-next rotate-button submit-button"><i
                                            class="fa fa-chevron-right"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- end:Main Form -->
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
</div>
<footer class="text-center">
    <p>Walk Is Fun, 2017</p>
</footer>
</div>


<!--JS section-->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        crossorigin="anonymous"></script>
<script src="/js/jquery.easy-autocomplete.js"
        crossorigin="anonymous"></script>
<script src="/js/home.js"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
<script type="text/javascript">

</script>
</body>
</html>
