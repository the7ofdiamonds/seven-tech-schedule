import ReactDOM from 'react-dom';
import App from './App';

const sevenTechSchedule = document.getElementById('seven_tech_schedule');

if (sevenTechSchedule) {
  ReactDOM.createRoot(sevenTechSchedule).render(<><App /></>);
}