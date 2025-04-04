<template>
    <div>
        <h1>Login</h1>
        <form @submit.prevent="handleLogin">
            <input type="email" placeholder="Ingrese email" v-model.trim="email">
            <input type="password" placeholder="Ingrese contraseña" v-model.trim="password">
            <button type="submit" :disabled="userStore.loadingUser">Login</button>
        </form>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useUserStore } from '../stores/user';
    //import {useRouter} from 'vue-router'

    const userStore = useUserStore();
    //const router = useRouter();
    const email = ref('');
    const password = ref('');

    const handleLogin = async () => {
        if(!email.value || !password.value){
            return alert("llena los campos");
        }
        await userStore.loginUser(email.value, password.value);
        //router.push('/')
    }
</script>