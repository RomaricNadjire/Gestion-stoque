<script>
import Layout from '../layout/header.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

export default {
    // Using a render function...
    layout: (h, page) => h(Layout, [page]),

    // Using shorthand syntax...
    layout: Layout,

    methods: {
        formatDate(date) {
        return new Date(date).toLocaleString(); // Vous pouvez utiliser différentes méthodes de formatage ici
        },
    },
}
</script>
<script setup>
    const form = useForm({
        product: null,
    })

    defineProps({
        errors: Object,
        products: Object,
        movements: Object
    })

    function submit(){
        router.post('history', form)
    }
</script>

<template>
    <div class="card w-80 br-10">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Historique des entrée/sortie</div>
            <form @submit.prevent="submit" class="d-flex w-40">
                <select class="form-control" v-model="form.product">
                    <option v-for="product in products">{{ product['name'] }}</option>
                </select>
                <button type="submit" class="btn form-bottom-button w-20 ml-1">Trier</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table w-90">
                <thead class="bg-primary h-40">
                    <tr class="bg-primary">
                        <th scope="col">Article</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Movement</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="movement in movements">
                        <td>{{ movement.product }}</td>
                        <td class="w-50">{{ movement.quantity }}</td>
                        <td> {{ movement.movement_type }}</td>
                        <td>{{ formatDate(movement.created_at, 'dd/MM/yyyy') }}</td>
                    </tr>                        
                </tbody>
            </table>
        </div>
    </div>
</template>