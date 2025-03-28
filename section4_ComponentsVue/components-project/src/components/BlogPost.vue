<script setup>
defineProps({
    title: String,
    id: Number,
    body: {
        type: String,
        default: "Sin descripcion",
    }
});

const emit = defineEmits(['cambiarFavoritoEvent'])
</script>

<template>
    <div class="card mt-2">
        <div class="card-body">
            <h5 class="card-title"> {{ id }} - {{ title }} </h5>
            <p>{{ body }}</p>
            <button 
                @click="emit('cambiarFavoritoEvent', title)"   
                class="btn btn-outline-primary">
                Favorito
            </button>
        </div>
    </div>
</template>