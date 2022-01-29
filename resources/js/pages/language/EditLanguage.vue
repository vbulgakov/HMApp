<template>
    <div>
        <h4 class="text-center">Edit Language</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateLanguage">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="language.name">
                    </div><br>

                    <button type="submit" class="btn btn-primary">Update Language</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            language: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/language/edit/${this.$route.params.id}`)
                .then(response => {
                    this.language = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateLanguage() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/language/update/${this.$route.params.id}`, this.language)
                    .then(response => {
                        this.$router.push({name: 'language'});
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
