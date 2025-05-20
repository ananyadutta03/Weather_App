<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - 5-Day Forecast</title>
    <link rel="stylesheet" href="5DaysForecastStyle.css">
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
            <a href="sunrise_sunset.php">Sunrise/Sunset</a>
            <a href="#">Historical Data</a>
            <a href="#">Contact Us</a>
        </div>
    </div>

    <div class="container">
        <div class="location-header">
            <h1 id="location">Current Location: Not Set</h1>
            <div class="search-bar">
                <input type="text" id="location-search" placeholder="Search for a location..." oninput="searchLocation()">
                <button onclick="searchLocation()">Search</button>
            </div>
            <div class="results-list" id="results-list"></div>
            <p id="search-error" class="error"></p>
        </div>

        <!-- Forecast  -->
        <div class="forecast-carousel" id="forecast-carousel">
            <h2>5-Day Forecast</h2>
            <button class="carousel-arrow arrow-left" onclick="scrollCarousel(-1)"><</button>
            <div class="carousel-container" id="carousel-container"></div>
            <button class="carousel-arrow arrow-right" onclick="scrollCarousel(1)">></button>
        </div>

        <!-- Day Detail Panel -->
        <div class="day-detail" id="day-detail" style="display: none;">
            <h2 id="day-detail-title">Day Details</h2>
            <p><span>High:</span> <span id="day-high">-- °C</span></p>
            <p><span>Low:</span> <span id="day-low">-- °C</span></p>
            <p><span>Condition:</span> <span id="day-condition">--</span></p>
        </div>

        <!-- Hourly Breakdown -->
        <div class="hourly-breakdown" id="hourly-breakdown" style="display: none;">
            <h2>Hourly Forecast</h2>
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Temp (°C)</th>
                    </tr>
                </thead>
                <tbody id="hourly-table"></tbody>
            </table>
        </div>
    </div>

    <script>
        let currentCity = "";
        let selectedDay = 0;

        // location and alert data in array format
        let locations = [
            {
                name: "Dhaka",
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
                alerts: []
            },
            {
                name: "Tokyo",
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
                alerts: []
            }
        ];

        // 5-day forecast er sample data for every city
        let forecastData = {
            "Dhaka": [
                { day: "Mon", high: 32, low: 26, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 27 }, { time: "06:00", temp: 28 },
                    { time: "12:00", temp: 32 }, { time: "18:00", temp: 29 }
                ]},
                { day: "Tue", high: 31, low: 25, condition: "Partly Cloudy", hourly: [
                    { time: "00:00", temp: 26 }, { time: "06:00", temp: 27 },
                    { time: "12:00", temp: 31 }, { time: "18:00", temp: 28 }
                ]},
                { day: "Wed", high: 30, low: 24, condition: "Rainy", hourly: [
                    { time: "00:00", temp: 25 }, { time: "06:00", temp: 26 },
                    { time: "12:00", temp: 30 }, { time: "18:00", temp: 27 }
                ]},
                { day: "Thu", high: 29, low: 23, condition: "Cloudy", hourly: [
                    { time: "00:00", temp: 24 }, { time: "06:00", temp: 25 },
                    { time: "12:00", temp: 29 }, { time: "18:00", temp: 26 }
                ]},
                { day: "Fri", high: 31, low: 25, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 26 }, { time: "06:00", temp: 27 },
                    { time: "12:00", temp: 31 }, { time: "18:00", temp: 28 }
                ]}
            ],
            "New York": [
                { day: "Mon", high: 24, low: 18, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 19 }, { time: "06:00", temp: 20 },
                    { time: "12:00", temp: 24 }, { time: "18:00", temp: 21 }
                ]},
                { day: "Tue", high: 23, low: 17, condition: "Cloudy", hourly: [
                    { time: "00:00", temp: 18 }, { time: "06:00", temp: 19 },
                    { time: "12:00", temp: 23 }, { time: "18:00", temp: 20 }
                ]},
                { day: "Wed", high: 22, low: 16, condition: "Rainy", hourly: [
                    { time: "00:00", temp: 17 }, { time: "06:00", temp: 18 },
                    { time: "12:00", temp: 22 }, { time: "18:00", temp: 19 }
                ]},
                { day: "Thu", high: 25, low: 19, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 20 }, { time: "06:00", temp: 21 },
                    { time: "12:00", temp: 25 }, { time: "18:00", temp: 22 }
                ]},
                { day: "Fri", high: 26, low: 20, condition: "Partly Cloudy", hourly: [
                    { time: "00:00", temp: 21 }, { time: "06:00", temp: 22 },
                    { time: "12:00", temp: 26 }, { time: "18:00", temp: 23 }
                ]}
            ],
            "London": [
                { day: "Mon", high: 17, low: 12, condition: "Rainy", hourly: [
                    { time: "00:00", temp: 13 }, { time: "06:00", temp: 14 },
                    { time: "12:00", temp: 17 }, { time: "18:00", temp: 14 }
                ]},
                { day: "Tue", high: 16, low: 11, condition: "Cloudy", hourly: [
                    { time: "00:00", temp: 12 }, { time: "06:00", temp: 13 },
                    { time: "12:00", temp: 16 }, { time: "18:00", temp: 13 }
                ]},
                { day: "Wed", high: 18, low: 13, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 14 }, { time: "06:00", temp: 15 },
                    { time: "12:00", temp: 18 }, { time: "18:00", temp: 15 }
                ]},
                { day: "Thu", high: 19, low: 14, condition: "Partly Cloudy", hourly: [
                    { time: "00:00", temp: 15 }, { time: "06:00", temp: 16 },
                    { time: "12:00", temp: 19 }, { time: "18:00", temp: 16 }
                ]},
                { day: "Fri", high: 20, low: 15, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 16 }, { time: "06:00", temp: 17 },
                    { time: "12:00", temp: 20 }, { time: "18:00", temp: 17 }
                ]}
            ],
            "Paris": [
                { day: "Mon", high: 20, low: 14, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 15 }, { time: "06:00", temp: 16 },
                    { time: "12:00", temp: 20 }, { time: "18:00", temp: 17 }
                ]},
                { day: "Tue", high: 19, low: 13, condition: "Cloudy", hourly: [
                    { time: "00:00", temp: 14 }, { time: "06:00", temp: 15 },
                    { time: "12:00", temp: 19 }, { time: "18:00", temp: 16 }
                ]},
                { day: "Wed", high: 18, low: 12, condition: "Rainy", hourly: [
                    { time: "00:00", temp: 13 }, { time: "06:00", temp: 14 },
                    { time: "12:00", temp: 18 }, { time: "18:00", temp: 15 }
                ]},
                { day: "Thu", high: 21, low: 15, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 16 }, { time: "06:00", temp: 17 },
                    { time: "12:00", temp: 21 }, { time: "18:00", temp: 18 }
                ]},
                { day: "Fri", high: 22, low: 16, condition: "Partly Cloudy", hourly: [
                    { time: "00:00", temp: 17 }, { time: "06:00", temp: 18 },
                    { time: "12:00", temp: 22 }, { time: "18:00", temp: 19 }
                ]}
            ],
            "Tokyo": [
                { day: "Mon", high: 28, low: 22, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 23 }, { time: "06:00", temp: 24 },
                    { time: "12:00", temp: 28 }, { time: "18:00", temp: 25 }
                ]},
                { day: "Tue", high: 27, low: 21, condition: "Partly Cloudy", hourly: [
                    { time: "00:00", temp: 22 }, { time: "06:00", temp: 23 },
                    { time: "12:00", temp: 27 }, { time: "18:00", temp: 24 }
                ]},
                { day: "Wed", high: 26, low: 20, condition: "Rainy", hourly: [
                    { time: "00:00", temp: 21 }, { time: "06:00", temp: 22 },
                    { time: "12:00", temp: 26 }, { time: "18:00", temp: 23 }
                ]},
                { day: "Thu", high: 29, low: 23, condition: "Sunny", hourly: [
                    { time: "00:00", temp: 24 }, { time: "06:00", temp: 25 },
                    { time: "12:00", temp: 29 }, { time: "18:00", temp: 26 }
                ]},
                { day: "Fri", high: 30, low: 24, condition: "Cloudy", hourly: [
                    { time: "00:00", temp: 25 }, { time: "06:00", temp: 26 },
                    { time: "12:00", temp: 30 }, { time: "18:00", temp: 27 }
                ]}
            ]
        };

        // defalt e dhaka 
        function initDefaultLocation() {
            selectLocation("Dhaka");
        }

        // city search er javaScript function
        function searchLocation() {
            let searchInput = document.getElementById("location-search").value.toLowerCase();
            let resultsList = document.getElementById("results-list");
            let errorMessage = document.getElementById("search-error");

            errorMessage.innerHTML = "";
            resultsList.innerHTML = "";

            if (searchInput === "") {
                errorMessage.innerHTML = "Please type a city!";
                errorMessage.style.color = "red";
                return;
            }

            let matchingCities = Object.keys(forecastData).filter(city => 
                city.toLowerCase().includes(searchInput)
            );

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

        // will show after select city......
        function selectLocation(cityName) {
            currentCity = cityName;
            document.getElementById("location").innerHTML = "Current Location: " + currentCity;
            document.getElementById("location-search").value = "";
            document.getElementById("results-list").innerHTML = "";
            document.getElementById("search-error").innerHTML = "";
            document.getElementById("day-detail").style.display = "none";
            document.getElementById("hourly-breakdown").style.display = "none";
            selectedDay = 0;
            showForecast();
            updateDashboard();
        }

        // Display 
        function showForecast() {
            let carousel = document.getElementById("carousel-container");
            let days = forecastData[currentCity] || [];

            carousel.innerHTML = "";

            if (days.length === 0) {
                carousel.innerHTML = "<div>No forecast data!</div>";
                return;
            }

            for (let i = 0; i < days.length; i++) {
                let day = days[i];
                let card = document.createElement("div");
                card.className = "day-card";
                card.innerHTML = `
                    <h3>${day.day}</h3>
                    <p>High: ${day.high} °C</p>
                    <p>Low: ${day.low} °C</p>
                    <p>${day.condition}</p>
                `;
                card.onclick = function() {
                    showDayDetails(i);
                };
                carousel.appendChild(card);
            }
        }

        
        function scrollCarousel(direction) {
                //<div class="carousel-container" id="carousel-container"></div>
            let carousel = document.getElementById("carousel-container");
            let scrollAmount = 160;
            carousel.scrollLeft += direction * scrollAmount;
        }

        // Show details for the selected day
        function showDayDetails(dayIndex) {
            let day = forecastData[currentCity][dayIndex];
            selectedDay = dayIndex;

            document.getElementById("day-detail-title").innerHTML = day.day + " Forecast";
            document.getElementById("day-high").innerHTML = day.high + " °C";
            document.getElementById("day-low").innerHTML = day.low + " °C";
            document.getElementById("day-condition").innerHTML = day.condition;
            document.getElementById("day-detail").style.display = "block";

            let table = document.getElementById("hourly-table");
            table.innerHTML = "";
            for (let i = 0; i < day.hourly.length; i++) {
                let hour = day.hourly[i];
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${hour.time}</td>
                    <td>${hour.temp} °C</td>
                `;
                table.appendChild(row);
            }
            document.getElementById("hourly-breakdown").style.display = "block";
        }

        // Update dashboard 
        function updateDashboard() {
            let data = forecastData[currentCity];
            let alertData = locations.find(loc => loc.name.toLowerCase() === currentCity.toLowerCase());
            if (data && alertData) {
                document.getElementById("widget-temp").innerHTML = `Current Temp: ${data[0].high} °C`;
                document.getElementById("widget-forecast").innerHTML = `Tomorrow’s High: ${data[1].high} °C`;
                document.getElementById("widget-alerts").innerHTML = `Alerts: ${alertData.alerts.length} Active`;
            }
        }

        // Navigate to current conditions
        function navigateToCurrent() {
            window.location.href = "current_conditions.html";
        }

        // Focus on forecast carousel
        function focusForecastCarousel() {
            document.getElementById("forecast-carousel").scrollIntoView({ behavior: "smooth" });
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
<?php
    }else{

        header('location: ../View/error.php');
    }

?>