window.Vue = require("vue");
require('./bootstrap');

import { createApp } from 'vue'

// document
// https://viblo.asia/p/xay-dung-ung-dung-chat-laravel-3Q75wpa2KWb
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';

createApp({
    components: {
        ChatMessages,
        ChatForm
    },
    data: () => ({
        messages: []
    }),
    created() {
        this.fetchMessages();

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
        });
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        }
    }
}).mount('#app');