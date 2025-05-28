<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Radar Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        #map {
            flex: 1;
            height: 100%;
        }
        #controls {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
        }
        button {
            margin: 5px;
            padding: 8px 12px;
            cursor: pointer;
        }
        #animation-controls {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div id="controls">
        <button onclick="setLayer('rain')">Rain</button>
        <button onclick="setLayer('snow')">Snow</button>
        <button onclick="setLayer('satellite')">Satellite</button>
    </div>
    <div id="animation-controls">
        <button onclick="playAnimation()">Play</button>
        <button onclick="stopAnimation()">Stop</button>
    </div>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([23.6850, 90.3563], 7)
        map.setMinZoom(5)
        map.setMaxZoom(12)

        const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
        const baseLayer = L.tileLayer(tileUrl).addTo(map)

        const layerOpacities = { rain: 0.5, snow: 0.3, satellite: 0.7 }
        const layers = {
            rain: L.tileLayer(tileUrl),
            snow: L.tileLayer(tileUrl),
            satellite: L.tileLayer(tileUrl)
        }

        let currentLayer = null
        let animationInterval = null
        let animationFrame = 0

        function setLayerOpacity(layer, opacity) {
            layer.setOpacity(opacity)
        }

        function setLayer(layerType) {
            if (currentLayer) map.removeLayer(currentLayer)
            if (layerType === 'rain') currentLayer = layers.rain
            else if (layerType === 'snow') currentLayer = layers.snow
            else if (layerType === 'satellite') currentLayer = layers.satellite
            if (currentLayer) setLayerOpacity(currentLayer, layerOpacities[layerType])
            if (currentLayer) currentLayer.addTo(map)
        }

        function playAnimation() {
            if (animationInterval) return
            animationInterval = setInterval(function() {
                animationFrame = (animationFrame + 1) % 3
                if (animationFrame === 0) setLayer('rain')
                else if (animationFrame === 1) setLayer('snow')
                else setLayer('satellite')
            }, 1000)
        }

        function stopAnimation() {
            if (animationInterval) clearInterval(animationInterval)
            animationInterval = null
        }

        setLayer('rain')
    </script>
</body>
</html>