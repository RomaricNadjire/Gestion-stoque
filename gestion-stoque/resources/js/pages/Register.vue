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
    const form = useForm({
        name: null,
        email: null,
        password: null,
        confpassword: null,
    })
    
    defineProps({
        error: String,
        message: String,
        errors: Object
    })

    function submit(){
        router.post('registration', form)
    }
</script>
<template>
    <div class="card col-5 offset-4 mt-4">
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
                    <label for="name">Noms</label>
                    <input type="name" class="form-control  mt-2" id="name" v-model="form.name" aria-describedby="nameHelp" placeholder="Nom et prenom">                    
                    <small v-if="errors.name" class="text-danger text-xs">{{ errors.name }}</small>
                </div>
                <div class="mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control  mt-2" id="email" v-model="form.email" aria-describedby="emailHelp" placeholder="Entrer votre email">
                    <small v-if="errors.email" class="text-danger text-xs">{{ errors.email }}</small>
                </div>
                <div class="mb-3">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control  mt-2" id="password" v-model="form.password" placeholder="Mot de passe">
                    <small v-if="errors.password" class="text-danger text-xs">{{ errors.password }}</small>
                </div>
                <div class="mb-3">
                    <label for="confpassword">Confirmer</label>
                    <input type="password" class="form-control  mt-2" id="confpassword" v-model="form.confpassword" placeholder="confirmer mot de passe">
                    <small v-if="errors.confpassword" class="text-danger text-xs">{{ errors.confpassword }}</small>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <a href="login" class="nav-link offset-4 pt-3">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
</template>