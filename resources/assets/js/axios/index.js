import axios from 'axios'

window.Cookies = require('cookies-js');

let token = window.Cookies('token')
const ax = axios.create()
ax.defaults.headers.common['Authorization'] = `Bearer ${token}`;

export default ax