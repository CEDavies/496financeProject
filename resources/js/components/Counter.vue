<script setup>
    import { ref } from 'vue'

    const count = ref(0)
</script>

<template>
    {{ count }}

    <button @click="count++">
        Add Be the right one
    </button>
</template>