import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';

const initialState = {
    locationLoading: false,
    locationError: '',
    locations: '',
    headquarters: ''
};

export const getLocations = createAsyncThunk('location/getLocations', async () => {

    try {
        const response = await fetch(`/wp-json/seven-tech/locations/v1/`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        throw error;
    }
});

export const getHeadquarters = createAsyncThunk('location/getHeadquarters', async () => {

    try {
        const response = await fetch(`/wp-json/seven-tech/locations/v1/headquarters`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        if (!response.ok) {
            const errorData = await response.json();
            const errorMessage = errorData.message;
            throw new Error(errorMessage);
        }

        const responseData = await response.json();
        return responseData;
    } catch (error) {
        throw error;
    }
});

export const scheduleSlice = createSlice({
    name: 'schedule',
    initialState,
    extraReducers: (builder) => {
        builder
            .addCase(getLocations.pending, (state) => {
                state.locationLoading = true
                state.locationError = ''
            })
            .addCase(getLocations.fulfilled, (state, action) => {
                state.locationLoading = false;
                state.locationError = null;
                state.locations = action.payload
            })
            .addCase(getLocations.rejected, (state, action) => {
                state.locationLoading = false
                state.locationError = action.error.message
            })
            .addCase(getHeadquarters.pending, (state) => {
                state.locationLoading = true
                state.locationError = ''
            })
            .addCase(getHeadquarters.fulfilled, (state, action) => {
                state.locationLoading = false;
                state.locationError = null;
                state.headquarters = action.payload
            })
            .addCase(getHeadquarters.rejected, (state, action) => {
                state.locationLoading = false
                state.locationError = action.error.message
            })
    }
})

export default scheduleSlice;