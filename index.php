<!DOCTYPE html>
<html>

<head>
    <title>myMap</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container mt-5 col-4">
        <div class="container mx-auto">
            <p class="text-center h1">สภาพอากาศในพื้นที่ต่างๆ</p>
            <br />
            <div class="from-group mb-3 ">
                <span class="from-group-text">Latitude :</span>
                <input type="text" class="form-control" placeholder="ละติจูด " aria-label="Latitude"
                    aria-describedby="Latitude" id="Latitude">
            </div>
            <div class="from-group mb-3">
                <span class="from-group-text">Longitude :</span>
                <input type="text" class="form-control" placeholder=" ลองจิจูด" aria-label="Longitude"
                    aria-describedby="Longitude" id="Longitude">
            </div>
            <div class="container-fluid mt-5  d-flex justify-content-center">
                <button type="button" class="btn btn-primary" id="btnSearch">ค้นหา</button>
            </div>
        </div>
        <br />
        <div class="container mt-5 d-flex justify-content-center">
            <div class="card" id="cardWeather" style="width: 30rem; ">
            </div>

        </div>
    </div>

</body>
<script>

    function setDefault() {
        var urlDefualt = "https://api.openweathermap.org/data/2.5/weather?lat=8.3883577&lon=99.9731439&appid=d1ffd4a48d1871c9b8d00735829b6d84";
        $.getJSON(urlDefualt)
            .done((data) => {
                var datetime = convertval(data.dt);
                var sunrise = convertval(data.sys["sunrise"]);
                var sunset = convertval(data.sys["sunset"]);
                var name = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273).toFixed(0) + " °C");
                var humid = (data.main["humidity"] + "%");
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);

                    }
                })


                var line = "<div id='dataWeather'>";
                line += "<img src='https://sites.google.com/site/nakhonsiwithfernguide/_/rsrc/1479389999349/wad-phra-mhathatu-wrmhawihar/%E0%B8%9E%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%A3%E0%B8%A1%E0%B8%98%E0%B8%B2%E0%B8%95%E0%B8%B8.jpg' class='card-img-top' ><div class='card-body'>"
                line += "<h5 class='card-title my-3 '>" + name + "</h5>";
                line += "<p class='card-text'>อุณหภูมิ : " + temp + "</p>";
                line += "<p class='card-text'>ความชื้นสัมพัทธ์ : " + humid + "</p>";
                line += "<p class='card-text'>อาทิตย์ขึ้นเวลา : " + sunrise + "</p>";
                line += "<p class='card-text'>อาทิตย์ตกเวลา : " + sunset + "</p>";
                line += "<p class='card-text'>เวลา: " + datetime + "</p>";



                line += "</div>"
                $("#cardWeather").append(line);
            }).fail((xhr, status, error) => { })
    }

    function LoadForcast() {
        var lat = $("#Latitude").val();
        var long = $("#Longitude").val();
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + long + "&appid=d1ffd4a48d1871c9b8d00735829b6d84"
        $.getJSON(url)
            .done((data) => {
                var datetime = convertval(data.dt);
                var sunrise = convertval(data.sys["sunrise"]);
                var sunset = convertval(data.sys["sunset"]);
                var name = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273).toFixed(0) + " °C");
                var humid = (data.main["humidity"] + "%");
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);

                    }
                })
                var line = "<div id='dataWeather'>";
                line += "<img src='https://cdn.pixabay.com/photo/2016/12/18/13/44/download-1915749_960_720.png' class='card-img-top' ><div class='card-body'>"
                line += "<h5 class='card-title my-3'> " + name + "</h5>";
                line += "<p class='card-text'>อุณหภูมิ : " + temp + "</p>";
                line += "<p class='card-text'>ความชื้นสัมพัทธ์ : " + humid + "</p>";
                line += "<p class='card-text'>อาทิตย์ขึ้นเวลา : " + sunrise + "</p>";
                line += "<p class='card-text'>อาทิตย์ตกเวลา : " + sunset + "</p>";
                line += "<p class='card-text'>เวลา : " + datetime + "</p>";



                line += "</div>"
                $("#cardWeather").append(line);

            }).fail((xhr, status, error) => { })
    }

    function convertval(value) {
        let time = value;
        var convert = new Date(time * 1000);
        var hours = convert.getHours();
        var minutes = "0" + convert.getMinutes();
        var seconds = "0" + convert.getSeconds();
        return (hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2));

    }








    $(() => {
        setDefault();
        $("#btnSearch").click(() => {
            LoadForcast();
            $("#dataWeather").hide();

        });
    });
</script>

</html>
