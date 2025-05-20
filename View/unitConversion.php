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
        }
    </style>
</head>
<body>
    <h3 align="center">🌡️ Unit Conversion</h3>
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

        // Event listeners
        var tempDropdown = document.getElementById('temperature');
        var windDropdown = document.getElementById('windspeed');
        var pressureDropdown = document.getElementById('pressure');

        tempDropdown.onchange = updateDisplay;
        windDropdown.onchange = updateDisplay;
        pressureDropdown.onchange = updateDisplay;

        // Initial update
        updateDisplay();
    </script>
</body>
</html>