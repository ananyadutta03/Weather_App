<?php
session_start();
if (isset($_SESSION['status'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Radar Map</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f7fa;
            color: #333;
        }
        h3 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        #unit-setting {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 20px;
            color: #34495e;
            margin-bottom: 15px;
        }
        .unit-selector {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .unit-selector label {
            flex: 1;
            font-weight: bold;
            color: #2c3e50;
        }
        .unit-selector select {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
        }
        .unit-selector select:focus {
            outline: none;
            border-color: #3498db;
            background-color: #fff;
        }
        .preview {
            margin-top: 20px;
            padding: 15px;
            background-color: #ecf0f1;
            border-radius: 6px;
        }
        .preview p {
            margin: 10px 0;
            font-size: 16px;
        }
        .preview strong {
            color: #2c3e50;
        }
        #windspeed-preview, #pressure-preview, #temperature-preview {
            color: #2980b9;
        }
        .userInfo {
            position: relative;
            display: inline-block;
            margin-left: 20px;
        }
        .avater {
            width: 40px;
            height: 40px;
            cursor: pointer;
            border-radius: 50%;
            transition: transform 0.2s;
        }
        .avater:hover {
            transform: scale(1.1);
        }
        .options {
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            list-style: none;
            padding: 10px 0;
            min-width: 200px;
            z-index: 1000;
        }
        .options.d-none {
            display: none;
        }
        .options li {
            padding: 10px 20px;
        }
        .options li a {
            text-decoration: none;
            color: #2c3e50;
            font-size: 14px;
            display: block;
        }
        .options li a:hover {
            background-color: #f9f9f9;
            color: #3498db;
        }
        .topOption {
            border-top: 1px solid #ecf0f1;
            padding-top: 10px;
        }
        .bottomOption {
            border-bottom: 1px solid #ecf0f1;
            padding-bottom: 10px;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color: #2980b9;
        }
        @media (max-width: 600px) {
            .unit-selector {
                flex-direction: column;
                align-items: flex-start;
            }
            .unit-selector label {
                margin-bottom: 5px;
            }
            .unit-selector select {
                width: 100%;
            }
            .userInfo {
                margin-left: 0;
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3>🌡️ Unit Conversion</h3>
        <div class="userInfo">
            <img class="avater" src="usericon.svg" alt="User Avatar" />
            <ul class="options d-none">
                <li><a href="profile/view.php">View Profile</a></li>
                 <li><a href="radarMaps.php">radarMaps</a></li>
                <li><a href="shareFeture.php">shareFeture</a></li>
                <li><a href=" historicalData.php"> historicalData</a></li>
                <li><a href="widgetSupport.php">widgetSupport</a></li>
                <li><a href="contactUsForm.php" class="bottomOption">Contact With Us</a></li>
            </ul>
        </div>
    </div>
    <section id="unit-setting">
        <h2>Settings Panel</h2>
        <div class="unit-selector">
            <label for="temperature">Temperature units:</label>
            <select id="temperature" name="temperature">
                <option value="celsius">Celsius (°C)</option>
                <option value="fahrenheit">Fahrenheit (°F)</option>
            </select>
        </div>
        <div class="unit-selector">
            <label for="windspeed">Windspeed units:</label>
            <select id="windspeed" name="windspeed">
                <option value="mph">Miles per hour</option>
                <option value="kph">Kilometers per hour</option>
            </select>
        </div>
        <div class="unit-selector">
            <label for="pressure">Pressure units:</label>
            <select id="pressure" name="pressure">
                <option value="mb">Millibars</option>
                <option value="inHg">Inches of Mercury</option>
            </select>
        </div>
        <div class="preview">
            <p><strong>Temperature:</strong> <span id="temperature-preview">25°C</span></p>
            <p><strong>Windspeed:</strong> <span id="windspeed-preview">15 mph</span></p>
            <p><strong>Pressure:</strong> <span id="pressure-preview">1013 mb</span></p>
        </div>
       
    </section>
    <script>
        // Base values
        var baseTemp = 25; // Celsius
        var baseWind = 15; // Miles per hour
        var basePressure = 1013; // Millibars

        // Conversion functions
        function convertTemp(celsius) {
            return ((celsius * 9 / 5) + 32).toFixed(1);
        }
        function convertWind(mph) {
            return (mph * 1.60934).toFixed(1);
        }
        function convertPressure(mb) {
            return (mb * 0.02953).toFixed(2);
        }

        // Update display
        function updateDisplay() {
            var tempSelect = document.getElementById('temperature').value;
            var windSelect = document.getElementById('windspeed').value;
            var pressureSelect = document.getElementById('pressure').value;

            var tempDisplay = document.getElementById('temperature-preview');
            var windDisplay = document.getElementById('windspeed-preview');
            var pressureDisplay = document.getElementById('pressure-preview');

            if (tempSelect === 'celsius') {
                tempDisplay.textContent = baseTemp + '°C';
            } else {
                tempDisplay.textContent = convertTemp(baseTemp) + '°F';
            }

            if (windSelect === 'mph') {
                windDisplay.textContent = baseWind + ' mph';
            } else {
                windDisplay.textContent = convertWind(baseWind) + ' kph';
            }

            if (pressureSelect === 'mb') {
                pressureDisplay.textContent = basePressure + ' mb';
            } else {
                pressureDisplay.textContent = convertPressure(basePressure) + ' inHg';
            }
        }

        // Event listeners for unit selectors
        var tempDropdown = document.getElementById('temperature');
        var windDropdown = document.getElementById('windspeed');
        var pressureDropdown = document.getElementById('pressure');

        tempDropdown.onchange = updateDisplay;
        windDropdown.onchange = updateDisplay;
        pressureDropdown.onchange = updateDisplay;

        // Toggle dropdown menu
        var avatar = document.querySelector('.avater');
        var options = document.querySelector('.options');

        avatar.addEventListener('click', function() {
            options.classList.toggle('d-none');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!avatar.contains(event.target) && !options.contains(event.target)) {
                options.classList.add('d-none');
            }
        });

        // Initial update
        updateDisplay();
    </script>
</body>
</html>

<?php
} else {
  header('location: login.php');
}
?>