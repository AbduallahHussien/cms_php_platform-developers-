<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure File Upload | ZIP Archive</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <!-- Blade Template (upload.blade.php) -->
        <div class="container mt-5">
            <h3 class="text-center">Upload Your File</h3>
            <form id="file-upload-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">Choose File</label>
                    <input type="file" name="file" class="form-control" id="file" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>

            <!-- Progress Bar -->
            <div id="progress-wrapper" class="progress" style="height: 25px; display: none;">
                <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%;">
                </div>
            </div>

            <!-- Success/Error Message -->
            <div id="message" class="mt-3"></div>
        </div>

        <!-- Optional: Display Image or File Preview -->
        <div id="file-preview" class="mt-4" style="display:none;">
            <h5>Preview:</h5>
            <img id="image-preview" src="#" alt="Preview" class="img-fluid" style="max-width: 200px;">
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    
<script>
    $(document).ready(function () {

         // Add the CSRF token to the global AJAX setup
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#file-upload-form').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from submitting the traditional way

            var formData = new FormData(this); // Create a FormData object to handle file upload

            // Show the progress bar
            $('#progress-wrapper').show();
            $('#progress-bar').css('width', '0%'); // Reset progress bar to 0%

            $.ajax({
                url: "{{ route('file.upload') }}", // The route where the file will be uploaded
                method: 'POST',
                data: formData,
                processData: false,  // Important to set this to false for file upload
                contentType: false,  // Don't set content type because FormData will do it
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    // Track the progress of the upload
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            var percent = (e.loaded / e.total) * 100;
                            $('#progress-bar').css('width', percent + '%'); // Update progress bar width
                        }
                    });
                    return xhr;
                },
                success: function (response) 
                {
                    // Hide progress bar and show success message
                    $('#progress-wrapper').hide();
                    $('#message').html('<div class="alert alert-success">File uploaded successfully!</div>');
                    
                    // Optionally, preview the uploaded file (for images)
                    // if (response.path) {
                    //     var fileUrl = '{{ asset('storage') }}/' + response.path;
                    //     $('#file-preview').show();
                    //     $('#image-preview').attr('src', fileUrl);
                    // }
                },
                error: function (xhr, status, error) {
                    // Hide progress bar and show error message
                    $('#progress-wrapper').hide();
                    $('#message').html('<div class="alert alert-danger">File upload failed! Please try again.</div>');
                }
            });
        });
    });
</script>


</body>

</html>