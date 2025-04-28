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
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --danger-color: #dc3545;
        }
        
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .upload-container {
            max-width: 600px;
            margin: 3rem auto;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .upload-header {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--primary-color);
        }
        
        .upload-header i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .upload-area {
            border: 2px dashed #ced4da;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            background-color: #f8f9fa;
            position: relative;
        }
        
        .upload-area.disabled {
            cursor: not-allowed;
            opacity: 0.7;
            background-color: #e9ecef;
        }
        
        .upload-area:hover:not(.disabled) {
            border-color: var(--accent-color);
            background-color: rgba(72, 149, 239, 0.05);
        }
        
        .upload-area.active:not(.disabled) {
            border-color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.1);
        }
        
        .file-info {
            display: none;
            margin-top: 1rem;
            padding: 0.75rem;
            background-color: #e9ecef;
            border-radius: 6px;
            font-size: 0.9rem;
        }
        
        .progress-wrapper {
            height: 10px;
            border-radius: 5px;
            margin: 1.5rem 0;
            overflow: hidden;
            background-color: #e9ecef;
        }
        
        .progress-bar {
            height: 100%;
            transition: width 0.3s ease;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }
        
        .btn-upload {
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-upload:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .btn-cancel {
            background-color: var(--danger-color);
            color: white;
        }
        
        .btn-cancel:hover {
            background-color: #c82333;
            color: white;
        }
        
        .btn-reset {
            background-color: #6c757d;
            color: white;
        }
        
        .btn-reset:hover {
            background-color: #5a6268;
            color: white;
        }
        
        .file-input-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-top: 1rem;
        }
        
        .preview-container {
            margin-top: 2rem;
            text-align: center;
        }
        
        .preview-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: none;
        }
        
        .upload-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 1rem;
        }
        
        .uploading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="upload-container">
            <div class="upload-header">
                <i class="bi bi-cloud-arrow-up-fill"></i>
                <h3>Secure File Upload</h3>
                <p class="text-muted">Upload your files safely with end-to-end encryption</p>
            </div>

            <form id="file-upload-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="file-input-label">Select your file</label>
                    <div class="upload-area" id="drop-area">
                        <div class="uploading-overlay" id="uploading-overlay">
                            <div class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Uploading...</span>
                                </div>
                                <p class="mt-2">Upload in progress</p>
                            </div>
                        </div>
                        <i class="bi bi-file-earmark-arrow-up" style="font-size: 2rem; color: #adb5bd;"></i>
                        <p class="my-2">Drag & drop files here or click to browse</p>
                        <small class="text-muted">Supports: ZIP only (Max 50MB)</small>
                        <input type="file" name="file" class="d-none" id="file" required>
                    </div>
                    <div class="file-info" id="file-info">
                        <i class="bi bi-file-earmark-text"></i> <span id="file-name"></span> • <span id="file-size"></span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-upload" id="upload-btn" disabled>
                        <i class="bi bi-upload me-2"></i> Upload File
                    </button>
                </div>

                <!-- Progress Bar -->
                <div class="upload-stats d-none" id="upload-stats">
                    <span id="upload-speed">0 KB/s</span>
                    <span id="time-remaining">--</span>
                </div>
                <div class="progress-wrapper d-none" id="progress-wrapper">
                    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons d-none" id="action-buttons">
                    <button type="button" class="btn btn-cancel" id="cancel-btn">
                        <i class="bi bi-x-circle me-2"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-reset" id="reset-btn">
                        <i class="bi bi-arrow-counterclockwise me-2"></i> Reset
                    </button>
                </div>

                <!-- Success/Error Message -->
                <div id="message" class="mt-3"></div>
            </form>

            <div class="security-badge">
                <i class="bi bi-shield-lock"></i>
                <span>256-bit AES Encryption • Secure Transfer</span>
            </div>

            <!-- File Preview -->
            <div class="preview-container" id="preview-container" style="display: none;">
                <h5 class="mb-3">File Preview</h5>
                <img id="preview-image" class="preview-image" src="#" alt="Preview">
                <div class="mt-3" id="file-details"></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            let xhr = null; // To store the XHR object for cancellation
            let isUploading = false; // Flag to track upload state
            
            // Add the CSRF token to the global AJAX setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // File selection handler
            $('#file').on('change', function(e) {
                if (isUploading) return;
                
                const file = e.target.files[0];
                if (file) {
                    displayFileInfo(file);
                    previewFile(file);
                    $('#upload-btn').prop('disabled', false);
                }
            });

            // Drag and drop functionality
            const dropArea = document.getElementById('drop-area');
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                if (isUploading) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                if (isUploading) return;
                dropArea.classList.add('active');
            }

            function unhighlight() {
                if (isUploading) return;
                dropArea.classList.remove('active');
            }

            dropArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                if (isUploading) return;
                
                const dt = e.dataTransfer;
                const file = dt.files[0];
                $('#file')[0].files = dt.files;
                displayFileInfo(file);
                previewFile(file);
                $('#upload-btn').prop('disabled', false);
            }

            // Click on drop area triggers file input
            dropArea.addEventListener('click', () => {
                if (!isUploading) {
                    $('#file').click();
                }
            });

            // Display file information
            function displayFileInfo(file) {
                if (!file) return;
                
                const fileName = file.name;
                const fileSize = formatFileSize(file.size);
                
                $('#file-name').text(fileName);
                $('#file-size').text(fileSize);
                $('#file-info').show();
            }

            // Format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Preview file if it's an image
            function previewFile(file) {
                const previewContainer = $('#preview-container');
                const previewImage = $('#preview-image');
                const fileDetails = $('#file-details');
                
                previewContainer.hide();
                previewImage.hide();
                
                if (!file.type.match('image.*')) {
                    // For non-image files, show file details
                    fileDetails.html(`
                        <div class="alert alert-info">
                            <i class="bi bi-file-earmark-text"></i> ${file.name}<br>
                            <small>Type: ${file.type || 'Unknown'}</small><br>
                            <small>Size: ${formatFileSize(file.size)}</small>
                        </div>
                    `);
                    previewContainer.show();
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.attr('src', e.target.result);
                    previewImage.show();
                    fileDetails.html(`
                        <small>${file.name} • ${formatFileSize(file.size)}</small>
                    `);
                    previewContainer.show();
                }
                reader.readAsDataURL(file);
            }

            // Upload progress tracking variables
            let uploadStartTime;
            let lastLoaded = 0;
            let lastTime = 0;

            $('#file-upload-form').on('submit', function (e) {
                e.preventDefault();
                
                if (isUploading) return;
                
                const formData = new FormData(this);
                const file = $('#file')[0].files[0];
                
                if (!file) {
                    showMessage('Please select a file first.', 'danger');
                    return;
                }

                // Set uploading state
                isUploading = true;
                $('#drop-area').addClass('disabled');
                $('#uploading-overlay').show();
                $('#file').prop('disabled', true);
                
                // Show upload UI elements
                $('#progress-wrapper').removeClass('d-none').addClass('d-block');
                $('#upload-stats').removeClass('d-none').addClass('d-flex');
                $('#action-buttons').removeClass('d-none').addClass('d-flex');
                $('#progress-bar').css('width', '0%');
                $('#upload-btn').html('<i class="bi bi-arrow-repeat me-2 fa-spin"></i> Uploading...').prop('disabled', true);
                
                // Reset progress tracking
                uploadStartTime = new Date().getTime();
                lastLoaded = 0;
                lastTime = uploadStartTime;

                xhr = $.ajax({
                    url: "{{ route('file.upload') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        const xhr = new XMLHttpRequest();
                        
                        xhr.upload.addEventListener('progress', function (e) {
                            if (e.lengthComputable) {
                                const percent = Math.round((e.loaded / e.total) * 100);
                                $('#progress-bar').css('width', percent + '%');
                                
                                // Calculate upload speed and time remaining
                                const now = new Date().getTime();
                                const timeDiff = (now - lastTime) / 1000; // in seconds
                                const loadedDiff = e.loaded - lastLoaded;
                                
                                if (timeDiff > 0) {
                                    const speed = loadedDiff / timeDiff; // bytes per second
                                    const speedFormatted = formatFileSize(speed) + '/s';
                                    $('#upload-speed').text(speedFormatted);
                                    
                                    const remainingBytes = e.total - e.loaded;
                                    const timeRemaining = Math.round(remainingBytes / speed);
                                    $('#time-remaining').text(formatTime(timeRemaining));
                                }
                                
                                lastLoaded = e.loaded;
                                lastTime = now;
                            }
                        }, false);
                        
                        return xhr;
                    },
                    success: function (response) 
                    {
                        if(response.code == true)
                        {
                            showMessage('File uploaded successfully!', 'success');
                            $('#upload-btn').html('<i class="bi bi-check-circle me-2"></i> Upload Complete');
                            
                            // Hide progress elements after delay
                            setTimeout(() => {
                                $('#progress-wrapper').removeClass('d-block').addClass('d-none');
                                $('#upload-stats').removeClass('d-flex').addClass('d-none');
                                $('#action-buttons').removeClass('d-flex').addClass('d-none');
                            }, 2000);
                            
                            // Reset upload state
                            resetUploadState();
                            
                            // Handle response data if needed
                            // if (response.path) {
                            //     // You can display a download link or other response data here
                            // }
                        }
                        else 
                        {
                            showMessage(response.msg, 'danger');
                        }
                    },
                    error: function (xhr, status, error) {
                        if (status !== 'abort') {
                            let errorMsg = 'File upload failed! Please try again.';
                            if (xhr.responseJSON && xhr.responseJSON.msg) {
                                errorMsg = xhr.responseJSON.msg;
                            }
                            showMessage(errorMsg, 'danger');
                        }
                        resetUploadState();
                    }
                });
            });

            // Cancel upload button
            $('#cancel-btn').on('click', function() {
                if (xhr && isUploading) {
                    xhr.abort();
                    showMessage('Upload cancelled', 'warning');
                    resetUploadState();
                }
            });

            // Reset button
            $('#reset-btn').on('click', function() {
                resetForm();
            });

            // Helper function to reset the upload state
            function resetUploadState() {
                isUploading = false;
                xhr = null;
                $('#drop-area').removeClass('disabled');
                $('#uploading-overlay').hide();
                $('#file').prop('disabled', false);
                $('#upload-btn').html('<i class="bi bi-upload me-2"></i> Upload File').prop('disabled', $('#file')[0].files.length === 0);
            }

            // Helper function to reset the entire form
            function resetForm() {
                resetUploadState();
                $('#file-upload-form')[0].reset();
                $('#file-info').hide();
                $('#preview-container').hide();
                $('#progress-wrapper').removeClass('d-block').addClass('d-none');
                $('#upload-stats').removeClass('d-flex').addClass('d-none');
                $('#action-buttons').removeClass('d-flex').addClass('d-none');
                $('#progress-bar').css('width', '0%');
                $('#message').empty();
            }

            // Helper function to show messages
            function showMessage(message, type) {
                const alertClass = `alert-${type}`;
                $('#message').html(`
                    <div class="alert ${alertClass} alert-dismissible fade show">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
            }

            // Format time in seconds to human-readable format
            function formatTime(seconds) {
                if (isNaN(seconds) || seconds === Infinity) return '--';
                
                if (seconds < 60) return `${Math.round(seconds)}s remaining`;
                if (seconds < 3600) return `${Math.round(seconds / 60)}m remaining`;
                return `${Math.round(seconds / 3600)}h remaining`;
            }
        });
    </script>
</body>
</html>