<script>
export default {
    props: {
        auth: Object,
    },
    methods: {
        user() {
            return auth;
        }
    }
}
</script>

<script setup>
function display(x) {
    document.getElementById(x).classList.toggle('hiddenbar')
    document.getElementById(x).classList.toggle('visiblebar')
}
</script>

<template>
    <main>
        <nav>
            <a class="logo" href="/">GS</a>
            <button class="navbar-toggler" type="button" @click="display('navigation-bar')">
                <span class="toggler-icons">BB</span>
            </button>
            <div class="navigation-bar hiddenbar" id="navigation-bar">
                <span style="--i:1"><a href="/">Stock</a></span>
                <span style="--i:2"><a href="/commandes">Commandes</a></span>
                <span style="--i:3" v-if="user()" class="deconnecteur"><a href="/deconnection">Deconnecter</a></span>
                <span style="--i:3" v-else class="deconnecteur"><a href="/login">Connecter</a></span>
            </div>
        </nav>
        <div class="bg-container"></div>

        <article>
            <slot />
        </article>
    </main>
</template>