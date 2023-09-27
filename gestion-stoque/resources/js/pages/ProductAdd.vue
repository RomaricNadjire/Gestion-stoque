
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
    categorie: null,
    quantite: null,
    article: null,
    prix: null,
    description: null,
})

defineProps({
    error: String,
    message: String,
    errors: Object
})

function submit() {
    router.post('add', form)
}
</script>

<template>
    <div class="card w-50">
        <div class="card-header">
            Enregistrement
        </div>
        <div class="card-body">
            <div v-if="error" class="d-flex br-1 alert alert-danger">
                {{ error }}
            </div>
            <div v-if="message" class="d-flex br-1 alert alert-success">
                {{ message }}
            </div>
            <form @submit.prevent="submit">
                <div class="mb-3 input-container">
                    <input type="text" class="form-control mt-2" id="categorie" v-model="form.categorie" aria-describedby="categorieHelp">
                    <label for="categorie">Categorie</label>
                    <small v-if="errors.categorie" class="text-danger text-xs">{{ errors.categorie }}</small>
                </div>
                <div class="mb-2 input-container">
                    <input type="text" class="form-control mt-2" id="article" v-model="form.article" aria-describedby="articleHelp">
                    <label for="article">Article</label>
                    <small v-if="errors.article" class="text-danger text-xs">{{ errors.article }}</small>
                </div>
                <div class="mb-2 input-container">
                    <input type="number" class="form-control mt-2" id="prix" v-model="form.prix" aria-describedby="prixHelp" min="0">
                    <label for="prix">Prix</label>
                    <small v-if="errors.prix" class="text-danger text-xs">{{ errors.prix }}</small>
                </div>
                <div class="mb-2 input-container">
                    <input type="number" class="form-control mt-2" id="quantite" v-model="form.quantite" aria-describedby="quantiteHelp" min="0">
                    <label for="quantite">Quantite</label>
                    <small v-if="errors.quantite" class="text-danger text-xs">{{ errors.quantite }}</small>
                </div>
                <div class="mb-2 input-container">
                    <textarea class="form-control mt-2" id="description" v-model="form.description" aria-describedby="descriptionHelp"></textarea>
                    <label for="description">Description</label>
                    <small v-if="errors.description" class="text-danger text-xs">{{ errors.description }}</small>
                </div>
                <div class="form-bottom">
                    <button type="submit" class="btn form-bottom-button">Envoyer</button>
                </div>
            </form>
    </div>
</div></template>