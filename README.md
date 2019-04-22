# WeatherApp

App for retrieving current temperature from a given city using OpenWeatherMap weather data.
User can also save preferred city to database, which is then automatically retrieved when opening the app.

## Deployment:
- In app/config/config.php database information must be defined according to your values.
- API key from OpenWeatherMap can be acquired from: https://openweathermap.org/api
- URLROOT should be set to your own url root.
- citypref.sql should be loaded into database.

Note: The database does not distinguish between users!

## How it works
When user enters a city and presses enter or go button, data is retrieved and displayed below
This will also reveal "Save as preferred city" button, which once clicked, saves the city into database as the preferred city.

## Built with:
- XAMPP apache 2.4 web server 
- phpMyAdmin MySQL database

https://www.apachefriends.org/index.html
