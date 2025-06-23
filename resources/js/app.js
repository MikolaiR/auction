import './bootstrap';
import Alpine from 'alpinejs'
import axios from 'axios';
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

// Настройка axios
window.axios = axios;

// Настройка Alpine.js
window.Alpine = Alpine

// Настройка Notyf для уведомлений
window.notify = new Notyf({
    duration: 5000,
    position: {
        x: 'right',
        y: 'top',
    },
    types: [
        {
            type: 'success',
            background: '#28a745',
            icon: false
        },
        {
            type: 'error',
            background: '#dc3545',
            icon: false
        }
    ]
});

Alpine.start()
