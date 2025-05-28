<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Historical Weather Data</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f4f8;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: auto;
      padding: 20px;
    }

    header {
      text-align: center;
      padding: 20px 0;
    }

    .date-picker,
    .weather-results,
    .comparison-tool {
      background: white;
      padding: 20px;
      margin: 20px 0;
      border-radius: 12px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    label {
      font-weight: bold;
      margin-right: 10px;
    }

    input[type="date"],
    select {
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button {
      padding: 10px 16px;
      background: #007BFF;
      color: white;
      border: none;
      border-radius: 6px;
      margin-left: 10px;
      cursor: pointer;
    }

    button:hover {
      background: #0056b3;
    }

    .weather-results p,
    .comparison-results p {
      margin: 10px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Weather Archive</h1>
    </header>

    <section class="date-picker">
      <label for="weather-date">Select Date:</label>
      <input type="date" id="weather-date">
      <button id="lookup-btn">Look Up</button>
    </section>

    <section class="weather-results">
      <h2>Weather on <span id="selected-date">--</span></h2>
      <p><strong>Temperature:</strong> <span id="temp">--</span></p>
      <p><strong>Condition:</strong> <span id="condition">--</span></p>
      <p><strong>High:</strong> <span id="high">--</span> | <strong>Low:</strong> <span id="low">--</span></p>
    </section>

    <section class="comparison-tool">
      <h2>Compare Seasonal Averages</h2>
      <label for="season">Choose Season:</label>
      <select id="season">
        <option value="summer">Summer</option>
        <option value="winter">Winter</option>
        <option value="spring">Spring</option>
        <option value="fall">Fall</option>
      </select>
      <button id="compare-btn">Compare</button>
      <div class="comparison-results">
        <p><strong>Avg High:</strong> <span id="avg-high">--</span></p>
        <p><strong>Avg Low:</strong> <span id="avg-low">--</span></p>
        <p><strong>Record High:</strong> <span id="record-high">--</span></p>
        <p><strong>Record Low:</strong> <span id="record-low">--</span></p>
      </div>
    </section>
  </div>
</body>
</html>
