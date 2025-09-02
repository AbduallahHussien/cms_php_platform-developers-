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


// Eng Abdullah Firebase config

// const firebaseConfig = {
//     apiKey: "AIzaSyBWLy9IP1PlMLfQBhBYFq1G8UL84zaj8VE",
//     authDomain: "new-whatsapp-53b1c.firebaseapp.com",
//     databaseURL: "https://new-whatsapp-53b1c-default-rtdb.firebaseio.com",
//     projectId: "new-whatsapp-53b1c",
//     storageBucket: "new-whatsapp-53b1c.firebasestorage.app",
//     messagingSenderId: "1097751536639",
//     appId: "1:1097751536639:web:4b0fa8a4c38fc354337dca",
//     measurementId: "G-3DTLV3YRMF"
// };


//Ibrahim Mohammad

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

// console.log('db',db);

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
