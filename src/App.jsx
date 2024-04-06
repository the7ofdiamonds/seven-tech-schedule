import { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import { Provider } from 'react-redux';

import store from './model/store.js';

import LoadingComponent from './loading/LoadingComponent';

const Schedule = lazy(() => import('./views/Schedule.jsx'));
const Event = lazy(() => import('./views/Event.jsx'));

function App() {
  return (
    <>
      <Provider store={store}>
        <Router>
          <Suspense fallback={<LoadingComponent />}>
            <Routes>
              <Route path="/" element={<Schedule />} />
              <Route path="/about" element={<Schedule />} />
              <Route path="/schedule" element={<Schedule />} />
              <Route path="/schedule/:event" element={<Event />} />
            </Routes>
          </Suspense>
        </Router>
      </Provider>
    </>
  );
}

export default App;
