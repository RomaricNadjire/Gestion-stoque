<script>
import Layout from '../layout/header.vue';
// import { useForm } from '@inertiajs/vue3';
// import { router } from '@inertiajs/vue3';

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
        fournisseur: null,
    })

    defineProps({
        error: String,
        message: String,
        errors: Object
    })

    function submit(){
        router.post('loger', form)
    }
</script>

<template>
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>Liste des produit</div>
            <form @submit.prevent="submit" class="d-flex justify-content-between align-items-center">
                <select class="form-control\" id="fournisseur" v-model="form.fournisseur">
                    <option>Default select</option>
                </select>
                <button type="submit" class="btn btn-primary py-0 mx-2">Envoyer</button>
            </form>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Lorem</th>
                            <td class="w-50">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, nostrum?</td>
                            <td> 155</td>
                            <td>45</td>
                        </tr>
                        <tr>
                            <th scope="row">Lorem</th>
                            <td class="w-50">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, nostrum?</td>
                            <td>155</td>
                            <td>90</td>
                        </tr>
                        <tr>
                            <th scope="row">Lorem</th>
                            <td class="w-50">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, nostrum?</td>
                            <td>155</td>
                            <td>56</td>
                        </tr>
                    </tbody>
                </table>
            </blockquote>
            <div class="mt-2 d-flex justify-content-around align-items-center">
                <a href="add" class="btn btn-outline-primary">Entrée</a>
                <a href="out" class="btn btn-outline-success">Sortie</a>
                <a href="#" class="btn btn-outline-info">Histotique</a>
            </div>
        </div>
    </div>
</template>