Weather Data Fetcher

This project fetches weather data from the WeatherStack API for multiple cities, stores it in a PostgreSQL database, and updates it every 30 minutes using a cron job. An API endpoint is also provided to retrieve the stored weather data for a specific city.
Setup Instructions
1. Clone the Repository

Clone the repository to your local machine:

git clone https://github.com/your-username/weather-fetcher.git
cd weather-fetcher

2. Install Dependencies

Install the required PHP dependencies using Composer:

composer install

3. Set Up Database

Create a PostgreSQL database and run the following SQL schema:

CREATE TABLE weather_reports (
    id SERIAL PRIMARY KEY,
    city VARCHAR(100) NOT NULL UNIQUE,
    temperature DECIMAL(5,2) NOT NULL,
    humidity INT NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

4. Store API Key Securely
Option 1: Use Environment Variables

Set your WeatherStack API key as an environment variable:

export WEATHERSTACK_API_KEY="your-api-key-here"

Option 2: Use .env File

Alternatively, create a .env file in the project root and add your API key:

WEATHERSTACK_API_KEY=your-api-key-here

Make sure to add .env to .gitignore to keep it out of version control.
5. Set Up Cron Job for Automatic Updates

To fetch weather data every 30 minutes, set up a cron job:

*/30 * * * * /usr/bin/php /path/to/your/project/fetch_weather.php

6. Running the Script Manually (Optional)

You can run the script manually by executing:

php fetch_weather.php

7. API Endpoint

Use the following endpoint to retrieve weather data for a city:

GET /weather/{city}

Example:

curl http://localhost:8000/weather/New York
