import axios from 'axios';
import {
  browserSessionPersistence,
  setPersistence,
  signInWithEmailAndPassword,
  getAuth,
} from 'firebase/auth';

import { projectAuth } from '../services/firebase/config.js';

export const login = async ( Email, Password) => {
  const auth = getAuth();

  try {
    await signInWithEmailAndPassword(auth, Email, Password);
    await setPersistence(auth, browserSessionPersistence);

    const user = projectAuth.currentUser;
    if (!user) {
      throw new Error('User not found.');
    }

    const token = await user.getIdToken();
    const data = { idToken: token, user_password: Password };
    await axios.post('/wp-json/thfw/users/v1/login', data);

    sessionStorage.setItem('idToken', token);
    sessionStorage.setItem('user_email', Email);
    return 'Login successful';
  } catch (error) {
    const errorCode = error.code;
    const errorMessage = error.message;

    return `Error (${errorCode}): ${errorMessage}`;
  }
};