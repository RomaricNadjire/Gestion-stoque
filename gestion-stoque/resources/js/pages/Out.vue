
<script>
import Layout from '../layout/header.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import { defineProps, defineEmits } from 'vue'


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
    <div class="card col-5 offset-4 mt-5">
        <div class="card-header">
            Gestion des sortie
        </div>
        <div class="card-body container">
            <div v-if="error" class="alert alert-danger d-flex justify-content-between">
                {{ error }}
                <a href="stock" class="btn btn-dark bg-transparent text-dark py-0 " 
                style="border-left-color: #fff;border-top-color: #fff;">Consulter</a>
            </div>
            <form @submit.prevent="submit">
                <div v-for="(article, index) in form.articles" :key="index">
                    <div class="mb-3">
                        <label for="product">Product</label>
                        <select class="form-control mt-2" id="product" v-model="article.name" name="name">
                            <option v-for="product in products">{{ product.name }}</option>
                        </select>
                        <small v-if="errors.name" class="text-danger text-xs">{{ errors.name }}</small>
                    </div>
                    <div class="mb-3">
                        <label for="quantite">Quantite</label>
                        <input type="number" class="form-control mt-2" id="quantite" v-model="article.quantite" name="quantite"
                            aria-describedby="quantiteHelp" placeholder="Entrer votre quantite" min="0">
                        <small v-if="errors.quantite" class="text-danger text-xs">{{ errors.quantite }}</small>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <li class="btn btn-primary" @click="addproduct">Ajouter un produit</li>
                    <button type="submit" class="btn btn-success">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</template>