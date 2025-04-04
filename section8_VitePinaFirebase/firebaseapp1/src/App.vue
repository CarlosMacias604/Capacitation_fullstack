<template>
  <nav v-if="!userStore.loaddigSession">
    <RouterLink to="/" v-if="userStore.userData">Home</RouterLink>
    <RouterLink to="/login" v-if="!userStore.userData">Login</RouterLink>
    <RouterLink to="/register" v-if="!userStore.userData">Register</RouterLink>
    <button @click="userStore.logoutUser()" v-if="userStore.userData">Logout</button>
  </nav>
  <div v-else>
    loading user...
  </div>
  <router-view></router-view>
</template>

<script setup>
  import { useUserStore } from './stores/user';
  const userStore = useUserStore();
</script>