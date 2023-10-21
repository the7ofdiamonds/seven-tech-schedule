import { configureStore } from '@reduxjs/toolkit';

import { scheduleSlice } from '../controllers/scheduleSlice';
import { usersSlice } from '../controllers/usersSlice.js';

const store = configureStore({
    reducer: {
        schedule: scheduleSlice.reducer,
        users: usersSlice.reducer,
    }
});

export default store;