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

function populateRegions() {
    const regionSelect = document.getElementById('region');
    if (!regionSelect || !locationData) return;

    regionSelect.innerHTML = '<option value="">Select Region</option>';

    // 1. Extract keys and flip them backward
    const regionKeys = Object.keys(locationData).reverse();

    // 2. Loop through the reversed keys
    for (const regionCode of regionKeys) {
        const region = locationData[regionCode];
        const option = document.createElement('option');
        option.value = regionCode;
        option.textContent = region.region_name;
        regionSelect.appendChild(option);
    }
}

