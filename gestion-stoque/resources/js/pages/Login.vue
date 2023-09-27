
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
        email: null,
        password: null,
    })

    defineProps({
        error: String,
        message: String,
        errors: Object
    })

    function submit(){
        router.post('loger', form)
    }
</script>

<template>
    <div class="card w-50 br-10">
        <div class="card-header">
            Gestionaire de stock
        </div>
        <div class="card-body">
            <div v-if="error" class="d-flex br-10 alert alert-danger">
                {{ error }}
            </div>
            <div v-if="message" class="d-flex br-1 alert alert-success">
                {{ message }}
            </div>
            <form @submit.prevent="submit">
                <div class="mb-3 input-container">
                    <input type="email" class="form-control mt-2" id="email" v-model="form.email" aria-describedby="emailHelp">
                    <label for="email">Email address</label>
                    <small v-if="errors.email" class="text-danger text-xs">{{ errors.email }}</small>
                </div>
                <div class="mb-3 input-container">
                    <input type="password" class="form-control mt-2" id="password" v-model="form.password">
                    <label for="password">Password</label>
                    <small v-if="errors.password" class="text-danger text-xs">{{ errors.password }}</small>
                </div>
                <div class="mb-3 form-bottom">
                    <button type="submit" class="btn form-bottom-button">Envoyer</button>
                    <a href="/registration" class="nav-link offset-4 pt-3">Creer un compte</a>
                </div>
            </form>
        </div>
    </div>
</template>