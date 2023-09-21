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

    function submit(){
        router.post('/', form)
    }
</script>

<template>
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Liste des produit</div>
            <form @submit.prevent="submit" class="d-flex justify-content-between align-items-center">
                <select class="form-control\" id="fournisseur" v-model="form.categorie">
                    <option v-for="categorie in categories">{{ categorie['categorie'] }}</option>
                </select>
                <button type="submit" class="btn btn-primary py-0 mx-2">Envoyer</button>
            </form>
        </div>
        <div class="card-body px-2">
            <blockquote class="blockquote mb-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Prix(CFA)</th>
                            <th scope="col">Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products">
                            <td>{{ product.name }}</td>
                            <td class="w-50">{{ product.description }}</td>
                            <td> {{ product.price }}</td>
                            <td>{{ product.quantity }}</td>
                        </tr>                        
                    </tbody>
                </table>
            </blockquote>
        </div>
        <div class="card-footer">
            <a href="/add" class="btn btn-outline-primary mx-2">Entrée</a>
            <a href="/out" class="btn btn-outline-success mx-3">Sortie</a>
            <a href="/history" class="btn btn-outline-info mx-2">Histotique</a>
        </div>
    </div>
</template>