<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Location Saving</title>
    <link rel="stylesheet" href="LocationSavingStyle.css">
</head>
<body>
    <!-- Dashboard -->
    <div class="dashboard">
        <h2>Weather Dashboard</h2>
        <div class="widget">Current Temp: -- °C</div>
        <div class="widget">Tomorrow’s High: -- °C</div>
        <div class="widget">Alerts: None</div>
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
        <!-- Location Header -->
        <div class="location-header">
            <h1 id="location">Current Location: Dhaka</h1>
        </div>

        <!-- Saved Places Manager -->
        <div class="saved-places" id="saved-places">
            <h2>Saved Places</h2>
            <button>Add Location</button>
            <ul id="saved-places-list">
                <li>
                    <span>Dhaka (Home)</span>
                    <button disabled>Up</button>
                    <button>Down</button>
                    <button>Remove</button>
                </li>
                <li>
                    <span>New York (Work)</span>
                    <button>Up</button>
                    <button>Down</button>
                    <button>Remove</button>
                </li>
                <li>
                    <span>Paris (Favorite)</span>
                    <button>Up</button>
                    <button disabled>Down</button>
                    <button>Remove</button>
                </li>
            </ul>
        </div>

        <!-- Quick-Switch Menu -->
        <div class="quick-switch" id="quick-switch">
            <h2>Quick-Switch Menu</h2>
            <select id="quick-switch-menu">
                <option value="">Select a location</option>
                <option value="Dhaka" selected>Dhaka</option>
                <option value="New York">New York</option>
                <option value="Paris">Paris</option>
            </select>
        </div>

        <!-- Add Location Dialog -->
        <div class="modal" id="add-location-modal">
            <div class="modal-content">
                <h2>Add New Location</h2>
                <div class="search-bar">
                    <input type="text" id="modal-search" placeholder="Search for a location...">
                    <button>Search</button>
                </div>
                <div class="results-list" id="modal-results-list">
                    <!-- Placeholder for search results -->
                    <div>Dhaka</div>
                    <div>New York</div>
                    <div>London</div>
                </div>
                <p id="modal-search-error" class="error"></p>
                <button>Save</button>
                <button>Cancel</button>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    }else{

        header('location: ../View/error.php');
    }

?>