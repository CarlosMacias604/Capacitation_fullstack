<template>
    <div>
        <h1>Register</h1>
        <form @submit.prevent="handleRegister">
            <input type="email" placeholder="Ingrese email" v-model.trim="email">
            <input type="password" placeholder="Ingrese contraseña" v-model.trim="password">
            <button type="submit" :disabled="userStore.loadingUser">Register</button>
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

    const handleRegister = async () => {
        if(!email.value || password.value.length < 5){
            return alert("llena los campos");
        }
        await userStore.registerUser(email.value, password.value);
        //router.push('/')
    }
</script>