import { db, ref, get, query, orderByChild, limitToLast, endAt } from './firebase';
import { renderChatMessages } from './renderingHelpers.js';
import { GlobalState } from './state.js';

const MESSAGES_PER_PAGE = 5;
let chatMessages = [];
let oldestTime = null;

// ------------------ Load Latest Messages ------------------
export async function loadRecentMessages(chat_id, instance_id) {
  const messagesRef = ref(db, "whatsapp_chat");

  const q = query(
    messagesRef,
    orderByChild("time"),
    limitToLast(MESSAGES_PER_PAGE)
  );

  const snapshot = await get(q);

  let messages = [];
  if (snapshot.exists()) {
    snapshot.forEach((childSnapshot) => {
      const msg = childSnapshot.val();
      if (msg.chat_id === instance_id && String(msg.msg_id).includes(chat_id)) {
        messages.push(msg);
      }
    });

    // Always ascending: oldest → newest
    messages.sort((a, b) => a.time - b.time);
  }

  return messages;
}

// ------------------ Load Older Messages ------------------
export async function loadOlderMessages(chat_id, instance_id, oldestTime) {
  const messagesRef = ref(db, "whatsapp_chat");

  const boundary = Number(oldestTime);
  if (!Number.isFinite(boundary)) return [];

  const q = query(
    messagesRef,
    orderByChild("time"),
    endAt(boundary - 1), // strictly older than current oldest
    limitToLast(MESSAGES_PER_PAGE)
  );

  const snapshot = await get(q);

  let messages = [];
  if (snapshot.exists()) {
    snapshot.forEach((childSnapshot) => {
      const msg = childSnapshot.val();
      if (msg.chat_id === instance_id && String(msg.msg_id).includes(chat_id)) {
        messages.push(msg);
      }
    });

    // Always ascending
    messages.sort((a, b) => a.time - b.time);
  }
  return messages;
}

// ------------------ Initial Load ------------------
export async function loadInitial(chat_id, instance_id) {
  const recentMessages = await loadRecentMessages(chat_id, instance_id);

  chatMessages = recentMessages.slice();

  // oldest = first element in ascending list
  oldestTime = chatMessages.length ? chatMessages[0].time : null;

  renderChatMessages(recentMessages);
}

// ------------------ View More Button ------------------
$(document).on("click", "#view-more", async function () {
  if (!Number.isFinite(Number(oldestTime))) return;

  const $btn = $(this).prop("disabled", true);
  $btn.find(".btn-text").text("Loading..."); // only update text

  try {
    const olderMessages = await loadOlderMessages(
      GlobalState.chat_id,
      GlobalState.instance_id,
      oldestTime
    );

    if (olderMessages.length > 0) {
      chatMessages = [...olderMessages, ...chatMessages];

      // update oldestTime to the true oldest
      oldestTime = chatMessages[0].time;

      renderChatMessages(olderMessages, true); // prepend mode
      $btn.prop("disabled", false);
      $btn.find(".btn-text").text("view more"); // only update text
    } else {
      $btn.prop("disabled", true);
      $btn.find(".btn-text").text("No more messages"); // update text
      $btn.find("i").remove(); // remove the icon
    }
  } catch (e) {
    $btn.prop("disabled", false);
    $btn.find(".btn-text").text("View more"); // only update text
    console.error(e);
  }
});

