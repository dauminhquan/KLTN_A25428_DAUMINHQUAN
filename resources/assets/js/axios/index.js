import axios from 'axios'

let token = localStorage.getItem('token')
let csrf_token = document.head.querySelector('meta[name="csrf-token"]');
const ax = axios.create()
ax.defaults.headers.common['Authorization'] = `Bearer ${token}`;
ax.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token.content;

export default ax