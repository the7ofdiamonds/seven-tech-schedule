import {
    sendPasswordResetEmail,
    getAuth
} from "firebase/auth";

export const forgot = async (Email) => {
    const auth = getAuth();

    try {
        await sendPasswordResetEmail(auth, Email);
        return 'An email has been sent with a link to reset your password.';
    } catch (error) {
        const errorCode = error.code;
        const errorMessage = error.message;

        return `Error (${errorCode}): ${errorMessage}`;
    }
};