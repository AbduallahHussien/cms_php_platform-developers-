class Settings {
    init() {
        // Check if token and instance exist, otherwise show modal
        if (!token || !instance) {
            $("#modalSettings").modal("show");
        }

        $("#configurations").on("click", () => {
            $("#token").val(token);
            $("#instance").val(instance);
            $("#settings_save").addClass("update").html("Update");
            $("#modalSettings").modal("show");
        });

        $("#settings_save").on("click", () => {
            const settingsToken = $("#token").val().trim();
            const settingsInstance = $("#instance").val().trim();

            if (!settingsToken) {
                notification.show("Token is required", "error");
                return;
            }
            if (!settingsInstance) {
                notification.show("Instance is required", "error");
                return;
            }

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content",
                    ),
                },
                url: save_settings_route,
                type: "POST",
                data: { tkn_id: settingsToken, instance_id: settingsInstance },
                success: (response) => {
                    $("#modalSettings").modal("hide");
            
                    notification.next_page_notifiction(response.message); // uses the server's message
            
                    // Optional: you can delay reload for smoother UX
                    setTimeout(() => location.reload(), 800);
                },
                error: (xhr) => {
                    const errorMessage = xhr.responseJSON?.message || "Unexpected error occurred.";
                    notification.show("Failed to update settings: " + errorMessage, "error");
                },
            });
        });
    }
}

$(function(){
    new Settings().init();
});