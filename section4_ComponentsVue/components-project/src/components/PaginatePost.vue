<script setup>
    defineProps(['inicio','fin','maxLength'])
    const emit = defineEmits(['nextPage', 'previousPage'])
</script>

<template>
    <div class="btn-group" role="group" aria-label="Basic example">
        <button @click="emit('previousPage')" type="button" class="btn btn-primary" :disabled="inicio <= 0" >Previous</button>
        <button @click="emit('nextPage')" type="button" class="btn btn-primary" :disabled="fin >= maxLength">Next</button>
    </div>
</template>