<template>
    <div>
        <h4 class="text-center">Languages</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="language in languages" :key="languages.name">
                <td>{{ language.name }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editlanguage', params: { id: language.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteLanguage(language.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/language/create')">Add Language</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            languages: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/language')
                .then(response => {
                    this.languages = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteLanguage(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/language/delete/${id}`)
                    .then(response => {
                        let i = this.languages.map(item => item.id).indexOf(id); // find index of your object
                        this.languages.splice(i, 1)
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
