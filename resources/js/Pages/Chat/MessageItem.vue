<template>
    <div>{{ message.user.name }}: {{ message.content }}</div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
