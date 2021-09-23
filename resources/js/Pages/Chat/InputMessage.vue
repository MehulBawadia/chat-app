<template>
    <div class="relative h-10 m-1">
        <div class="border-t-2 border-gray-300 grid grid-cols-6">
            <input type="text" placeholder="Something..." class="col-span-5 outline-none p-1" v-model="message" @keyup.enter="sendMessage()" />

            <button @click="sendMessage()" class="place-self-end bg-gray-500 hover:bg-blue-700 p-1 mt-1 rounded text-white">Send</button>
        </div>
    </div>
</template>

<script>
    import Input from '../../Jetstream/Input.vue'

    export default {
        components: {
            Input
        },

        props: ['room'],

        data: function () {
            return {
                message: "",
            }
        },

        methods: {
            sendMessage() {
                if (this.message == '') {
                    return;
                }

                axios.post('/chat/room/' + this.room.id + '/message', {
                    content: this.message
                }).then(response => {
                    if (response.status == 201) {
                        this.message = '';
                        this.$emit('messagesent');
                    }
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
