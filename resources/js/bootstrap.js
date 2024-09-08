import axios from 'axios';
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    once: true,
    easing: 'ease',
});

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
