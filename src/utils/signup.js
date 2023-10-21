import {
    createUserWithEmailAndPassword, getAuth
} from "firebase/auth";

import axios from 'axios';

export const signup = async (User_Name, Email, Password) => {
    const auth = getAuth();

    try {
        await createUserWithEmailAndPassword(auth, Email, Password).then(async () => {
            const new_user_data = {
                'user_login': User_Name,
                'user_email': Email,
                'user_password': Password
            };

            await axios.post('/wp-json/thfw/users/v1/signup', new_user_data);
        })
        return 'You are now a user.';
    } catch (error) {
        const errorCode = error.code;
        const errorMessage = error.message;

        return `Error (${errorCode}): ${errorMessage}`;
    }
};