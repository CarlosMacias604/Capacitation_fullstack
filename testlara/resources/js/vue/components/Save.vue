<template>
    <h1 class="text-2xl font-bold mb-4 text-center">Post</h1>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <o-field label="Title" :variant="errors.title ? 'danger' : 'primary'" :message="errors.title">
                <o-input expanded v-model="form.title"></o-input>
            </o-field>
            <o-field label="Slug" :variant="errors.slug ? 'danger' : 'primary'" :message="errors.slug">
                <o-input expanded v-model="form.slug"></o-input>
            </o-field>
            <o-field label="Description" :variant="errors.description ? 'danger' : 'primary'"
                :message="errors.description">
                <o-input expanded v-model="form.description" type="textarea"></o-input>
            </o-field>
            <o-field label="Content" :variant="errors.content ? 'danger' : 'primary'" :message="errors.content">
                <o-input expanded v-model="form.content" type="textarea"></o-input>
            </o-field>
            <o-field label="Category" :variant="errors.category_id ? 'danger' : 'primary'"
                :message="errors.category_id">
                <o-select v-model="form.category_id" placeholder="Select Category">
                    <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.title }}</option>
                </o-select>
            </o-field>
            <o-field label="Posted" :variant="errors.posted ? 'danger' : 'primary'" :message="errors.posted">
                <o-select v-model="form.posted" placeholder="Select a status">
                    <option value="yes">Yes</option>
                    <option value="not">Not</option>
                </o-select>
            </o-field>

            <div class="flex-col gap-3" v-if="post">
                <img :src="`/uploads/posts/${post.image}`" style="width: 250px; height: 250px;" :alt="post.title">
                <o-field class="mt-3">
                    <o-upload v-model="file">
                        <o-button tag="a" variant="primary">
                            <o-icon icon="upload"></o-icon>
                            <span>Cilck to update</span>
                        </o-button>
                    </o-upload>
                </o-field>
                <p v-if="file != null"><b>Selected:</b> {{ file?.name }}</p>

                <o-button @click="upload" icon-left="upload" variant="primary">
                    Update
                </o-button>
            </div>
        </div>



        <br><br>

        <o-button variant="primary" type="submit">Submit Form</o-button>
    </form>

    <!-- Notificación -->
    <o-notification v-if="notification.message" :variant="notification.type" closable
        aria-close-label="Close notification">
        {{ notification.message }}
    </o-notification>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

const route = useRoute();
const router = useRouter();

const categories = ref([]);
const file = ref(null);

const form = ref({
    title: "",
    slug: "",
    description: "",
    content: "",
    category_id: "",
    posted: "",
});
const errors = ref({
    title: "",
    slug: "",
    description: "",
    content: "",
    category_id: "",
    posted: "",
});
const post = ref("");
const notification = ref({ message: "", type: "" }); // Estado para la notificación

const cleanErrorsForm = () => {
    errors.value = {
        title: "",
        slug: "",
        description: "",
        content: "",
        category_id: "",
        posted: "",
    };
};

const submit = async () => {
    cleanErrorsForm();

    try {
        if (!post.value) {
            const res = await axios.post("/api/post", form.value);
            console.log(res);
        } else {
            const res = await axios.patch(`/api/post/${post.value.id}`, form.value);
            console.log(res);
        }
        notification.value = { message: "Post saved successfully!", type: "success" };
        setTimeout(() => router.push({ name: "list" }), 2000);
    } catch (error) {
        const responseErrors = error.response.data;
        if (responseErrors.title) errors.value.title = responseErrors.title[0];
        if (responseErrors.slug) errors.value.slug = responseErrors.slug[0];
        if (responseErrors.description) errors.value.description = responseErrors.description[0];
        if (responseErrors.content) errors.value.content = responseErrors.content[0];
        if (responseErrors.category_id) errors.value.category_id = responseErrors.category_id[0];
        if (responseErrors.posted) errors.value.posted = responseErrors.posted[0];

        notification.value = { message: "Failed to save post. Please check the form.", type: "danger" };
    }
};

const getCategories = async () => {
    try {
        const res = await axios.get("/api/category");
        categories.value = res.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

const getPost = async () => {
    try {
        const res = await axios.get(`/api/post/slug/${route.params.slug}`);
        post.value = res.data;
    } catch (error) {
        console.error("Error fetching post:", error);
    }
};

const initPost = () => {
    form.value.title = post.value.title;
    form.value.slug = route.params.slug;
    form.value.description = post.value.description;
    form.value.content = post.value.content;
    form.value.category_id = post.value.category_id;
    form.value.posted = post.value.posted;
};

const upload = async () => {
    const formData = new FormData();
    formData.append("image", file.value);

    try {
        const res = await axios.post("/api/post/upload/" + post.value.id, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        notification.value = { message: "Image saved successfully!", type: "success" };
    } catch (error) {
        notification.value = { message: error.response.data.message, type: "danger" };
    }
}

onMounted(async () => {
    if (route.params.slug) {
        await getPost();
        initPost();
    }
    await getCategories();
});
</script>