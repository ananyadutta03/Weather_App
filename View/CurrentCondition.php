<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Current Conditions</title>
    <link rel="stylesheet" href="CurrentConditionStyle.css">
</head>
<body>
    <!-- Dashboard -->
    <div class="dashboard">
        <h2>Weather Dashboard</h2>
        <div class="widget" id="widget-temp" onclick="focusWeatherFeed()">Current Temp: -- °C</div>
        <div class="widget" id="widget-forecast" onclick="navigateToForecast()">Tomorrow's High: -- °C</div>
        <div class="widget" id="widget-alerts" onclick="focusAlertInbox()">Alerts: 2 Active</div>
        <div class="shortcuts">
            <a href="CurrentCondition.php">Current Conditions</a>
            <a href="5DaysForecast.php">5-Day Forecast</a>
            <a href="sunrise_sunset.php">Sunrise/Sunset</a>
            <a href="weather_alerts.php">Weather Alerts</a>
            <a href="#">Historical Data</a>
            <a href="#">Contact Us</a>
        </div>
    </div>

    <div class="container">
        <!-- Location search er part..-->
        <div class="location-header">
            <h1 id="location">Current Location: Not Set</h1>
            <div class="search-bar">
                <input type="text" id="location-search" placeholder="Search for a location..." oninput="searchLocation()">
                <button onclick="searchLocation()">Search</button>
            </div>
            <div class="results-list" id="results-list"></div>
            <p id="search-error" class="error"></p>
        </div>

        <!-- eta hocche weather feed... -->
        <div class="live-weather" id="weather-feed">
            <h2>Live Weather</h2>
            <div class="weather-info">
                <p><span>Temperature:</span> <span id="temperature">-- °C</span></p>
                <p><span>Feels Like:</span> <span id="feels-like">-- °C</span></p>
                <p><span>Humidity:</span> <span id="humidity">-- %</span></p>
                <p><span>Wind:</span> <span id="wind">-- kph</span></p>
                <p><span>UV Index:</span> <span id="uv-index">--</span></p>
                <p><span>Air Quality:</span> <span id="air-quality">--</span></p>
            </div>
        </div>
    </div>

    <script>
        let currentLocation = "";

        // location and weather data er array
        // eta hocche mock data, real data nite hole API use korte hobe

        let locations = [
            {
                name: "Dhaka",
                temp: 30,
                feelsLike: 34,
                humidity: 85,
                wind: 8,
                uvIndex: 7,
                airQuality: "Moderate",
                tomorrowHigh: 31,
                alerts: [
                    {
                        title: "Storm Warning",
                        severity: "High",
                        issued: "May 5, 2025, 10:00",
                        duration: "May 5, 2025, 10:00 - May 5, 2025, 18:00",
                        description: "Heavy rainfall and strong winds expected.",
                        areas: "Central and Northern Dhaka",
                        tips: [
                            "Stay indoors and avoid open fields.",
                            "Secure outdoor objects to prevent wind damage.",
                            "Keep emergency supplies ready, including flashlights and water."
                        ]
                    },
                    {
                        title: "Heat Advisory",
                        severity: "Moderate",
                        issued: "May 5, 2025, 08:00",
                        duration: "May 5, 2025, 08:00 - May 6, 2025, 20:00",
                        description: "High temperatures expected, stay hydrated.",
                        areas: "All of Dhaka",
                        tips: [
                            "Drink plenty of water.",
                            "Avoid strenuous activity during peak heat.",
                            "Wear lightweight clothing."
                        ]
                    }
                ]
            },
            {
                name: "New York",
                temp: 22,
                feelsLike: 24,
                humidity: 65,
                wind: 12,
                uvIndex: 4,
                airQuality: "Moderate",
                tomorrowHigh: 23,
                alerts: [
                    {
                        title: "Flood Watch",
                        severity: "Moderate",
                        issued: "May 5, 2025, 09:00",
                        duration: "May 5, 2025, 09:00 - May 6, 2025, 12:00",
                        description: "Potential for flooding in low-lying areas.",
                        areas: "Manhattan and Brooklyn",
                        tips: [
                            "Avoid walking or driving through floodwaters.",
                            "Monitor local news for updates.",
                            "Prepare an emergency kit."
                        ]
                    }
                ]
            },
            {
                name: "London",
                temp: 15,
                feelsLike: 14,
                humidity: 80,
                wind: 18,
                uvIndex: 3,
                airQuality: "Good",
                tomorrowHigh: 16,
                alerts: []
            },
            {
                name: "Tokyo",
                temp: 28,
                feelsLike: 30,
                humidity: 70,
                wind: 10,
                uvIndex: 6,
                airQuality: "Unhealthy",
                tomorrowHigh: 27,
                alerts: [
                    {
                        title: "Typhoon Warning",
                        severity: "High",
                        issued: "May 5, 2025, 07:00",
                        duration: "May 5, 2025, 07:00 - May 6, 2025, 15:00",
                        description: "Strong winds and heavy rain expected.",
                        areas: "Greater Tokyo Area",
                        tips: [
                            "Stay indoors away from windows.",
                            "Stock up on food and water.",
                            "Follow evacuation orders if issued."
                        ]
                    }
                ]
            },
            {
                name: "Paris",
                temp: 18,
                feelsLike: 17,
                humidity: 75,
                wind: 14,
                uvIndex: 4,
                airQuality: "Good",
                tomorrowHigh: 19,
                alerts: []
            }
        ];

        // default location ...
        function initDefaultLocation() {
            selectLocation("Dhaka");
        }

        // Search locations
        function searchLocation() {
            let searchInput = document.getElementById("location-search").value.toLowerCase();
            let resultsList = document.getElementById("results-list");
            let searchError = document.getElementById("search-error");

            searchError.innerHTML = "";
            resultsList.innerHTML = "";

            if (searchInput === "") {
                searchError.innerHTML = "Please type a location!";
                return;
            }

            let filteredLocations = locations.filter(location => {
                return location.name.toLowerCase().includes(searchInput);
            });

            if (filteredLocations.length === 0) {
                resultsList.innerHTML = "<div>No locations found!</div>";
            } else {
                filteredLocations.forEach(location => {
                    let div = document.createElement("div");
                    div.innerHTML = location.name;
                    div.onclick = function() {
                        selectLocation(location.name);
                    };
                    resultsList.appendChild(div);
                });
            }
        }

        // jekono ekta location set kore and display te weather show korbo..
        function selectLocation(locationName) {
            let locationDisplay = document.getElementById("location");
            let weatherFeed = document.getElementById("weather-feed");
            let resultsList = document.getElementById("results-list");
            let searchError = document.getElementById("search-error");

            currentLocation = locationName;
            locationDisplay.innerHTML = "Current Location: " + currentLocation;
            weatherFeed.style.display = "block";
            resultsList.innerHTML = "";
            searchError.innerHTML = "";
            document.getElementById("location-search").value = "";

            fetchWeatherData(currentLocation);
            updateDashboard();
        }

        // weather data nichi then display weather data
        function fetchWeatherData(location) {
            let data = locations.find(loc => loc.name.toLowerCase() === location.toLowerCase());

            if (!data) {
                document.getElementById("search-error").innerHTML = "Location not found!";
                document.getElementById("search-error").style.color = "red";
                return;
            }

            document.getElementById("temperature").innerHTML = data.temp + " °C";
            document.getElementById("feels-like").innerHTML = data.feelsLike + " °C";
            document.getElementById("humidity").innerHTML = data.humidity + " %";
            document.getElementById("wind").innerHTML = data.wind + " kph";
            document.getElementById("uv-index").innerHTML = data.uvIndex;
            document.getElementById("air-quality").innerHTML = data.airQuality;
        }

        // dashboard er widget gulo update korbo
        function updateDashboard() {
            let data = locations.find(loc => loc.name.toLowerCase() === currentLocation.toLowerCase());
            if (data) {
                document.getElementById("widget-temp").innerHTML = `Current Temp: ${data.temp} °C`;
                document.getElementById("widget-forecast").innerHTML = `Tomorrow’s High: ${data.tomorrowHigh} °C`;
                document.getElementById("widget-alerts").innerHTML = `Alerts: ${data.alerts.length} Active`;
            }
        }

        function focusWeatherFeed() {
            document.getElementById("weather-feed").scrollIntoView({ behavior: "smooth" });
        }

        function navigateToForecast() {
            window.location.href = "five_day_forecast.html";
        }

        // weather alerts er jonno focus korbo
        function navigateToAlerts() {
            window.location.href = "weather_alerts.html";
        }

        // alerts show korar  jonno
        function showAlerts() {
            alert("No weather alerts at this time.");
        }

        window.onload = function() {
            initDefaultLocation();
        };
    </script>
</body>
</html>
<?php
    }else{

        header('location: ../View/error.php');
    }

?>