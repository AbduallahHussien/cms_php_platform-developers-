class SendLocation {
    init() {
        if (!$("#map-canvas").length) return;

        this.latitude = 52.525595; // Default Berlin coords
        this.longitude = 13.393085;
        this.map = null;
        this.marker = null;
        this.modalEl = document.getElementById("location");
        this.modal = new bootstrap.Modal(this.modalEl);

        // Get current location and load map
        this.getCurrentLocation((lat, lng) => {
            this.latitude = lat;
            this.longitude = lng;
            this.loadMap();
        });

        // Handle "Send Current Location" button click
        $("#sendCurrentLocation").on("click", () => {
            this.getCurrentLocation((lat, lng) => {
                this.sendLocationAjax(lat, lng);
            });
        });
    }

    // Get current location with fallback
    getCurrentLocation(callback) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    // Success
                    callback(position.coords.latitude, position.coords.longitude);
                },
                (error) => {
                    switch (error.code) {
                        case 1:
                            alert("Location permission denied. Please allow location access.");
                            break;
                        case 2:
                            alert("Location unavailable. Please turn on GPS or check your network.");
                            break;
                        case 3:
                            alert("Location request timed out. Try again.");
                            break;
                        default:
                            alert("Could not get location.");
                    }
                    // fallback to default location if needed
                    callback(this.latitude, this.longitude);
                }
            );
        } else {
            alert("Geolocation is not supported by this browser.");
            callback(this.latitude, this.longitude);
        }
    }
    
    

    // Send location via AJAX
    sendLocationAjax(lat, lng) {
        console.log("Sending:", lat, lng);
        if (lat == null || lng == null) {
            alert("Cannot send location: coordinates are missing.");
            return;
        }
        $.ajax({
            url: `https://api.ultramsg.com/${instance}/messages/location`,
            method: "POST",
            data: {
                token: token,
                to: $("#conversation").data("receiver_id"),
                address: "My Current Location",
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            },
            success: (response) => {
                console.log("Location sent successfully:", response);
                alert("Your location has been sent via WhatsApp!");
            },
            error: (xhr) => {
                console.error("Error sending location:", xhr.responseText);
            }
        });
    }
    
    

    // Initialize map
    loadMap() {
        const centerLatLng = new google.maps.LatLng(this.latitude, this.longitude);

        this.map = new google.maps.Map(document.getElementById("map-canvas"), {
            zoom: 14,
            center: centerLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        });

        // Marker at current position
        this.marker = new google.maps.Marker({
            map: this.map,
            position: centerLatLng
        });

        // Click map to place marker
        google.maps.event.addListener(this.map, "click", (e) => this.placeMarker(e.latLng));

        // Add search box
        const input = document.getElementById("search_input");
        if (input) {
            this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            const searchBox = new google.maps.places.SearchBox(input);

            google.maps.event.addListener(searchBox, "places_changed", () => {
                const places = searchBox.getPlaces();
                if (places.length > 0 && places[0].geometry) {
                    this.placeMarker(places[0].geometry.location);
                }
            });
        }
    }

    // Place marker & send location
    placeMarker(location) {
        if (!location) return;

        this.marker.setPosition(location);
        this.map.setCenter(location);

        // Send via AJAX
        this.sendLocationAjax(location.lat(), location.lng());

        this.closeModal();
    }

    // Close modal
    closeModal() {
        if (this.modal) {
            this.modal.hide();
        }
    }
}

// Initialize on DOM ready
$(function () {
    new SendLocation().init();
});
