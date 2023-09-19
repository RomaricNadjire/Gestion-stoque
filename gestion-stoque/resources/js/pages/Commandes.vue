
<script>
import Layout from '../layout/header.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

export default {
    // Using a render function...
    layout: (h, page) => h(Layout, [page]),

    // Using shorthand syntax...
    layout: Layout,
}
</script>
<script setup>
import { useForm } from '@inertiajs/vue3';
const form = useForm({
    quantite: null,
    quantite: null,
    prix: null,
    description: null,
})

defineProps({
    error: String,
    message: String,
    errors: Object
})

function submit() {
    router.post('loger', form)
}
</script>
<template>
    <p>jsdhljhfdofiwrfjwjhol</p>
</template>