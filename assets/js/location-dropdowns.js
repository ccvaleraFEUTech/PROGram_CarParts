// location-dropdowns.js
//
// Makes the Region / Province / City <select> elements work together:
//   1. On page load, fill the Region dropdown from PH_LOCATIONS
//      (PH_LOCATIONS comes from ph-locations-data.js, loaded before this file).
//   2. When the user picks a Region, fill the Province dropdown with only
//      the provinces that belong to that region.
//   3. When the user picks a Province, fill the City/Municipality dropdown
//      with only the cities that belong to that province.
//
// This only touches <select> elements that have these exact IDs:
//   #region   #province   #city
// If a page doesn't have all three, the matching code block is simply
// skipped (see the "if (regionSelect)" guards below).

document.addEventListener("DOMContentLoaded", function () {

    var regionSelect   = document.getElementById("region");
    var provinceSelect = document.getElementById("province");
    var citySelect      = document.getElementById("city");

    // Stop here if this page doesn't have the location dropdowns.
    if (!regionSelect || !provinceSelect || !citySelect) {
        return;
    }

    // ------------------------------------------------------------
    // Small helper: clears a <select> and fills it with new options.
    // "items" is a plain array of strings.
    // "placeholder" is the first, unselectable option (e.g. "Select Province").
    // ------------------------------------------------------------
    function fillSelect(selectElement, items, placeholder) {
        selectElement.innerHTML = "";

        var firstOption = document.createElement("option");
        firstOption.value = "";
        firstOption.textContent = placeholder;
        selectElement.appendChild(firstOption);

        for (var i = 0; i < items.length; i++) {
            var option = document.createElement("option");
            option.value = items[i];
            option.textContent = items[i];
            selectElement.appendChild(option);
        }
    }

    // ------------------------------------------------------------
    // Step 1: Populate the Region dropdown on page load.
    // ------------------------------------------------------------
    var regionCodes = Object.keys(PH_LOCATIONS);
    var regionNames = [];
    for (var r = 0; r < regionCodes.length; r++) {
        regionNames.push(PH_LOCATIONS[regionCodes[r]].region_name);
    }
    fillSelect(regionSelect, regionNames, "Select Region");

    // Province and City start empty/disabled until a Region is chosen.
    fillSelect(provinceSelect, [], "Select Province");
    fillSelect(citySelect, [], "Select City / Municipality");

    // ------------------------------------------------------------
    // Step 2: When Region changes, refill Province.
    // ------------------------------------------------------------
    regionSelect.addEventListener("change", function () {
        var chosenRegionName = regionSelect.value;

        // Find the region object whose region_name matches what was picked.
        var matchedRegion = null;
        for (var r = 0; r < regionCodes.length; r++) {
            var region = PH_LOCATIONS[regionCodes[r]];
            if (region.region_name === chosenRegionName) {
                matchedRegion = region;
                break;
            }
        }

        if (matchedRegion) {
            var provinceNames = Object.keys(matchedRegion.provinces);
            fillSelect(provinceSelect, provinceNames, "Select Province");
        } else {
            fillSelect(provinceSelect, [], "Select Province");
        }

        // Reset City since Province just changed.
        fillSelect(citySelect, [], "Select City / Municipality");
    });

    // ------------------------------------------------------------
    // Step 3: When Province changes, refill City/Municipality.
    // ------------------------------------------------------------
    provinceSelect.addEventListener("change", function () {
        var chosenRegionName   = regionSelect.value;
        var chosenProvinceName = provinceSelect.value;

        var matchedRegion = null;
        for (var r = 0; r < regionCodes.length; r++) {
            var region = PH_LOCATIONS[regionCodes[r]];
            if (region.region_name === chosenRegionName) {
                matchedRegion = region;
                break;
            }
        }

        if (matchedRegion && matchedRegion.provinces[chosenProvinceName]) {
            var cities = matchedRegion.provinces[chosenProvinceName];
            fillSelect(citySelect, cities, "Select City / Municipality");
        } else {
            fillSelect(citySelect, [], "Select City / Municipality");
        }
    });

});
