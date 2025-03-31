<script setup>
import axios from "axios";
import { useRoute, useRouter} from "vue-router";
import { ref } from "vue";

const route = useRoute();
const router = useRouter();

const poke = ref([]);

const back = () =>{
    router.push('/pokemons')
};

const getData = async () =>{
    try{
        const {data} = await axios.get(`https://pokeapi.co/api/v2/pokemon/${route.params.name}`);
        console.log(data);
        poke.value = data;
    }catch(error){
        console.log(error)
        poke.value=null;
    }
};
getData();
</script>

<template>
    <div v-if="poke">
        <img :src="poke.sprites?.front_default" alt="pokemon">
        <h1>Poke name: {{ $route.params.name }}</h1>
    </div>
    <h1 v-else>Pokemon no encontrado</h1>
    <button class="btn btn-outline-primary" @click="back">Volver</button>
</template>