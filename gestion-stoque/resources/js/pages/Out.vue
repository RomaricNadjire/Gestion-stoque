
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
        product: null,
        quantite: null,
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
    <div class="card col-5 offset-4 mt-5">
        <div class="card-header">
            Gestion des sortie
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
                    <label for="product">Product</label>
                    <select class="form-control mt-2" id="product" v-model="form.product">
                        <option>Default select</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantite">Quantite</label>
                    <input type="number" class="form-control mt-2" id="quantite" v-model="form.quantite"
                        aria-describedby="quantiteHelp" placeholder="Entrer votre quantite">
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</template>