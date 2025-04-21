<template>
    <div>
        <h1 class="text-2xl font-bold mb-4 text-center">
            Posts list
        </h1>

        <o-button label="Create" variant="info" @click="$router.push({name: 'save'})" icon-left="plus" />

        <o-table :loading="isloading" :data="posts.data.length === 0 ? [] : posts.data">
            <o-table-column field="id" label="ID" numeric v-slot="p">
                {{ p.row.id }}
            </o-table-column>
            <o-table-column field="title" label="Title" v-slot="p">
                {{ p.row.title }}
            </o-table-column>
            <o-table-column field="posted" label="Posted" v-slot="p">
                {{ p.row.posted }}
            </o-table-column>
            <o-table-column field="created_at" label="Created" v-slot="p">
                {{ p.row.created_at }}
            </o-table-column>
            <o-table-column field="category" label="Category" v-slot="p">
                {{ p.row.category.title }}
            </o-table-column>
            <o-table-column field="slug" label="Acciones" v-slot="p">
                <router-link class="mr-3" :to="{name: 'save', params:{'slug':p.row.slug}}">Editar</router-link>
                <o-button rounded size="small" variant="danger" @click="confirmDelete(p.row)">Eliminar</o-button>
            </o-table-column>
        </o-table>
        <br>
        <o-pagination
            v-if="posts.data.length > 0"
            v-model:current="currentPage"
            :total="posts.total"
            :per-page="posts.per_page"
            :range-before="2"
            :range-after="2"
            :order="'centered'"
            :size="'small'"
            :simple="false"
            :rounded="true"
            @change="updatePage"
        />

        <o-modal v-model:active="isModalVisible" title="Confirmación">
            <div>
                <p>¿Estás seguro de que deseas eliminar este post?</p>
                <div class="flex justify-end mt-4">
                    <o-button label="Cancelar" @click="isModalVisible = false" variant="info" class="mr-2" />
                    <o-button label="Eliminar" @click="deletePost(selectedPost)" variant="danger" />
                </div>
            </div>
        </o-modal>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const posts = ref({
    current_page: 1,
    data: [],
    total: 0,
    per_page: 10
});
const isloading = ref(true);
const currentPage = ref(1);
const isModalVisible = ref(false);
const selectedPost = ref(null); 

async function listPage(page) {
    isloading.value = true;
    try {
        const res = await axios.get(`/api/post?page=${page}`);
        posts.value = res.data;
    } catch (error) {
        console.error("Error fetching posts:", error);
    } finally {
        isloading.value = false;
    }
}

function updatePage(page) {
    listPage(page);
}

function confirmDelete(post) {
    selectedPost.value = post; 
    isModalVisible.value = true; 
}

async function deletePost(post) {
    try {
        const res = await axios.delete("/api/post/" + post.id);
        console.log(res);
        isModalVisible.value = false; 
        await listPage(currentPage.value); 
    } catch (error) {
        console.error("Error deleting post:", error);
    }
}

onMounted(() => {
    listPage(currentPage.value);
});
</script>