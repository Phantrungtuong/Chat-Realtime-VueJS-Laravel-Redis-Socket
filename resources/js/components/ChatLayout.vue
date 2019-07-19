<template>
    <div class="col-md-8 col-xl-6 chat">
        <div class="card">
            <div class="card-header msg_head">
                <div class="d-flex bd-highlight">
                    <div class="img_cont">
                        <span class="online_icon"></span>
                    </div>
                    <div class="user_info">
                        <span> {{user.name}}</span>
                        <p> 12 Messages</p>
                    </div>

                </div>
            </div>
            <div class="card-body msg_card_body">
                <ChatItem v-for="(message, index) in list_messages" :key="index" :message="message"></ChatItem>
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <label for="inp" class="inp">
                        <input type="text" v-model="message" @keyup.enter="sendMessage" id="inp" >
                        <span class="border"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ChatItem from './ChatItem.vue'
    export default {
        components: {
            ChatItem
        },
        data() {
            return {
                message: '',
                list_messages: [],
                csrfToken: '',
                user: ''
            }
        },
        created() {
            this.loadMessage();

            Echo.channel('chatrealtime_database_chatroom')
                .listen('MessagePosted', (data) => {
                    let message = data.message
                    message.user = data.user
                    this.list_messages.push(message)
                    this.scrollToBottom()
                })
        },
        mounted () {
            this.csrfToken = document.head.querySelector('meta[name="csrf-token"]').content
            setTimeout(() => {
                this.scrollToBottom()
            }, 200)

        },
        methods: {
            loadMessage() {
                axios.get('/messages')
                    .then(response => {
                        this.list_messages = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    });
                axios({
                    method: 'GET',
                    url: '/getUserInfo',

                })
                    .then(res =>{
                        this.user = res.data
                    })
                    .catch(err =>{
                        console.log(err);
                    })
            },
            scrollToBottom () {
                const container = document.querySelector('.messages')
                if (container) {
                    $(container).animate(
                        { scrollTop: container.scrollHeight},
                        { duration: 'medium', easing: 'swing' }
                    )
                }
            },
            sendMessage() {
                axios.post('/messages', {
                    message: this.message
                })
                    .then(response => {
                        this.list_messages.push({
                            message: this.message,
                            created_at: new Date().toJSON().replace(/T|Z/gi, ' '),
                            user: this.$root.currentUserLogin
                        })
                        this.message = ''
                        this.scrollToBottom()
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }
        }
    }
</script>

<style scoped>

</style>