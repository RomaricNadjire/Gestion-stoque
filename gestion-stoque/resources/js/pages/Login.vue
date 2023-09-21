
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
    <div class="card col-5 offset-4 mt-5">
        <div class="card-header">
            Gestionaire de stock
        </div>
        <div class="card-body container">
            <div v-if="error" class="alert alert-danger">
                {{ error }}
            </div>
            <div v-if="message" class="alert alert-success">
                {{ message }}
            </div>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control mt-2" id="email" v-model="form.email" aria-describedby="emailHelp" placeholder="Entrer votre email">
                    <small v-if="errors.email" class="text-danger text-xs">{{ errors.email }}</small>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-2" id="password" v-model="form.password" placeholder="Mot de passe">
                    <small v-if="errors.password" class="text-danger text-xs">{{ errors.password }}</small>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <a href="/registration" class="nav-link offset-4 pt-3">Creer un compte</a>
                </div>
            </form>
        </div>
    </div>
</template>