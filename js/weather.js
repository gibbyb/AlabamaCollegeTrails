const apiKey = '48de410b1ca6ed6a4ce8e52bd9c60479';
const apiUrl = 'https://api.openweathermap.org/data/2.5/weather';

// function to fetch weather data for a location in Fahrenheit
async function getWeatherData(location) {
    const response = await fetch(`${apiUrl}?q=${location}&appid=${apiKey}&units=imperial`);
    const data = await response.json();
    return data;
}

// array of trail locations
const trailLocations = {
    kingsChair: 'Pelham, AL, US',
    alumHollow: 'Burrows, AL, US',
    littleRiver: 'Fort Payne, AL, US',
    stoneCuts: 'Brownsboro, AL, US'
};

const trailNames = {
    kingsChair: 'King\'s Chair',
    alumHollow: 'Alum Hollow',
    littleRiver: 'Little River Canyon',
    stoneCuts: 'Stone Cuts Trail'
};

// function to update the temperature elements with the current temperature for each trail location
async function updateTrailData() {
    for (const trail in trailLocations) {
        const data = await getWeatherData(trailLocations[trail]);
        const temperatureElement = document.getElementById(`${trail}-temperature`);
        temperatureElement.innerText = `Current temperature: ${data.main.temp}°F`;
        const rainElement = document.getElementById(`${trail}-rain`);
        if (data.hasOwnProperty('rain')) {
            rainElement.innerText = `Chance of rain: ${data.rain['1h']}%`;
        } else {
            rainElement.innerText = 'Chance of rain: 0%';
        }

    }
}

// function to get the current temperature for a trail location
async function getTemperature(trail) {
    const location = trailLocations[trail];
    try {
        const data = await getWeatherData(location);
        return data.main.temp;
    } catch (error) {
        console.error(error);
        return 'N/A';
    }
}

// update the temperature elements on page load
window.onload = updateTrailData();