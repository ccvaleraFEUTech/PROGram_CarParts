// Philippine Location Data
let locationData = null;

async function loadLocationData() {
    try {
        const response = await fetch('assets/json/philippine_provinces_cities_municipalities_and_barangays_2019v2.json');
        locationData = await response.json();
        // reverse sort location data
        
        return true;
    } catch (error) {
        console.error('Error loading location data:', error);
        return false;
    }
}

