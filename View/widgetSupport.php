<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Widget Support</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        #widget-gallery {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .widget-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            width: 200px;
            text-align: center;
            transition: transform 0.2s;
        }

        .widget-card:hover {
            transform: translateY(-5px);
        }

        .widget-card button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .widget-card button:hover {
            background-color: #0056b3;
        }

        #customization-panel {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 40px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        #customization-panel label {
            font-weight: bold;
            margin-right: 10px;
        }

        #customization-panel select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            width: 200px;
        }

        #live-preview {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        #preview-widget {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        #preview-widget.light {
            background-color: #fff;
            color: #333;
        }

        #preview-widget.dark {
            background-color: #333;
            color: #fff;
        }

        #preview-widget.transparent {
            background-color: transparent;
            color: #333;
        }

        #preview-widget p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h2 align="center">📱 Widget Support</h2>

    <section id="widget-gallery">
        <h2>Widget Gallery</h2>
        <div class="widget-card">
            <h3>Small Widget</h3>
            <p>Simple temperature display.</p>
            <button>Add to Home Screen</button>
        </div>
        <div class="widget-card">
            <h3>Medium Widget</h3>
            <p>Temperature and short forecast.</p>
            <button>Add to Home Screen</button>
        </div>
        <div class="widget-card">
            <h3>Large Widget</h3>
            <p>Detailed forecast with radar view.</p>
            <button>Add to Home Screen</button>
        </div>
    </section>

    <section id="customization-panel">
        <h2>Customization Panel</h2>
        <label for="widget-size">Select Widget Size:</label>
        <select id="widget-size" name="widget-size">
            <option value="small">Small</option>
            <option value="medium">Medium</option>
            <option value="large">Large</option>
        </select> <br><br>
        <label for="widget-style">Select Widget Style:</label>
        <select id="widget-style" name="widget-style">
            <option value="light">Light Theme</option>
            <option value="dark">Dark Theme</option>
            <option value="transparent">Transparent</option>
        </select> <br><br>
        <label for="data-options">Data to Display:</label>
        <select id="data-options" name="data-options">
            <option value="temperature">Temperature</option>
            <option value="forecast">Forecast</option>
            <option value="humidity">Humidity</option>
            <option value="wind">Wind Speed</option>
        </select>
    </section>

    <section id="live-preview">
        <h2>Live Preview</h2>
        <div id="preview-widget" class="light">
            <p><strong>Widget Size:</strong> <span id="preview-size">Medium</span></p>
            <p><strong>Style:</strong> <span id="preview-style">Light</span></p>
            <p><strong>Data:</strong> <span id="preview-data">Temperature</span></p>
            <p id="preview-content">🌡️ 25°C | Sunny</p>
        </div>
    </section>

    <script>
        const widgetSize = document.getElementById('widget-size');
        const widgetStyle = document.getElementById('widget-style');
        const dataOptions = document.getElementById('data-options');
        const previewWidget = document.getElementById('preview-widget');
        const previewSize = document.getElementById('preview-size');
        const previewStyle = document.getElementById('preview-style');
        const previewData = document.getElementById('preview-data');
        const previewContent = document.getElementById('preview-content');

        function updatePreview() {
            // Update text content
            previewSize.textContent = widgetSize.options[widgetSize.selectedIndex].text;
            previewStyle.textContent = widgetStyle.options[widgetStyle.selectedIndex].text;
            previewData.textContent = dataOptions.options[dataOptions.selectedIndex].text;

            // Update style class
            previewWidget.className = widgetStyle.value;

            // Update preview content using if...else
            let content;
            if (dataOptions.value === 'temperature') {
                content = '🌡️ 25°C | Sunny';
            } else if (dataOptions.value === 'forecast') {
                content = '☀️ Sunny, High 27°C, Low 18°C';
            } else if (dataOptions.value === 'humidity') {
                content = '💧 Humidity: 65%';
            } else if (dataOptions.value === 'wind') {
                content = '💨 Wind: 15 km/h NE';
            } else {
                content = '🌡️ 25°C | Sunny'; // Default case
            }
            previewContent.textContent = content;

            // Adjust widget size in preview
            let width, height;
            if (widgetSize.value === 'small') {
                width = '150px';
                height = '100px';
            } else if (widgetSize.value === 'medium') {
                width = '200px';
                height = '150px';
            } else if (widgetSize.value === 'large') {
                width = '300px';
                height = '200px';
            }
            previewWidget.style.width = width;
            previewWidget.style.height = height;
        }

        // Add event listeners to update preview on change
        widgetSize.addEventListener('change', updatePreview);
        widgetStyle.addEventListener('change', updatePreview);
        dataOptions.addEventListener('change', updatePreview);

        // Initial call to set preview
        updatePreview();
    </script>
</body>
</html>