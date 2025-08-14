<style>
    /* Custom styles */
    .attachment-btn {
        background: none;
        border: none;
        color: #54656f;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 8px 12px;
    }
    
    .attachment-btn:hover {
        color: #00a884;
    }
    
    .attachment-menu {
        position: absolute;
        bottom: 60px;
        left: 10px;
        width: 300px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        display: none;
    }
    
    .attachment-menu.show {
        display: block;
        animation: fadeInUp 0.2s;
    }
    
    .attachment-item {
        padding: 12px 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background 0.2s;
    }
    
    .attachment-item:hover {
        background: #f5f5f5;
    }
    
    .attachment-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        font-size: 1.2rem;
    }
    
    .attachment-text h6 {
        margin-bottom: 2px;
        font-weight: 500;
    }
    
    .attachment-text p {
        margin: 0;
        font-size: 0.8rem;
        color: #667781;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Hide the file inputs */
    .file-input {
        display: none;
    }
</style>



{{-- <div class="d-flex align-items-center"> --}}
<div class="col-1">
    <div class="position-relative">

        <button class="attachment-btn" id="attachmentBtn">
            <i class="fas fa-paperclip"></i>
        </button>
        
        <!-- Attachment menu -->
        <div class="attachment-menu" id="attachmentMenu">
            <div class="attachment-item" id="OpenImgUpload">
                <div class="attachment-icon" style="background-color: #25D366;">
                    <i class="fas fa-camera"></i>
                </div>
                <div class="attachment-text">
                    <h6>Photo & Video</h6>
                    <p>Share photos and videos</p>
                </div>
            </div>
            
            <div class="attachment-item" id="openDocumetUpload">
                <div class="attachment-icon" style="background-color: #128C7E;">
                    <i class="fas fa-file"></i>
                </div>
                <div class="attachment-text">
                    <h6>Document</h6>
                    <p>Share documents</p>
                </div>
            </div>
            
            {{-- <div class="attachment-item" onclick="startVoiceRecording()">
                <div class="attachment-icon" style="background-color: #34B7F1;">
                    <i class="fas fa-microphone"></i>
                </div>
                <div class="attachment-text">
                    <h6>Voice Recording</h6>
                    <p>Record and send audio</p>
                </div>
            </div> --}}
            
            {{-- <div class="attachment-item" onclick="document.getElementById('contactInput').click()">
                <div class="attachment-icon" style="background-color: #075E54;">
                    <i class="fas fa-user"></i>
                </div>
                <div class="attachment-text">
                    <h6>Contact</h6>
                    <p>Share a contact</p>
                </div>
            </div> --}}
            
            {{-- <div class="attachment-item" onclick="document.getElementById('locationInput').click()">
                <div class="attachment-icon" style="background-color: #25D366;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="attachment-text">
                    <h6>Location</h6>
                    <p>Share your location</p>
                </div>
            </div> --}}
        </div>
        
        <!-- Hidden file inputs -->
        <input type="file" id="photoInput" class="file-input" accept="image/*,video/*" multiple>
        <input type="file" id="documentInput" class="file-input" accept=".pdf,.doc,.docx,.txt,.xls,.xlsx,.ppt,.pptx">
        <input type="file" id="contactInput" class="file-input" accept=".vcf">
        <input type="file" id="locationInput" class="file-input">
    </div>
</div>
  
{{-- </div> --}}

<script>
    // Ensure the DOM is ready
    $(function () {
      const $attachmentBtn = $('#attachmentBtn');
      const $attachmentMenu = $('#attachmentMenu');
  
      // Toggle attachment menu
      $attachmentBtn.on('click', function (e) {
        e.stopPropagation();
        $attachmentMenu.toggleClass('show');
      });
  
      // Close menu when clicking outside
      $(document).on('click', function () {
        $attachmentMenu.removeClass('show');
      });
  
      // Prevent menu from closing when clicking inside it
      $attachmentMenu.on('click', function (e) {
        e.stopPropagation();
      });
  
      // Handle file selection
    //   $('#photoInput').on('change', function (e) {
    //     window.handleFileSelection(e, 'photo/video');
    //   });
  
    //   $('#documentInput').on('change', function (e) {
    //     window.handleFileSelection(e, 'document');
    //   });
  
    //   $('#contactInput').on('change', function (e) {
    //     window.handleFileSelection(e, 'contact');
    //   });
  
    //   $('#locationInput').on('change', function (e) {
    //     window.handleFileSelection(e, 'location');
    //   });
    });
  
    // File selection handler (kept global in case it's called elsewhere)
    window.handleFileSelection = function (event, type) {
      const files = event.target.files;
      if (files && files.length > 0) {
        console.log(`Selected ${type} files:`, files);
        alert(`Selected ${files.length} ${type} file(s)`);
        // Reset the input to allow selecting the same file again
        $(event.target).val('');
      }
    };
  
    // Voice recording function (simplified)
    // window.startVoiceRecording = function () {
    //   console.log('Starting voice recording...');
    //   alert('Voice recording started (simulated). In a real app, this would use the microphone.');
    //   $('#attachmentMenu').removeClass('show');
    // };
  </script>