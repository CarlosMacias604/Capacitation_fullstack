import { initializeApp } from "firebase/app";
import {getAuth} from 'firebase/auth'

const firebaseConfig = {
  apiKey: "AIzaSyATIMHJ2NIqRihMr9Rqa_2mQkcWNIvM2sc",
  authDomain: "vue-firebase-4b7e9.firebaseapp.com",
  projectId: "vue-firebase-4b7e9",
  storageBucket: "vue-firebase-4b7e9.firebasestorage.app",
  messagingSenderId: "1081549743782",
  appId: "1:1081549743782:web:5f789003a8c55238bd7667"
};

// Initialize Firebase
initializeApp(firebaseConfig);
const auth = getAuth();

export {auth};