<script setup>
    const props = defineProps({
        data: String
    })
</script>
<template>
    <div class="app">
        <h1>Hellow world</h1>
        <p>Bonjour {{data}}</p>
    </div>
</template>