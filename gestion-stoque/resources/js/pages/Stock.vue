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
})

defineProps({
    errors: Object,
    products: Object,
    categories: Object
})

function submit() {
    router.post('/', form)
}
</script>

<template>
    <div class="card w-80 br-10">
        <div class="card-header">
            <div>Liste des produit</div>
            <form @submit.prevent="submit" class="d-flex w-40">
                <select class="form-control" id="fournisseur" v-model="form.categorie">
                    <option v-for="categorie in categories">{{ categorie['categorie'] }}</option>
                </select>
                <button type="submit" class="btn form-bottom-button w-20 ml-1">Trier</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table w-90">
                <thead class="h-40">
                    <tr class="bg-primary">
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prix(CFA)</th>
                        <th scope="col">Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products">
                        <td>{{ product.name }}</td>
                        <td>{{ product.description }}</td>
                        <td> {{ product.price }}</td>
                        <td>{{ product.quantity }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-transparent">
            <a href="/add" class="btn form-bottom-button ml-10">Entrée</a>
            <a href="/out" class="btn form-bottom-button ml-10">Sortie</a>
            <a href="/history" class="btn form-bottom-button ml-10">Histotique</a>
        </div>
    </div>
</template>