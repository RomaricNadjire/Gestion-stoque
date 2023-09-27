
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
    articles: [{ name: null, quantite: null }]
})

defineProps({
    error: String,
    message: String,
    products: Object,
    categories: Object,
    errors: Object,
})
        
function addproduct() {
    form.articles.push({ name: null, quantite: null })
    return "Veillez choisir le produit numero "+form.articles.length
}

function submit() {
    router.post('out', form)
}
</script>

<template>
    <div class="card w-50 br-10">
        <div class="card-header">
            Gestion des sortie
        </div>
        <div class="card-body">
            <div v-if="error" class="d-flex br-1 alert alert-danger d-flex justify-content-between">
                {{ error }}
                <a href="/" class="btn btn-dark bg-transparent text-dark py-0 ">Consulter</a>
            </div>
            <form @submit.prevent="submit" class="d-flex">
                <div v-for="(article, index) in form.articles" :key="index" class="w-100 d-flex-center">
                <div class="mb-3 input-container">
                        <select class="form-control mt-2" id="product" v-model="article.name" name="name">
                            <option v-for="product in products">{{ product.name }}</option>
                        </select>
                        <label for="product">Product</label>
                        <small v-if="errors.name" class="text-danger text-xs">{{ errors.name }}</small>
                    </div>
                <div class="mb-3 input-container">
                        <input type="number" class="form-control mt-2" id="quantite" v-model="article.quantite" name="quantite" aria-describedby="quantiteHelp" min="0">
                        <label for="quantite">Quantite</label>
                        <small v-if="errors.quantite" class="text-danger text-xs">{{ errors.quantite }}</small>
                    </div>
                </div>
                <div class="mb-3 form-bottom-2">
                    <li class="btn form-bottom-button-2" @click="addproduct">Ajouter un produit</li>
                    <button type="submit" class="btn form-bottom-button">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</template>