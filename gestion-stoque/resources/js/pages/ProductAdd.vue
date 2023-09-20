
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
    <div class="card col-5 offset-4 my-5">
        <div class="card-header">
            Enregistrement
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
                    <label for="categorie">Categorie</label>
                    <input type="text" class="form-control mt-2" id="categorie" v-model="form.categorie"
                        aria-describedby="categorieHelp" placeholder="Entrer le nom de l'categorie">
                    <small v-if="errors.categorie" class="text-danger text-xs">{{ errors.categorie }}</small>
                </div>
                <div class="mb-2">
                    <label for="article">Article</label>
                    <input type="text" class="form-control mt-2" id="article" v-model="form.article"
                        aria-describedby="articleHelp" placeholder="Entrer le nom de l'article">
                    <small v-if="errors.article" class="text-danger text-xs">{{ errors.article }}</small>
                </div>
                <div class="mb-2">
                    <label for="prix">Prix</label>
                    <input type="number" class="form-control mt-2" id="prix" v-model="form.prix" aria-describedby="prixHelp"
                        placeholder="Entrer votre prix" min="0">
                    <small v-if="errors.prix" class="text-danger text-xs">{{ errors.prix }}</small>
                </div>
                <div class="mb-2">
                    <label for="quantite">Quantite</label>
                    <input type="number" class="form-control mt-2" id="quantite" v-model="form.quantite"
                        aria-describedby="quantiteHelp" placeholder="Entrer votre quantite" min="0">
                    <small v-if="errors.quantite" class="text-danger text-xs">{{ errors.quantite }}</small>
                </div>
                <div class="mb-2">
                    <label for="description">Description</label>
                    <textarea class="form-control mt-2" id="description" v-model="form.description"
                        aria-describedby="descriptionHelp" placeholder="Entrer votre description"></textarea>
                    <small v-if="errors.description" class="text-danger text-xs">{{ errors.description }}</small>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-100">Envoyer</button>
                </div>
            </form>
    </div>
</div></template>