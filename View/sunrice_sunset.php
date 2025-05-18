<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Sunrise/Sunset</title>
    <link rel="stylesheet" href="sunrice_sunsetStyle.css">
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
            <a href="weather_alerts.php">Weather Alerts</a>
            <a href="#">Historical Data</a>
            <a href="#">Contact Us</a>
        </div>
    </div>

    <div class="container">
        <!-- Location Header with Search -->
        <div class="location-header">
            <h1 id="location">Current Location: Not Set</h1>
            <div class="search-bar">
                <input type="text" id="location-search" placeholder="Search for a location..." oninput="searchLocation()">
                <button onclick="searchLocation()">Search</button>
            </div>
            <div class="results-list" id="results-list"></div>
            <p id="search-error" class="error"></p>
        </div>

        <!-- Day/Night Tracker -->
        <div class="day-night-tracker" id="day-night-tracker">
            <h2>Day/Night Tracker</h2>
            <p><span>Sunrise:</span> <span id="sunrise">--</span></p>
            <p><span>Sunset:</span> <span id="sunset">--</span></p>
            <p><span>Daylight Remaining:</span> <span id="daylight-remaining">--</span></p>
            <p><span>Status:</span> <span id="day-night-status">--</span></p>
        </div>

        <!-- Moon Phase -->
        <div class="moon-phase" id="moon-phase">
            <h2>Moon Phase</h2>
            <p><span>Moonrise:</span> <span id="moonrise">--</span></p>
            <p><span>Moonset:</span> <span id="moonset">--</span></p>
            <p><span>Current Phase:</span> <span id="moon-phase-name">--</span></p>
        </div>
    </div>

    <script>
        // Faculty-style JavaScript: using let, getElementById, and simple DOM manipulation
        let currentCity = "";

        // Simulated location and alert data
        let locations = [
            {
                name: "Dhaka",
                sunrise: "05:22",
                sunset: "18:28",
                moonrise: "12:15",
                moonset: "01:30",
                moonPhase: "First Quarter",
                temp: 30,
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
                sunrise: "05:48",
                sunset: "19:55",
                moonrise: "13:20",
                moonset: "02:45",
                moonPhase: "Waxing Gibbous",
                temp: 22,
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
                sunrise: "05:20",
                sunset: "20:35",
                moonrise: "14:10",
                moonset: "03:15",
                moonPhase: "First Quarter",
                temp: 15,
                tomorrowHigh: 16,
                alerts: []
            },
            {
                name: "Tokyo",
                sunrise: "04:45",
                sunset: "18:30",
                moonrise: "12:30",
                moonset: "01:45",
                moonPhase: "First Quarter",
                temp: 28,
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
                sunrise: "06:15",
                sunset: "20:50",
                moonrise: "13:45",
                moonset: "03:00",
                moonPhase: "Waxing Gibbous",
                temp: 18,
                tomorrowHigh: 19,
                alerts: []
            }
        ];

        // Initialize default city (Dhaka)
        function initDefaultLocation() {
            selectLocation("Dhaka");
        }

        // Handle city search
        function searchLocation() {
            let searchInput = document.getElementById("location-search").value.toLowerCase();
            let resultsList = document.getElementById("results-list");
            let errorMessage = document.getElementById("search-error");

            // Clear previous results and errors
            errorMessage.innerHTML = "";
            resultsList.innerHTML = "";

            // Check if search input is empty
            if (searchInput === "") {
                errorMessage.innerHTML = "Please type a city!";
                errorMessage.style.color = "red";
                return;
            }

            // Find matching cities
            let matchingCities = locations.map(loc => loc.name).filter(city => 
                city.toLowerCase().includes(searchInput)
            );

            // Show results or error
            if (matchingCities.length === 0) {
                resultsList.innerHTML = "<div>No cities found!</div>";
            } else {
                matchingCities.forEach(city => {
                    let div = document.createElement("div");
                    div.innerHTML = city;
                    div.onclick = function() {
                        selectLocation(city);
                    };
                    resultsList.appendChild(div);
                });
            }
        }

        // Update page with selected city's data
        function selectLocation(cityName) {
            currentCity = cityName;
            document.getElementById("location").innerHTML = "Current Location: " + currentCity;
            document.getElementById("location-search").value = "";
            document.getElementById("results-list").innerHTML = "";
            document.getElementById("search-error").innerHTML = "";
            updateSunMoonData();
            updateDashboard();
        }

        // Update sunrise, sunset, and moon phase data
        function updateSunMoonData() {
            let data = locations.find(loc => loc.name.toLowerCase() === currentCity.toLowerCase());
            if (!data) {
                document.getElementById("search-error").innerHTML = "City not found!";
                document.getElementById("search-error").style.color = "red";
                return;
            }

            // Day/Night Tracker
            document.getElementById("sunrise").innerHTML = data.sunrise;
            document.getElementById("sunset").innerHTML = data.sunset;
            document.getElementById("daylight-remaining").innerHTML = calculateDaylightRemaining(data.sunset);
            document.getElementById("day-night-status").innerHTML = getDayNightStatus(data.sunrise, data.sunset);

            // Moon Phase
            document.getElementById("moonrise").innerHTML = data.moonrise;
            document.getElementById("moonset").innerHTML = data.moonset;
            document.getElementById("moon-phase-name").innerHTML = data.moonPhase;
        }

        // Calculate remaining daylight (simulated current time: 14:00, May 5, 2025)
        function calculateDaylightRemaining(sunset) {
            let currentTime = "14:00"; // Simulated for testing
            let [sunsetHour, sunsetMinute] = sunset.split(":").map(Number);
            let [currentHour, currentMinute] = currentTime.split(":").map(Number);

            let sunsetMinutes = sunsetHour * 60 + sunsetMinute;
            let currentMinutes = currentHour * 60 + currentMinute;

            if (currentMinutes >= sunsetMinutes) {
                return "0 hours 0 minutes";
            }

            let remainingMinutes = sunsetMinutes - currentMinutes;
            let hours = Math.floor(remainingMinutes / 60);
            let minutes = remainingMinutes % 60;
            return `${hours} hours ${minutes} minutes`;
        }

        // Determine day or night status
        function getDayNightStatus(sunrise, sunset) {
            let currentTime = "14:00"; // Simulated for testing
            let [sunriseHour, sunriseMinute] = sunrise.split(":").map(Number);
            let [sunsetHour, sunsetMinute] = sunset.split(":").map(Number);
            let [currentHour, currentMinute] = currentTime.split(":").map(Number);

            let sunriseMinutes = sunriseHour * 60 + sunriseMinute;
            let sunsetMinutes = sunsetHour * 60 + sunsetMinute;
            let currentMinutes = currentHour * 60 + currentMinute;

            if (currentMinutes >= sunriseMinutes && currentMinutes < sunsetMinutes) {
                return "Day";
            } else {
                return "Night";
            }
        }

        // Update dashboard widgets
        function updateDashboard() {
            let data = locations.find(loc => loc.name.toLowerCase() === currentCity.toLowerCase());
            if (data) {
                document.getElementById("widget-temp").innerHTML = `Current Temp: ${data.temp} °C`;
                document.getElementById("widget-forecast").innerHTML = `Tomorrow’s High: ${data.tomorrowHigh} °C`;
                document.getElementById("widget-alerts").innerHTML = `Alerts: ${data.alerts.length} Active`;
            }
        }

        // Navigate to current conditions
        function navigateToCurrent() {
            window.location.href = "current_conditions.html";
        }

        // Navigate to 5-day forecast
        function navigateToForecast() {
            window.location.href = "five_day_forecast.html";
        }

        // Navigate to weather alerts
        function navigateToAlerts() {
            window.location.href = "weather_alerts.html";
        }

        // Show alerts (placeholder for backward compatibility)
        function showAlerts() {
            alert("No weather alerts at this time.");
        }

        // Start app
        window.onload = function() {
            initDefaultLocation();
        };
    </script>
</body>
</html>