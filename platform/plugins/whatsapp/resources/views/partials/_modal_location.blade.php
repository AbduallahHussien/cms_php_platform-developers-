<div class="modal fade" id="location" tabindex="-1" aria-labelledby="locationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header p-3">
          <h5 class="modal-title" id="locationLabel">Select Location</h5>
          {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
          <input id="search_input" class="form-control mb-2" type="text" placeholder="Search location" />
          <div id="map-canvas" style="height:400px;"></div>
        </div>
        <div class="modal-footer mt-3 mb-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button id="sendCurrentLocation">send current location</button>
        </div>
      </div>
    </div>
  </div>
  