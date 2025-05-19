<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Weather Alerts</title>
    <link rel="stylesheet" href="weather_alertsStyle.css">
</head>
<body>
    <!-- Dashboard Part of HTML -->
    <div class="dashboard">
        <h2>Weather Dashboard</h2>
        <div class="widget" id="widget-temp" onclick="focusWeatherFeed()">Current Temp: -- °C</div>
        <div class="widget" id="widget-forecast" onclick="navigateToForecast()">Tomorrow's High: -- °C</div>
        <div class="widget" id="widget-alerts" onclick="focusAlertInbox()">Alerts: 2 Active</div>
        <div class="shortcuts">
            <a href="CurrentCondition.php">Current Conditions</a>
            <a href="5DaysForecast.php">5-Day Forecast</a>
            <a href="weather_alerts.php">Weather Alerts</a>
            <a href="sunrise_sunset.php">Sunrise/Sunset</a>
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

        <!-- Alert Inbox -->
        <div class="alert-inbox" id="alert-inbox">
            <h2>Alert Inbox <span class="notification-badge" id="alert-count">0</span></h2>
            <ul id="alert-list"></ul>
        </div>

        <!-- Warning Details -->
        <div class="warning-details" id="warning-details">
            <h2>Warning Details</h2>
            <p><span>Title:</span> <span id="detail-title">--</span></p>
            <p><span>Severity:</span> <span id="detail-severity">--</span></p>
            <p><span>Duration:</span> <span id="detail-duration">--</span></p>
            <p><span>Description:</span> <span id="detail-description">--</span></p>
            <p><span>Affected Areas:</span> <span id="detail-areas">--</span></p>
        </div>

        <!-- Safety Tips -->
        <div class="safety-tips" id="safety-tips">
            <h2>Safety Tips</h2>
            <p><span>For:</span> <span id="tips-title">--</span></p>
            <ul id="tips-list"></ul>
        </div>
    </div>

    <script>
        // Faculty-style JavaScript: using let, getElementById, and simple DOM manipulation
        let currentLocation = "";

        // Simulated location and alert data
        let locations = [
            {
                name: "Dhaka",
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
                temp: 15,
                tomorrowHigh: 16,
                alerts: []
            },
            {
                name: "Tokyo",
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
                temp: 18,
                tomorrowHigh: 19,
                alerts: []
            }
        ];

        // Initialize default location (Dhaka)
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
                searchError.style.color = "red";
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

        // Select a location and display alerts
        function selectLocation(locationName) {
            let locationDisplay = document.getElementById("location");
            let alertInbox = document.getElementById("alert-inbox");
            let resultsList = document.getElementById("results-list");
            let searchError = document.getElementById("search-error");

            currentLocation = locationName;
            locationDisplay.innerHTML = "Current Location: " + currentLocation;
            alertInbox.style.display = "block";
            resultsList.innerHTML = "";
            searchError.innerHTML = "";
            document.getElementById("location-search").value = "";

            fetchAlertData(currentLocation);
            updateDashboard();
        }

        // Fetch and display alert data
        function fetchAlertData(location) {
            let data = locations.find(loc => loc.name.toLowerCase() === location.toLowerCase());

            if (!data) {
                document.getElementById("search-error").innerHTML = "Location not found!";
                document.getElementById("search-error").style.color = "red";
                return;
            }

            // Update Alert Inbox
            let alertList = document.getElementById("alert-list");
            let alertCount = document.getElementById("alert-count");
            alertList.innerHTML = "";
            alertCount.innerHTML = data.alerts.length;

            if (data.alerts.length === 0) {
                alertList.innerHTML = "<li>No active alerts for this location.</li>";
            } else {
                data.alerts.forEach(alert => {
                    let li = document.createElement("li");
                    li.innerHTML = `
                        <span>${alert.title}</span>
                        <span class="severity-${alert.severity.toLowerCase()}">${alert.severity}</span>
                        <span>Issued: ${alert.issued}</span>
                    `;
                    li.onclick = function() {
                        displayAlertDetails(alert);
                    };
                    alertList.appendChild(li);
                });
            }

            // Display details and tips for the first alert (if any)
            if (data.alerts.length > 0) {
                displayAlertDetails(data.alerts[0]);
            } else {
                displayAlertDetails({
                    title: "--",
                    severity: "--",
                    duration: "--",
                    description: "--",
                    areas: "--",
                    tips: []
                });
            }
        }

        // Display alert details and safety tips
        function displayAlertDetails(alert) {
            document.getElementById("detail-title").innerHTML = alert.title;
            document.getElementById("detail-severity").innerHTML = `<span class="severity-${alert.severity.toLowerCase()}">${alert.severity}</span>`;
            document.getElementById("detail-duration").innerHTML = alert.duration;
            document.getElementById("detail-description").innerHTML = alert.description;
            document.getElementById("detail-areas").innerHTML = alert.areas;

            document.getElementById("tips-title").innerHTML = alert.title;
            let tipsList = document.getElementById("tips-list");
            tipsList.innerHTML = "";
            if (alert.tips && alert.tips.length > 0) {
                alert.tips.forEach(tip => {
                    let li = document.createElement("li");
                    li.innerHTML = tip;
                    tipsList.appendChild(li);
                });
            } else {
                tipsList.innerHTML = "<li>No safety tips available.</li>";
            }
        }

        // Update dashboard widgets
        function updateDashboard() {
            let data = locations.find(loc => loc.name.toLowerCase() === currentLocation.toLowerCase());
            if (data) {
                document.getElementById("widget-temp").innerHTML = `Current Temp: ${data.temp} °C`;
                document.getElementById("widget-forecast").innerHTML = `Tomorrow’s High: ${data.tomorrowHigh} °C`;
                document.getElementById("widget-alerts").innerHTML = `Alerts: ${data.alerts.length} Active`;
            }
        }

        // Focus on alert inbox when clicking alerts widget
        function focusAlertInbox() {
            document.getElementById("alert-inbox").scrollIntoView({ behavior: "smooth" });
        }

        // Navigate to 5-day forecast
        function navigateToForecast() {
            window.location.href = "five_day_forecast.html";
        }

        // Focus on weather feed (placeholder for consistency)
        function focusWeatherFeed() {
            document.getElementById("alert-inbox").scrollIntoView({ behavior: "smooth" });
        }

        // Start app
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