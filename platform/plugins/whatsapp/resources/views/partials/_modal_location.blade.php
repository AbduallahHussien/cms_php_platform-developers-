<div class="modal fade" id="location" tabindex="-1" aria-labelledby="locationLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header p-3">
          <h2 class="modal-title h3" id="locationLabel">Select Location</h2>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          {{-- <input id="search_input" class="form-control mb-2" type="text" placeholder="Search location" /> --}}
          <div id="map-canvas" style="height:400px;"></div>
        </div>
        <div class="modal-footer mt-3 mb-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="sendCurrentLocation">Send Current Location</button>
        </div>
      </div>
    </div>
  </div>
  