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
    commande: Object,
    details: Object,
    categories: Object
})

function submit() {
    router.post('/', form)
}
</script>

<template>
    <div class="card w-80">
        <div class="card-header">
            <div>{{ commande.customer_name }}</div>
            <div>{{ commande.order_date }}</div>
        </div>
        <div class="card-body">
            <table class="table w-90">
                <thead class="h-40">
                    <tr class="bg-primary">
                        <th scope="col">Produit</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Prix unitaire</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody v-for="detail in details ">
                    <tr>
                        <td scope="col">{{ detail.product }}</td>
                        <td scope="col">{{ detail.quantity }}</td>
                        <td scope="col">{{ detail.unit_price }}</td>
                        <td scope="col">{{ detail.quantity*detail.unit_price }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
</div></template>