<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Toggle sidebar on mobile
        $('.sidebar-toggle').on('click', function() {
            $('#sidebar').toggleClass('show');
        });
        
        // Close sidebar when clicking outside on mobile
        $(document).on('click', function(event) {
            var sidebar = $('#sidebar');
            var toggleBtn = $('.sidebar-toggle');
            
            if ($(window).width() <= 992 && 
                !sidebar.is(event.target) && 
                !sidebar.has(event.target).length && 
                !toggleBtn.is(event.target) && 
                !toggleBtn.has(event.target).length) {
                sidebar.removeClass('show');
            }
        });
        
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').each(function() {
            new bootstrap.Tooltip(this);
        });
    });
</script>
