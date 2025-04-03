<script setup>
import { useFavoritosStore } from '@/store/favoritos';
import { storeToRefs } from 'pinia';
import { RouterLink } from 'vue-router';

const useFavoritos = useFavoritosStore();
const {favoritos} = storeToRefs(useFavoritos);
const {remove} = useFavoritos
</script>

<template>
    <h1>Favoritos</h1>
    <p v-if="favoritos.length === 0">Sin favoritos</p>
    <ul class="list-group">
        <li v-for="poke in favoritos" class="list-group-item" :key="poke.id">
            <div>
                {{ poke.name }}
            </div>
            <div>
                <button @click="remove(poke.id)" class="btn btn-danger mb-2">Eliminar</button>            
            </div>
            <div>
                <RouterLink :to="`/pokemons/${poke.name}`">
                    <button class="btn btn-outline-primary">Informacion</button>   
                </RouterLink>         
            </div>
        </li>
    </ul>
</template>