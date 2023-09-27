
<script>
import Layout from '../layout/header.vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

export default {
    // Using a render function...
    layout: (h, page) => h(Layout, [page]),

    // Using shorthand syntax...
    layout: Layout,

    props: {
        data: Object, // Supposons que vous passez un objet de données à ce composant
    },

    methods: {
        formatDate(date) {
        return new Date(date).toLocaleString(); // Vous pouvez utiliser différentes méthodes de formatage ici
        },
    },
}
</script>
<script setup>
import { useForm } from '@inertiajs/vue3';
const form = useForm({
    client: null,
    articles: [{ name: null, quantite: null }],
    date: Date
})

const form2 = useForm({
    date: Date
})

defineProps({
    error: String,
    message: String,
    commandes: Object,
    products: Object,
    dates: Object,
    details: Object,
    errors: Object,
})

function addproduct() {
    form.articles.push({ name: null, quantite: null })
    return "Veillez choisir le produit numero " + form.articles.length
}

function submit2() {
    router.get('/commandes.sorted', form2)
}

function submit() {
    router.post('/commandes', form)
}

function redirect(id){
    router.get('/commande/'+id+'/show')
}
</script>

<template>
    <div class="row w-80">
        <div class="card col-md-7 br-10">
            <div class="card-header">
                <div>Liste des commandes</div>
                <form @submit.prevent="submit2" class="d-flex w-40">
                    <select class="form-control" id="fournisseur" v-model="form2.date">
                        <option v-for="date in dates">{{ date['order_date'] }}</option>
                    </select>
                    <button type="submit" class="btn form-bottom-button w-20 ml-1">Trier</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table w-90">
                    <thead class="h-40">
                        <tr class="bg-primary">
                            <th scope="col">Client</th>
                            <th scope="col">Date</th>
                            <th scope="col">Totaux</th>
                        </tr>
                    </thead>
                    <tbody v-for="commande in commandes ">
                        <tr>
                            <td scope="col" @click="redirect(commande.id)" style="cursor: pointer;">{{ commande.customer_name }}</td>
                            <td scope="col" @click="redirect(commande.id)" style="cursor: pointer;">{{ formatDate(commande.order_date) }}</td>
                            <td scope="col" @click="redirect(commande.id)" style="cursor: pointer;">{{ commande.total_amount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-3 card">
            <div class="card-header">
                Gestion des commandes
            </div>
            <div class="card-body container">
                <div v-if="error" class="d-flex br-1 alert alert-danger d-flex justify-content-between">
                    {{ error }}
                    <a href="/" class="btn btn-dark bg-transparent text-dark py-0 d-flex align-items-center ">Consulter</a>
                </div>
                <form @submit.prevent="submit">
                    <div class="mb-3 input-container">
                        <input type="text" class="form-control mt-2" id="client" v-model="form.client" name="client">
                        <label for="client">Client</label>
                        <small v-if="errors.client" class="text-danger text-xs">{{ errors.client }}</small>
                    </div>
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
                    <div class="mb-3 input-container">
                        <input type="date" class="form-control mt-2" id="date" v-model="form.date" name="date" min="2023-10-01">
                        <label for="date">Date</label>
                        <small v-if="errors.date" class="text-danger text-xs">{{ errors.date }}</small>
                    </div>
                    <div class="mb-3 form-bottom-2">
                        <li class="btn form-bottom-button-2" @click="addproduct">Ajouter un produit</li>
                        <button type="submit" class="btn form-bottom-button">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>