import axios from 'axios';
import { getAuth } from "firebase/auth";

import { projectAuth } from '../services/firebase/config.js';

export const logout = async () => {
    const auth = getAuth();

    try {
        await projectAuth.signOut();
        const response = await axios.post('/wp-json/thfw/users/v1/logout');
        return response.data;
    } catch (error) {
        console.error('Error:', error.message);
    }
};