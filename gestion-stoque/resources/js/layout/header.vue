<script>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <main>        
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand btn btn-outline-dark text-primary"  href="/">GS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="commandes">Commandes</a>
                    </li>
                </ul>
            </div>
        </nav>
        <article>
            <slot />
        </article>
    </main>
</template>