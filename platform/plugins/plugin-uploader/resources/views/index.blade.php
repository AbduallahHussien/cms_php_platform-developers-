@extends(BaseHelper::getAdminMasterLayoutTemplate())
{{-- @extends('plugins/plugin-uploader::layouts.app') --}}

@push('header')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('vendor/core/plugins/plugin-uploader/css/styles.css') }}">
@endpush

@section('content')
<div class="upload-container">
    <div class="upload-header">
        <i class="bi bi-cloud-arrow-up-fill"></i>
        <h3>{{ trans('plugins/plugin-uploader::plugin-uploader.upload_new_plugin') }}</h3>
        {{-- <h3>New Plugin Upload</h3> --}}

        {{-- <p class="text-muted">Upload your files safely with end-to-end encryption</p> --}}
    </div>

    <form id="file-upload-form" method="POST" data-upload-url="{{ route('plugin-uploader.upload-file') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="file" class="file-input-label">{{ trans('plugins/plugin-uploader::plugin-uploader.select_your_file') }}</label>
            <div class="upload-area" id="drop-area">
                <div class="uploading-overlay" id="uploading-overlay">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">{{ trans('plugins/plugin-uploader::plugin-uploader.uploading') }} ...</span>
                        </div>
                        <p class="mt-2">{{ trans('plugins/plugin-uploader::plugin-uploader.upload_in_progress') }}</p>
                    </div>
                </div>
                <i class="bi bi-file-earmark-arrow-up" style="font-size: 2rem; color: #adb5bd;"></i>
                <p class="my-2">{{ trans('plugins/plugin-uploader::plugin-uploader.drag_drop_files') }}</p>
                <small class="text-muted">{{ trans('plugins/plugin-uploader::plugin-uploader.supports_zip_only') }}</small>
                <input type="file" name="file" class="d-none" id="file" required>
            </div>
            <div class="file-info" id="file-info">
                <i class="bi bi-file-earmark-text"></i> <span id="file-name"></span> • <span id="file-size"></span>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-upload" id="upload-btn" disabled>
                <i class="bi bi-upload me-2"></i> {{ trans('plugins/plugin-uploader::plugin-uploader.upload_file') }}
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
                <i class="bi bi-x-circle me-2"></i> {{ trans('plugins/plugin-uploader::plugin-uploader.cancel') }}
            </button>
            <button type="button" class="btn btn-reset" id="reset-btn">
                <i class="bi bi-arrow-counterclockwise me-2"></i> {{ trans('plugins/plugin-uploader::plugin-uploader.reset') }}
            </button>
        </div>

        <!-- Success/Error Message -->
        <div id="message" class="mt-3"></div>
    </form>

    {{-- <div class="security-badge">
        <i class="bi bi-shield-lock"></i>
        <span>256-bit AES Encryption • Secure Transfer</span>
    </div> --}}

    <!-- File Preview -->
    <div class="preview-container" id="preview-container" style="display: none;">
        <h5 class="mb-3">{{ trans('plugins/plugin-uploader::plugin-uploader.file_preview') }}</h5>
        <img id="preview-image" class="preview-image" src="#" alt="Preview">
        <div class="mt-3" id="file-details"></div>
    </div>
</div>

@endsection

@push('footer')
<script src="{{ URL::asset('vendor/core/plugins/plugin-uploader/js/script.js')  }}"></script>
@endpush