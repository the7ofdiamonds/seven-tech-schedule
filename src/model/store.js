import { configureStore } from '@reduxjs/toolkit';

import { scheduleSlice } from '../controllers/scheduleSlice';

const store = configureStore({
    reducer: {
        schedule: scheduleSlice.reducer,
    }
});

export default store;