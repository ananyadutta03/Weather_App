<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>App share feature</title>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        /* Header styling */
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        /* Section styling */
        section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Headings inside sections */
        h2 {
            color: #34495e;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        /* Generate snapshot button */
        #generate-snapshot {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto 20px;
        }

        #generate-snapshot:hover {
            background-color: #2980b9;
        }

        /* Snapshot preview styling */
        #snapshot-preview {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        #snapshot-preview p {
            margin: 5px 0;
        }

        #snapshot-preview p strong {
            color: #2c3e50;
        }

        /* Custom message section */
        #custom-message textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            font-size: 1rem;
            margin-top: 10px;
        }

        #custom-message label {
            font-weight: bold;
            color: #34495e;
        }

        /* Social preview styling */
        #social-preview #preview-box {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }

        #social-preview p {
            margin: 5px 0;
        }

        /* Share options styling */
        #share-option {
            text-align: center;
        }

        #share-option button {
            background-color: #2ecc71;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #share-option button:nth-child(2) {
            background-color: #3498db;
        }

        #share-option button:nth-child(3) {
            background-color: #e74c3c;
        }

        #share-option button:hover {
            opacity: 0.9;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            section {
                padding: 15px;
                margin0840
                margin: 10px;
            }

            h1 {
                font-size: 1.5rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            #generate-snapshot, #share-option button {
                width: 100%;
                margin: 10px 0;
            }

            #custom-message textarea {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>📤 Share Weather Snapshot</h1>

    <section id="share-sheet">
        <h2>Share Sheet</h2>
        <button id="generate-snapshot">Generate Weather Snapshot</button>

        <div id="snapshot-preview">
            <p><strong>Today's Weather</strong></p>
            <p>Sunny: 30°C</p>
            <p>Humidity: 60%</p>
            <p>Wind: 15 kph</p>
        </div>

        <section id="custom-message">
            <h2>Personal Message</h2>
            <label for="message">Add a Note:</label><br>
            <textarea name="message" id="message" rows="5" cols="50" placeholder="start..."></textarea>
        </section>

        <section id="social-preview">
            <h2>Social Preview</h2>
            <div id="preview-box">
                <p><strong>Preview:</strong></p>
                <p>Location: Dhaka</p>
                <p>Weather: Sunny, 30°C</p>
                <p>Note:</p>
            </div>
        </section>

        <section id="share-option">
            <h2>Share</h2>
            <button>📱 Message</button>
            <button>📘 Social</button>
            <button>📧 Email</button>
        </section>
</body>
</html>