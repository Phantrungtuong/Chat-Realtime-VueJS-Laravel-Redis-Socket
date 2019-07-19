<template>

        <div class="d-flex justify-content-start mb-4">
            <div class="img_cont_msg">

            </div>
            <div class="msg_cotainer">
                {{ message.message }}
                <span class="msg_time" style="color: #fff" >{{ formatDate(message.created_at) }}</span>
            </div>
        </div>
<!--        <div class="d-flex justify-content-end mb-4">-->
<!--            <div class="msg_cotainer_send">-->
<!--                {{ message.message }}-->
<!--                <span class="msg_time_send">{{ message.created_at.split(' ')[1] }}</span>-->
<!--            </div>-->
<!--            <div class="img_cont_msg">-->
<!--            </div>-->
<!--        </div>-->

</template>

<script>
    import moment from 'moment'
    export default {
        name: "ChatItem",
        props: {
            message: {
                type: Object,
                default: {}
            }
        },
        methods: {
            formatDate: function (date) {
                return moment(date).format('H:mm:ss');
            }
        },

    }
</script>

<style scoped>

</style>