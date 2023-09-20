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
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Historique des entrée/sortie</div>
            <form @submit.prevent="submit" class="d-flex justify-content-between align-items-center">
                <select class="form-control\" v-model="form.product">
                    <option v-for="product in products">{{ product['name'] }}</option>
                </select>
                <button type="submit" class="btn btn-primary py-0 mx-2">Envoyer</button>
            </form>
        </div>
        <div class="card-body px-2">
            <blockquote class="blockquote mb-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
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
                            <td>{{ movement.created_at }}</td>
                        </tr>                        
                    </tbody>
                </table>
            </blockquote>
        </div>
    </div>
</template>