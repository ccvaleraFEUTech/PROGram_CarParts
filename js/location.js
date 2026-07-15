// Philippine Location Data
let locationData = null;

async function loadLocationData() {
    try {
        const basePath = document.body.getAttribute('data-base-path') || '';
        const response = await fetch(basePath + 'assets/json/philippine_provinces_cities_municipalities_and_barangays_2019v2.json');
        locationData = await response.json();
        
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

function populateProvinces(regionCode) {
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');
    const barangaySelect = document.getElementById('barangay');
    
    if (!provinceSelect || !locationData || !regionCode) return;

    provinceSelect.innerHTML = '<option value="">Select Province</option>';
    citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
    if (barangaySelect) {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    }

    const region = locationData[regionCode];
    if (!region || !region.province_list) return;

    for (const provinceName in region.province_list) {
        const option = document.createElement('option');
        option.value = provinceName;
        option.textContent = provinceName;
        provinceSelect.appendChild(option);
    }
}

function populateCities(regionCode, provinceName) {
    const citySelect = document.getElementById('city');
    const barangaySelect = document.getElementById('barangay');
    
    if (!citySelect || !locationData || !regionCode || !provinceName) return;

    citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
    if (barangaySelect) {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    }

    const region = locationData[regionCode];
    if (!region || !region.province_list || !region.province_list[provinceName]) return;

    const province = region.province_list[provinceName];
    if (!province.municipality_list) return;

    for (const cityName in province.municipality_list) {
        const option = document.createElement('option');
        option.value = cityName;
        option.textContent = cityName;
        citySelect.appendChild(option);
    }
}

function populateBarangays(regionCode, provinceName, cityName) {
    const barangaySelect = document.getElementById('barangay');
    
    if (!barangaySelect || !locationData || !regionCode || !provinceName || !cityName) return;

    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

    const region = locationData[regionCode];
    if (!region || !region.province_list || !region.province_list[provinceName]) return;

    const province = region.province_list[provinceName];
    if (!province.municipality_list || !province.municipality_list[cityName]) return;

    const city = province.municipality_list[cityName];
    if (!city.barangay_list) return;

    city.barangay_list.forEach(barangayName => {
        const option = document.createElement('option');
        option.value = barangayName;
        option.textContent = barangayName;
        barangaySelect.appendChild(option);
    });
}

function initLocationDropdowns() {
    loadLocationData().then(success => {
        if (success) {
            populateRegions();
        }
    });

    const regionSelect = document.getElementById('region');
    const provinceSelect = document.getElementById('province');
    const citySelect = document.getElementById('city');

    if (regionSelect) {
        regionSelect.addEventListener('change', (e) => {
            populateProvinces(e.target.value);
        });
    }

    if (provinceSelect) {
        provinceSelect.addEventListener('change', (e) => {
            const regionCode = regionSelect ? regionSelect.value : '';
            populateCities(regionCode, e.target.value);
        });
    }

    if (citySelect) {
        citySelect.addEventListener('change', (e) => {
            const regionCode = regionSelect ? regionSelect.value : '';
            const provinceName = provinceSelect ? provinceSelect.value : '';
            populateBarangays(regionCode, provinceName, e.target.value);
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    initLocationDropdowns();
});
