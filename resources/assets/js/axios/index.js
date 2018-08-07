import axios from 'axios'

window.Cookies = require('cookies-js');

let token = window.Cookies('token')
let csrf_token = document.head.querySelector('meta[name="csrf-token"]');
const ax = axios.create()
ax.defaults.headers.common['Authorization'] = `Bearer ${token}`;
ax.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token.content;

export default ax