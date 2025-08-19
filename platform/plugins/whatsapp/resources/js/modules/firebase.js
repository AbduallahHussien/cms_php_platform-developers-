// ✅ Import Firebase SDK from node_modules
import { initializeApp } from "firebase/app";
import {
    getDatabase,
    ref,
    update,
    set,
    push,
    onValue,
    onChildAdded,
    query,
    orderByChild,
    limitToLast,
    get,
    child,
    endBefore,
    orderByKey,
    startAfter,
    endAt,
    equalTo
} from "firebase/database";

// ✅ Your Firebase config

// const firebaseConfig = {
//   apiKey: "AIzaSyDe0VFHWAGiX5NtMRoU9qv6I5JQOjfDflk",
//   authDomain: "whatsapp-plugin.firebaseapp.com",
//   databaseURL: "https://whatsapp-plugin-default-rtdb.asia-southeast1.firebasedatabase.app",
//   projectId: "whatsapp-plugin",
//   storageBucket: "whatsapp-plugin.firebasestorage.app",
//   messagingSenderId: "87992066373",
//   appId: "1:87992066373:web:689c295eb199c3a7419e2c"
// };

const firebaseConfig = {
    apiKey: "AIzaSyAhB2aa1nwp0lJP3gjUQuVY0Mi80v7OhGE",
    authDomain: "whatsapp-test-7bc2f.firebaseapp.com",
    databaseURL: "https://whatsapp-test-7bc2f-default-rtdb.firebaseio.com", // ⚠️ required for Realtime Database
    projectId: "whatsapp-test-7bc2f",
    storageBucket: "whatsapp-test-7bc2f.firebasestorage.app",
    messagingSenderId: "555256436202",
    appId: "1:555256436202:web:f42dc8450bd5be02118e93",
};

// ✅ Initialize Firebase
const app = initializeApp(firebaseConfig);

const db = getDatabase(app);

// ✅ Export database so you can use it anywhere in Laravel
export {
    db,
    ref,
    set,
    push,
    update,
    onValue,
    orderByKey,
    onChildAdded,
    query,
    orderByChild,
    endBefore,
    limitToLast,
    get,
    child,
    endAt,
    startAfter,
    equalTo
};
