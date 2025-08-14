import { convertTime } from './helpers.js'; 

  // Render a single location slot
  export const renderLocationSlot = (latitude, longitude) => {
    return `
    <div class="d-flex justify-content-center bg-light p-2 rounded">
        <iframe
            width="270"
            height="200"
            style="border:0;width:100%"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://www.google.com/maps?q=${latitude},${longitude}&z=17&output=embed">
        </iframe>
    </div>`;
  };

  // Render the full message for location
  export const renderLocation = (mainClass, subClass, pushname, time, slot) => `
  <div class="row message-body mb-2">
    <div class="col-12 ${mainClass}">
        <div class="${subClass} p-2 rounded">
            <div class="d-flex justify-content-between small text-muted mb-1">
                <span>${pushname}</span>
                <span>${convertTime(time)}</span>
            </div>
            ${slot}
        </div>
    </div>
  </div>`;


  export const renderDocumentSlot = (ultramsg_body ,ultramsg_media) => 
  {
     if(!ultramsg_body){
      ultramsg_body = 'File name';
     }
    return  `<div class="d-flex align-items-center bg-light p-2 rounded">
                  <div class="me-3 text-secondary">
                      <i class="fas fa-file-alt fa-lg"></i>
                  </div>
                  <div class="flex-grow-1">
                      <div class="fw-bold">${ultramsg_body}</div>
                      <a href="${ultramsg_media}" download target="_blank" class="btn btn-sm btn-link mt-1">
                          <i class="bi bi-download"></i> Download
                      </a>
                  </div>
            </div>`
  };

  export const renderDocument = (mainClass,subClass,pushname,time,slot) => (
    `<div class="row message-body mb-2">
        <div class="col-12 ${mainClass}">
            <div class="${subClass} p-2 rounded">
                <div class="d-flex justify-content-between small text-muted mb-1">
                    <span>${pushname}</span>
                    <span>${convertTime(time)}</span>
                </div>
                ${slot}
            </div>
        </div>
    </div>`
  );