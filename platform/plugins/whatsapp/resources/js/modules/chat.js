// platform/plugins/whatsapp/resources/js/chat.js
import {
    db,
    ref,
    get,
    set,
    update,
    push,
    onChildAdded,
    query,
    orderByChild,
    limitToLast,
    child,
    orderByKey,
    startAfter,
    endBefore,
} from "./firebase";

// import { convertTime } from "./helpers.js";

import { renderChatMessages } from "./renderingHelpers.js";

import { handleConversation } from "./conversationTypeHandler.js";
import { sendTxtMsg } from "./sendTextMsgHandler.js";

import {
    loadInitial,
    loadRecentMessages,
    loadOlderMessages,
} from "./chatLoader.js";

import { GlobalState } from "./state.js";

$(function () {
    const { instance, token, referenceId } = window.ultraMsgConfig;


    $('#backChat').on('click',function(){
         
        $(".side").css({"display": "block"}); 
      });
      if (window.innerWidth > 700){
        $("#backChat").css({"display": "none"});
      }


    // send Message
    $(document).on("keypress", function (e) {
        if (e.which == 13) {
            let chat_id = $("#conversation").data("receiver_id");
            let message = $("#comment").val();

            if (message) {
                sendTxtMsg(chat_id, message,instance, token, referenceId);
                $("#conversation").scrollTop(
                    $("#conversation").prop("scrollHeight"),
                );
                $("#comment").val("");
            }

            return false;
        }
    });
    // End send Message

    $(document).on("click", ".sideBar-body", function () {
        GlobalState.instance_id = instance.split(/(\d+)/)[1];
        GlobalState.chat_id = $(this).data("chat_id");

        //Update UI
        ///////////////////////////////////////////
        $(".sideBar-body").removeClass("hover");
        $(this).addClass("hover");
        $(".conversation").removeClass("d-none");
        $(".start-bg").addClass("d-none");
        $(this).find(".unread").remove();
        let avatarImgSrc = $(this).find("img").attr("src");
        $(".conversation .heading-avatar-icon")
            .empty()
            .append(` <img src="` + avatarImgSrc + `"> `);

        if (window.innerWidth < 700) 
        {
            $(".side").css({ display: "none" });
        }
        else{
            $(".side").css({ display: "block" });
        }
        ///////////////////////////////////////////

        var chatName = $(this).find(".name-meta").text();
        $("a.heading-name-meta").empty().text(chatName);
        var chat_img = $(this).find("img").attr("src");
        $("#conversation-type").data("chat_img", chat_img);
        var chat_title = $(this).find(".name-meta").text();
        $("#conversation-type").data("chat_title", chat_title);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        handleConversation(GlobalState.chat_id);
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $("#conversation").empty();
        $("#conversation").data("receiver_id", GlobalState.chat_id);

        // // Example usage:
        // chat_id = "963995275137@c.us";
        // instance_id = "117593";

        if (GlobalState.chat_id && GlobalState.instance_id) {
            loadInitial(GlobalState.chat_id, GlobalState.instance_id);
        } else {
            console.warn("Missing chat_id or instance_id");
        }
    });
});

///////////////////////////////////////////////////////////////////////////////
// 1. Capture the time when the listener is attached
const loadTime = Date.now();

// 2. Reference your chat node
const chatRef = ref(db, "whatsapp_chat");

// 3. Listen for children being added
onChildAdded(chatRef, (snapshot) => {
    const data = snapshot.val();
    const messageTimestamp = (data.time || 0) * 1000;

    // Only process NEW messages
    if (messageTimestamp <= loadTime) return;

    // ====== REORDER CHAT SIDEBAR & UPDATE UNREAD COUNT ======
    const chatId = data.event_type === "message_received" ? data.from : data.to;
    const chatElement = $('[data-chat_id="' + chatId + '"]');

    // Move chat to top
    chatElement.insertBefore(".sideBar-body:first-child");

    // Update unread badge
    if (data.event_type === "message_received") {
        const unreadEl = chatElement.find(".unread");
        if (unreadEl.length) {
            unreadEl.html(parseInt(unreadEl.html()) + 1);
        } else {
            chatElement.append('<span class="unread">1</span>');
        }
    }

    // ====== RENDER MESSAGE IF CONVERSATION IS OPEN ======
    const receiver_id = $("#conversation").data("receiver_id");
    if (
        receiver_id &&
        ((data.event_type === "message_received" && receiver_id == data.from) ||
            (data.event_type !== "message_received" && receiver_id == data.to))
    ) {
        renderChatMessages([data], false); // append new message
    }
});
