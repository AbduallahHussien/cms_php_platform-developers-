import { db,
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
    endBefore } from './firebase';

    import { renderChatMessages } from './renderingHelpers.js';

    const MESSAGES_PER_PAGE = 5;
    let chatMessages =[];
    let oldestTime = null;

    import { GlobalState } from './state.js';

    // Load latest N messages
    export async function loadRecentMessages(chat_id,instance_id) {
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

        messages.sort((a, b) => a.time - b.time);
      }

      return messages;
    }

    // Load older messages (pagination)
  export async function loadOlderMessages(chat_id,instance_id, oldestTime) {
    const messagesRef = ref(db, "whatsapp_chat");

    const q = query(
      messagesRef,
      orderByChild("time"),
      endBefore(oldestTime), // load messages older than current oldest
      limitToLast(MESSAGES_PER_PAGE)
    );

    const snapshot = await get(q);
    // console.log('snapshot',snapshot)
    let messages = [];
    if (snapshot.exists()) {
      snapshot.forEach((childSnapshot) => {
        const msg = childSnapshot.val();
        console.log('instance_id',instance_id);
        console.log('msg',msg);
        console.log('chat_id',chat_id);
        if (msg.chat_id === instance_id && String(msg.msg_id).includes(chat_id)) {
          messages.push(msg);
        }
      });

      messages.sort((a, b) => a.time - b.time);
    }

    return messages;
  }


  export async function loadInitial(chat_id,instance_id) {
    console.log('loadInitial');
    let messages = await loadRecentMessages(chat_id,instance_id);
    console.log('messages',messages)
    chatMessages = messages;
    oldestTime = chatMessages.length ? chatMessages[0].time : null;
    renderChatMessages(chatMessages);
  }


  $(document).on("click", "#view-more", async function () {

    if (!oldestTime) return;
  
    let olderMessages = await loadOlderMessages(GlobalState.chat_id,GlobalState.instance_id,oldestTime);
    console.log('olderMessages',olderMessages)
    if (olderMessages.length > 0) {
      chatMessages = [...olderMessages, ...chatMessages];
      oldestTime = chatMessages[0].time; // update oldest
      renderChatMessages(olderMessages);
    } else {
      // no more messages
      $("#view-more").prop("disabled", true).text("No more messages");
    }
  });

   // async function loadChatMessages(chat_id, instance_id) {
    //   const snapshot = await get(child(ref(db), 'whatsapp_chat'));
   
    //   if (snapshot.exists()) {
         
    //     let messages = [];
    
    //     snapshot.forEach(childSnapshot => {
    //       const msg = childSnapshot.val();

    //       if (
    //         msg.chat_id === instance_id 
    //         &&
    //         String(msg.msg_id).includes(chat_id)
    //       ) {
    //         messages.push(msg);
    //       }
    //     });
    
    //     // Sort by time ascending
    //     messages.sort((a, b) => a.time - b.time); 
    
    //     // Now use `messages` array to update DOM
    //     return messages;
    //   } else { 
    //     return [];
    //   }
    // }