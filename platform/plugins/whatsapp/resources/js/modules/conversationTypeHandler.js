 import { db, getDatabase, ref, query, orderByChild, equalTo, get, push, update } from './firebase';
 import { convertTime } from "./helpers.js";
 import { renderChatsList } from './renderingHelpers.js';
// Click handler for the conversation-type button

$(document).on("click", "#conversation-type", async function () {
    const $btn = $(this);
    const chat_id = $btn.data("chat_id");

    if (!chat_id) {
        console.warn("Chat ID not found.");
        return;
    }

    try {
        const nodeRef = ref(db, "whatsapp_conversation_type");
        const snapshot = await get(nodeRef);

        let keyToUpdate = null;
        let currentType = "open"; // default if not found

        if (snapshot.exists()) {
            snapshot.forEach((childSnap) => {
                if (childSnap.val().chat_id === chat_id) {
                    keyToUpdate = childSnap.key;
                    currentType = childSnap.val().conversation_type;
                }
            });
        }

        // Toggle type
        const newType = currentType === "open" ? "close" : "open";

        if (keyToUpdate) {
            // Update existing node
            await update(ref(db, `whatsapp_conversation_type/${keyToUpdate}`), {
                conversation_type: newType,
            });
        } else {
            // Create new node
            await push(nodeRef, {
                chat_id: chat_id,
                conversation_type: newType,
            });
        }

        // Update button UI
        if (newType === "close") {
            $btn.data("action", "close")
                .removeClass("btn-secondary")
                .addClass("btn-success")
                .text("Open Conversation");
        } else {
            $btn.data("action", "open")
                .removeClass("btn-success")
                .addClass("btn-secondary")
                .text("Close Conversation");
        }
    } catch (error) {
        console.error("Error toggling conversation type:", error);
    }
});

// Function to handle conversation type

export async function handleConversation(chat_id) {
    try {
        const nodeRef = ref(db, "whatsapp_conversation_type");

        const snapshot = await get(nodeRef);

        if (snapshot.exists()) {
            // Check if chat_id already exists
            let exists = false;
            snapshot.forEach((childSnap) => {
                if (childSnap.val().chat_id === chat_id) {
                    // console.log(`Chat ID ${chat_id} found. Conversation type:`, childSnap.val().conversation_type);
                    exists = true;

                    const $btn = $("#conversation-type");

                    if (childSnap.val().conversation_type === "close") {
                        // Set data attributes: action and chat_id
                        $btn.data({ action: "open", chat_id: chat_id })
                            .removeClass("btn-secondary")
                            .addClass("btn-success")
                            .text("Open Conversation");
                    } else {
                        // Set data attributes: action and chat_id
                        $btn.data({ action: "close", chat_id: chat_id })
                            .removeClass("btn-success")
                            .addClass("btn-secondary")
                            .text("Close Conversation");
                    }
                }
            });

            if (!exists) {
                // Add new chat_id with conversation_type 'open'
                await push(nodeRef, {
                    chat_id: chat_id,
                    conversation_type: "open",
                });
                $("#conversation-type").data("action", "close");
                $("#conversation-type")
                    .data({ chat_id })
                    .toggleClass("btn-secondary btn-success")
                    .text("Close Conversation");
                console.log(
                    `Chat ID ${chat_id} added with conversation_type 'open'.`,
                );
            }
        } else {
            // Node doesn't exist, create it and add chat_id
            await push(nodeRef, {
                chat_id: chat_id,
                conversation_type: "open",
            });
            console.log(
                `Node created and Chat ID ${chat_id} added with conversation_type 'open'.`,
            );
        }
        $("#conversation-type").removeClass("d-none");
    } catch (error) {
        console.error("Error handling conversation:", error);
    }
}


$(function()
{
    $('#conversations_types').on('change', function () {
        // $('.sideBar').empty();
        $('.sideBar').html(`
            <div class="d-flex justify-content-center align-items-center p-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `);
    
        const selectedConversationType = this.value;
        if (selectedConversationType === "all") {
            renderChatsList();
            return;
        }
    
        // Reference with query
        const convRef = query(
            ref(db, "whatsapp_conversation_type"),
            orderByChild("conversation_type"),
            equalTo(selectedConversationType)
        );
    
        get(convRef).then((snapshot) => {
            if (!snapshot.exists()) {
                console.log("No open conversations found");
                return;
            }
    
            const chatIds = [];
            snapshot.forEach((child) => {
                chatIds.push(child.val().chat_id);
            });
    
            // console.log("Open chat_ids:", chatIds);
    
            $.ajax({
                url: `https://api.ultramsg.com/${instance}/chats?token=${token}`,
                method: "GET",
                headers: { "content-type": "application/x-www-form-urlencoded" }
            }).done(function (response) {
                $.each(response, function (index, chat) {
                    const chat_id = chat.id;
                    const selector = chat_id.replace('@', '').replace('.', '');
    
                    if (!chatIds.includes(chat_id)) return;
                    $('.sideBar').empty();
                    $('.sideBar').append(`
                        <div class="row sideBar-body" 
                             data-chat_id="${chat_id}" 
                             data-selector="${selector}">
                            
                            <div class="col-3 sideBar-avatar avatar${selector}"></div>
                            <div class="col-9 sideBar-main">
                                <div class="row">
                                    <div class="col-8 sideBar-name">
                                        <span class="name-meta">${chat.name}</span>
                                    </div>
                                    <div class="col-4 pull-right sideBar-time">
                                        <span class="time-meta pull-right">${convertTime(chat.last_time)}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
    
                    // unread badge
                    if (chat.unread > 0) {
                        $(`[data-selector=${selector}]`).append(`
                            <span class="unread">${chat.unread}</span>
                        `);
                    }
    
                    // fetch avatar
                    $.ajax({
                        url: `https://api.ultramsg.com/${instance}/contacts/image?token=${token}&chatId=${chat_id}`,
                        method: "GET",
                        headers: { "content-type": "application/x-www-form-urlencoded" }
                    }).done(function (data) {
                        const $avatar = $(`.avatar${selector}`).empty();
    
                        if (data.success) {
                            $avatar.append(`<div class="avatar-icon"><img src="${data.success}"></div>`);
                        } else {
                            $avatar.append(`<i class="fas fa-user-circle fa-3x text-secondary"></i>`);
                        }
                    });
                });
            });
    
        }).catch((error) => {
            console.error("Error fetching conversations:", error);
        });
    });
    
});
