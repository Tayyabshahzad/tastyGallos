
// importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
// importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
// firebase.initializeApp({
//     apiKey: "AIzaSyDOw8Oak0LI272fhIKlUIOD9A1vIQcCvYE",
//     databaseURL: 'https://tastygallosnotifications.firebaseio.com',
//     authDomain: "tastygallosnotifications.firebaseapp.com",
//     projectId: "tastygallosnotifications",
//     storageBucket: "tastygallosnotifications.appspot.com",
//     messagingSenderId: "665538508672",
//     appId: "1:665538508672:web:55031af965ae20b4603365",
//     measurementId: "G-TJFJWJMVEN"
// });
// const messaging = firebase.messaging();
// messaging.setBackgroundMessageHandler(function (payload) {
//     console.log("Message received.", payload);
//     const title = "Hello world is awesome";
//     const options = {
//         body: "Your notificaiton message .",
//         icon: "https://cdn.freebiesupply.com/logos/thumbs/2x/firebase-1-logo.png",
//     };
//     return self.registration.showNotification(
//         title,
//         options,
//     );
// });
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDOw8Oak0LI272fhIKlUIOD9A1vIQcCvYE",
  authDomain: "tastygallosnotifications.firebaseapp.com",
  projectId: "tastygallosnotifications",
  storageBucket: "tastygallosnotifications.appspot.com",
  messagingSenderId: "665538508672",
  appId: "1:665538508672:web:55031af965ae20b4603365"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "https://cdn.freebiesupply.com/logos/thumbs/2x/firebase-1-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
