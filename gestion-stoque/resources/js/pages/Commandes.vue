
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
    router.post('/commandes.sorted', form2)
}

function submit() {
    router.post('/commandes', form)
}

function redirect(id){
    router.get('/commande/'+id+'/show')
}
</script>

<template>
    <div class="row d-flex m-5">
        <div class="col-md-7 card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Liste des commandes</div>
                <form @submit.prevent="submit2" class="d-flex justify-content-between align-items-center">
                    <select class="form-control\" id="fournisseur" v-model="form2.date">
                        <option v-for="date in dates">{{ date['order_date'] }}</option>
                    </select>
                    <button type="submit" class="btn btn-primary py-0 mx-2">Envoyer</button>
                </form>
            </div>
            <div class="card-body px-2">
                <blockquote class="blockquote mb-0">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="card-header">
                                <th scope="col">Client</th>
                                <th scope="col">Date</th>
                                <th scope="col">Totaux</th>
                            </tr>
                        </thead>
                        <tbody v-for="commande in commandes ">
                            <tr class="card-header">
                                <td scope="col" @click="redirect(commande.id)" style="cursor: pointer;">{{ commande.customer_name }}</td>
                                <td scope="col" @click="redirect(commande.id)" style="cursor: pointer;">{{ commande.order_date }}</td>
                                <td scope="col" @click="redirect(commande.id)" style="cursor: pointer;">{{ commande.total_amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </blockquote>
            </div>
        </div>

        <div class="col-md-4 card mx-2">
            <div class="card-header">
                Gestion des sortie
            </div>
            <div class="card-body container">
                <div v-if="error" class="alert alert-danger d-flex justify-content-between">
                    {{ error }}
                    <a href="/" class="btn btn-dark bg-transparent text-dark py-0 d-flex align-items-center ">Consulter</a>
                </div>
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label for="client">Client</label>
                        <input type="text" class="form-control mt-2" id="client" v-model="form.client" name="client"
                            placeholder="Nom et prenom">
                        <small v-if="errors.client" class="text-danger text-xs">{{ errors.client }}</small>
                    </div>
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
                            <input type="number" class="form-control mt-2" id="quantite" v-model="article.quantite"
                                name="quantite" aria-describedby="quantiteHelp" placeholder="Entrer votre quantite" min="0">
                            <small v-if="errors.quantite" class="text-danger text-xs">{{ errors.quantite }}</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="date">Date</label>
                        <input type="date" class="form-control mt-2" id="date" v-model="form.date" name="date" min="2023-10-01">
                        <small v-if="errors.date" class="text-danger text-xs">{{ errors.date }}</small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <li class="btn btn-primary" @click="addproduct">Ajouter un produit</li>
                        <button type="submit" class="btn btn-success">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>