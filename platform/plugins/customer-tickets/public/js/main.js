class CustomerTicketsPluginManagement {
    init() {
        $(document).ready(function() {
            // Initialize the plugin
            const input = document.querySelector("#phone"); 
            
            const iti = window.intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    // This uses a free API to get the user's country based on IP
                    // Note: For production, you might want to use your own backend service
                    fetch('https://ipapi.co/json/')
                        .then(res => res.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("us")); // default to US if lookup fails
                },
                separateDialCode: true,
                preferredCountries: ['us', 'gb', 'ca', 'au', 'in', 'de', 'fr'],
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });
            
            input.addEventListener('countrychange', function() {
                const countryData = iti.getSelectedCountryData();
                const isoCountryCode = countryData.iso2;
                const dialCode = countryData.dialCode; 
                $('#dial_code').val(dialCode);
            });

            // Simulate when editing a user with stored phone number
            const fullPhoneNumber = $('#fullPhoneNumber').val();  
            if (fullPhoneNumber !== '+') {
                iti.setNumber(fullPhoneNumber);
            }
        });
    }
}
$(() => {
    new CustomerTicketsPluginManagement().init();
});
