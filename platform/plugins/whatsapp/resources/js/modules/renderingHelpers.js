import { convertTime } from "./helpers.js";

export const renderChatsList = (instance,token) => {
    //  token = 'm8b9c155gr43zwdk';
    //  instance = 'instance137692';
    // console.log('instance in renderingHelpers : ',instance);
    // console.log('token in renderingHelpers : ',token);

    $('.sideBar').html(`
        <div class="d-flex justify-content-center align-items-center p-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `);
    
    $.ajax({
        async: true,
        crossDomain: true,
        url: `https://api.ultramsg.com/${instance}/chats?token=${token}`,
        method: "GET",
        headers: { "content-type": "application/x-www-form-urlencoded" },
    }).done(function (response) {
        $('.sideBar').empty();
        response.forEach((chat) => {
            const chatId = chat.id;
            const selector = chatId.replace("@", "").replace(".", "");

            if (chatId === "963983882481@c.us") return; // skip this chat

            // Append chat item
            $(".sideBar").append(`
                <div class="row sideBar-body" data-chat_id="${chatId}" data-selector="${selector}">
                    <div class="col-3 sideBar-avatar avatar${selector}"></div>
                    <div class="col-9 sideBar-main">
                        <div class="row">
                            <div class="col-8 sideBar-name">
                                <span class="name-meta">${chat.name}</span>
                            </div>
                            <div class="col-4 sideBar-time text-end">
                                <span class="time-meta">${convertTime(chat.last_time)}</span>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            // Add unread count if any
            if (chat.unread > 0) {
                $(`[data-selector=${selector}]`).append(
                    `<span class="unread">${chat.unread}</span>`,
                );
            }

            // Fetch profile image
            $.ajax({
                url: `https://api.ultramsg.com/${instance}/contacts/image?token=${token}&chatId=${chatId}`,
                method: "GET",
                headers: {
                    "content-type": "application/x-www-form-urlencoded",
                },
            }).done(function (data) {
                const $avatar = $(`.avatar${selector}`);
                $avatar.empty();

                if (data.success) {
                    $avatar.append(
                        `<div class="avatar-icon"><img src="${data.success}" /></div>`,
                    );
                } else {
                    $avatar.append(`
                        <span class="default-avatar">
                            <i class="fa fa-user-circle fa-3x text-muted"></i>
                        </span>
                    `);
                }
            });
        });
    });
};

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

export const renderDocumentSlot = (ultramsg_body, ultramsg_media) => {
    if (!ultramsg_body) {
        ultramsg_body = "File name";
    }
    return `<div class="d-flex align-items-center bg-light p-2 rounded">
                  <div class="me-3 text-secondary">
                      <i class="fas fa-file-alt fa-lg"></i>
                  </div>
                  <div class="flex-grow-1">
                      <div class="fw-bold">${ultramsg_body}</div>
                      <a href="${ultramsg_media}" download target="_blank" class="btn btn-sm btn-link mt-1">
                          <i class="bi bi-download"></i> Download
                      </a>
                  </div>
            </div>`;
};

export const renderDocument = (mainClass, subClass, pushname, time, slot) =>
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
    </div>`;

// In your renderingHelpers.js
export const renderVideoSlot = (videoName, videoUrl) => {
    if (!videoName) videoName = "Video";

    return `
    <div class="d-flex flex-column bg-light p-2 rounded">
        
        <video controls class="w-100 rounded" style="max-height: 210px;">
            <source src="${videoUrl}" type="video/mp4">
            <source src="${videoUrl}" type="video/ogg">
            Your browser does not support the video tag.
        </video>
        <a href="${videoUrl}" download class="btn btn-sm btn-link mt-1">
            <i class="bi bi-download"></i> Download
        </a>
    </div>`;
};

export const renderVideo = (mainClass, subClass, pushname, time, slot) => `
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

// In your renderingHelpers.js

export const renderAudioSlot = (audioName, audioUrl) => {
    if (!audioName) audioName = "Audio";

    return `
    <div class="d-flex flex-column bg-light p-2 rounded">
        <div class="fw-bold mb-1">${audioName}</div>
        <audio controls class="w-100">
            <source src="${audioUrl}" type="audio/mpeg">
            <source src="${audioUrl}" type="audio/ogg">
            <source src="${audioUrl}" type="audio/aac">
            Your browser does not support the audio element.
        </audio>
        <a href="${audioUrl}" download class="btn btn-sm btn-link mt-1">
            <i class="bi bi-download"></i> Download
        </a>
    </div>`;
};

export const renderAudio = (mainClass, subClass, pushname, time, slot) => `
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

export const renderChatMessages = (data, prepend = false) => {
    const conversation = $("#conversation");

    // Reverse data when prepending so oldest message comes first
    const messages = prepend ? [...data].reverse() : data;

    $.each(messages, function (index) {
        let mainClass = "";
        let subClass = "";

        if (messages[index].event_type === "message_received") {
            mainClass = "message-main-receiver";
            subClass = "receiver";
        } else {
            mainClass = "message-main-sender";
            subClass = "sender";
        }

        let messageHTML;

        switch (messages[index].type) {
            case "image":
                messageHTML = `
                <div class="row message-body">
                    <div class="col-12 ${mainClass}">
                        <div class="${subClass}">
                            <div class="message-text">
                                <img src="${messages[index].media}" alt="Uploaded Image" accept="image/png, image/jpeg">
                            </div>
                            <span class="message-time pull-right">${convertTime(messages[index].time)}</span>
                            <span>
                                <a href="${messages[index].media}" download target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg>
                                </a>
                            </span>
                            <span class="message-time pull-right">${messages[index].pushname}</span>
                        </div>
                    </div>
                </div>`;
                break;

            case "audio": 
                const audioSlot = renderAudioSlot(
                    "Audio",
                    messages[index].media,
                );
                messageHTML = renderAudio(
                    mainClass,
                    subClass,
                    messages[index].pushname,
                    messages[index].time,
                    audioSlot,
                );
                break;
            
            case "ptt": 
                const voiceSlot = renderAudioSlot(
                    "Voice Message",
                    messages[index].media,
                );
                messageHTML = renderAudio(
                    mainClass,
                    subClass,
                    messages[index].pushname,
                    messages[index].time,
                    voiceSlot,
                );
                break;

            case "location":
                const locationSlot = renderLocationSlot(
                    messages[index].lo_latitude,
                    messages[index].lo_longitude,
                );
                messageHTML = renderLocation(
                    mainClass,
                    subClass,
                    messages[index].pushname,
                    messages[index].time,
                    locationSlot,
                );
                break;

            case "document":
                const documentSlot = renderDocumentSlot(
                    messages[index].body,
                    messages[index].media,
                );
                messageHTML = renderDocument(
                    mainClass,
                    subClass,
                    messages[index].pushname,
                    messages[index].time,
                    documentSlot,
                );
                break;

            case "video":
                const videoSlot = renderVideoSlot(
                    messages[index].pushname,
                    messages[index].media,
                );
                messageHTML = renderVideo(
                    mainClass,
                    subClass,
                    messages[index].pushname,
                    messages[index].time,
                    videoSlot,
                );
                break;

            default:
                messageHTML = `
                <div class="row message-body">
                    <div class="col-12 ${mainClass}">
                        <div class="${subClass}">
                            <div class="message-text">${messages[index].body}</div>
                            <span class="message-time pull-right">${convertTime(messages[index].time)}</span>
                            <span class="message-time pull-right">${messages[index].pushname}</span>
                        </div>
                    </div>
                </div>`;
        }

        if (prepend) {
            // Preserve scroll position when prepending
            const oldScrollHeight = conversation.prop("scrollHeight");
            conversation.prepend(messageHTML);
            const newScrollHeight = conversation.prop("scrollHeight");
            conversation.scrollTop(newScrollHeight - oldScrollHeight);
        } else {
            conversation.append(messageHTML);
            // Scroll to bottom for new messages
            conversation.scrollTop(conversation.prop("scrollHeight"));
        }
    });
};
