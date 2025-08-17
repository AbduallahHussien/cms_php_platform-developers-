import { db, ref, get, update, push } from './firebase';

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
