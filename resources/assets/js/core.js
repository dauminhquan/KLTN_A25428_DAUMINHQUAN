/*
import axios from 'axios'
import configUrl from './config'
window.Cookies = require('cookies-js');

let token = window.Cookies('token')
axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
axios.post('/api/checkLogin').then(data => {

}).catch(err => {
    axios.get('/logout').then(data => {
        window.location = window.location.origin+'/login'
    }).catch(err => {
        console.log(err)
        new PNotify({
            title: 'Ohh! Có lỗi xảy ra rồi!',
            text: 'Đã có lỗi xảy ra từ server!',
            addclass: 'bg-danger'
        });
    })

})
$(document).ready(()=>{
    $('#logout').click(()=> {
        axios.post('/api/logout').then(data => {
            axios.get('/logout').then(data => {
                window.location = window.location.origin+'/login'
            }).catch(err => {
                console.log(err)
                new PNotify({
                    title: 'Ohh! Có lỗi xảy ra rồi!',
                    text: 'Đã có lỗi xảy ra từ server!',
                    addclass: 'bg-danger'
                });
            })
        }).catch(err => {
            new PNotify({
                title: 'Ohh! Có lỗi xảy ra rồi!',
                text: 'Đã có lỗi xảy ra từ server!',
                addclass: 'bg-danger'
            });
        })
    })
})*/
