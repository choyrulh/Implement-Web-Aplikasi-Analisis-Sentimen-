# Sentiment Analysis Web Application

This web application performs sentiment analysis using data from Twitter. The application is implemented in HTML, CSS, and JavaScript, and uses Chart.js for data visualization.

## Overview

The application displays a line chart that updates every second to reflect the latest sentiment data. The chart has three lines representing 'Support', 'Do Not Support', and 'Neutral' sentiments.

## Dependencies

- Chart.js
- jQuery
- PHP
- MySQL

## How It Works

The chart is created and updated using Chart.js. The data for the chart is fetched from a PHP file (`data.php`) using an XMLHttpRequest. The `data.php` file connects to a MySQL database, fetches the sentiment data, and returns it in a JSON format that can be used by the chart.

## Setup

1. Ensure that you have a server environment set up (like XAMPP, WAMP, etc.).
2. Place the HTML and PHP files in the server directory.
3. Set up your MySQL database and update the `koneksi.php` file with your database connection details.
4. Make sure `data.php` is set up to fetch the required data from your MySQL database.
5. Open the HTML file in your web browser to view the chart.

Please note that this is a basic setup guide. Depending on your specific use case and environment, additional configuration may be necessary.
