<?php
error_reporting(E_ERROR | E_PARSE);
$weather = '';
$error = '';
if (isset($_GET["city"])) {
    $city = $_GET["city"];
    $UrlJson = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=907d8f2ff065ecf600399b239e2c3c60");
    $forcastArray = json_decode($UrlJson, true);

    if ($forcastArray['cod'] == 200) {
        $weather = $forcastArray['weather']['0']['description'];
        $temp = $forcastArray['main']['temp'];
    } else {
        $error = 'City name is incorrect';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/weather.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script defer src="weather.js"></script>
</head>

<body>
    <div class="header container">
        <div class="paralax">
            <div class="text">
                <h1 class="title">Weather in your City</h1>
            </div>
            <div class="layer layer-main"></div>
            <div class="layer layer-middle"></div>
            <div class="layer layer-first"></div>
        </div>
    </div>
    <section class="main container">
        <form id="form" class="weather-form">
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" aria-describedby="Forcast city" name="city">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php
            if ($weather) {
                echo '<div class="alert alert-primary" role="alert">' . 'The weather in' . ' ' . $city . ' ' . 'is' . ' ' . $weather . '.' . $temp . '&#8451' . '</div>';
            } else if ($error) {
                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }
            ?>
        </form>
    </section>
</body>

</html>