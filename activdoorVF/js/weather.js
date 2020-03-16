var d = new Date();
getWeatherForecast();

function getWeatherForecast() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);

            var day = 1;
            var object;

            for(i in obj.list){

                if(i == 0){
                    document.getElementById("day1").innerHTML= "<div class=\"forecast-icon\">\n" +
                        "                                    <img class=\"weatherIcon\" src=\"http://openweathermap.org/img/wn/"+obj.list[i].weather[0].icon+"@2x.png\" alt=\"\" width=28>\n" +
                        "                                </div>\n" +
                        "                                 <div class=\"degree\">"+Math.round(obj.list[i].main.temp_max).toString()+"<sup>o</sup>C</div>\n" +
                        "                                <small><sup></sup></small>";
                    day++;
                }

                if(obj.list[i].dt_txt.includes("12:00:00")){
                    var div = "day"+day.toString();
                    document.getElementById(div).innerHTML= "<div class=\"forecast-icon\">\n" +
                        "                                    <img class=\"weatherIcon\" src=\"http://openweathermap.org/img/wn/"+obj.list[i].weather[0].icon+"@2x.png\" alt=\"\" width=28>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"degree\">"+Math.round(obj.list[i].main.temp_max).toString()+"<sup>o</sup>C</div>\n" +
                        "                                <small><sup></sup></small>";

                    day++;
                }

                object = obj.list[i];

            }

            if(day == 5){
                day++;
                var div = "day"+day.toString();
                document.getElementById(div).innerHTML= "<div class=\"forecast-icon\">\n" +
                    "                                    <img class=\"weatherIcon\" src=\"http://openweathermap.org/img/wn/"+object.weather[0].icon+"@2x.png\" alt=\"\" width=28>\n" +
                    "                                </div>\n" +
                    "                                <div class=\"degree\">23<sup>o</sup>C</div>\n" +
                    "                                <small>18<sup>o</sup></small>";
            }

        }
    };
    xhttp.open("GET", "https://api.openweathermap.org/data/2.5/forecast?lat="+lat+"&lon="+long+"&lang=fr&units=metric&appid=88662f94e1d8c03cadaa77322e4835eb", true);
    xhttp.send();
}