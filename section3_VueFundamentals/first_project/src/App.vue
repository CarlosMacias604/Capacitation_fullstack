<script setup>
import { ref, computed } from 'vue';
const title = "Vue 3";
const stylecolor = "color: blue";
const activo = true;

const counter = ref(0);
const arrayFavoritos = ref([]);

const objetoFruta = {
  name: "Manzana",
  price: "$1.00",
  description: "Una manzana",
};

const arrayFrutas = [
    {
        name: "Manzana",
        price: "$1.00",
        description: "Una manzana",
        stock: 0,
    },
    {
        name: "Pera",
        price: "$2.00",
        description: "Una pera",
        stock: 10,
    },
    {
        name: "Naranja",
        price: "$3.00",
        description: "Una naranja",
        stock: 20,
    },
];

const handleClick = (message = 'Parametros no enviados') => {
  alert(message);
};

const actionBtn = (action) => {
  if (action === 'aumentar'){
    counter.value++;
  } else if (action === 'disminuir') {
    counter.value--;
  } else {
    counter.value = 0;
  }
};

const guardar = () => arrayFavoritos.value.push(counter.value);
const bloquearBtn = computed(() => {
  const searchNum = arrayFavoritos.value.find((item) => item === counter.value);
  if(searchNum === 0) return true;
  return searchNum ? true : false;
});

</script>

<template>
  <div class="container text-center mt-5">
    <h1>Hola {{ title.toUpperCase() }}</h1>
  <!--
  <h2 v-if="activo === true">estoy activo</h2>
  <p v-else-if="activo === false">estoy Inactivo </p>
  <p v-else> Indeciso </p>
  <p v-show="activo">Estoy activo v-show</p>

  <ul>
    <template v-for="item in arrayFrutas" :key="item.name">
      <li v-if="item.stock > 0">
        {{ item.name }} - {{ item.price }}
      </li>
    </template>
  </ul>

  <button @click="handleClick('Hola desde el boton 1')">Activame</button>
  <button @click="handleClick('Hola desde el boton 2')">Activame 2</button>
  <button @click="handleClick()">Activame 3</button> -->

  <h2 v-if="counter < 0" style="color: red;">{{ counter }}</h2>
  <h2 v-else-if="counter > 0" style="color: green;">{{ counter }}</h2>
  <h2 v-else style="color: peru">{{ counter }}</h2>
  <div class="btn-group">
    <button @click="actionBtn('aumentar')" class="btn btn-success">Aumentar</button>
    <button @click="actionBtn('disminuir')" class="btn btn-danger">Disminuir</button>
    <button @click="actionBtn()" class="btn btn-secondary">Reset</button>
    <button @click="guardar()" :disabled="bloquearBtn" class="btn btn-primary">Add</button>
  </div>
  <ul class="list-group mt-4">
    <li class="list-group-item" v-for="(item, index) in arrayFavoritos" :key="index">
      {{ item }}
    </li>
  </ul>
  </div>
</template>

<style>
h1 {
  color: red;
}
</style>