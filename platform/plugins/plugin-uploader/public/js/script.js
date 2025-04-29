
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
        const uploadUrl = $('#file-upload-form').data('upload-url');

        xhr = $.ajax({
            url: uploadUrl,
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




