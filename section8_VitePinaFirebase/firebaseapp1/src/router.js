import {createRouter, createWebHistory} from 'vue-router';
import Home from './views/Home.vue';
import Login from './views/login.vue';
import Register from './views/Register.vue';
import { useUserStore } from './stores/user';

const requireAuth = async (to, from, next) => {
    const userStore = useUserStore();
    userStore.loaddigSession = true;
    const user = await userStore.currentUser();
    console.log(user + 'usuario');
    if(user){
        next();
    }else{
        next('/login');
    }
    userStore.loaddigSession = false;
}

const routes = [
    {path: '/', component: Home, beforeEnter: requireAuth},
    {path: '/login', component: Login},
    {path: '/register', component: Register}
]

const router = createRouter({
    routes,
    history: createWebHistory()
})

export default router;