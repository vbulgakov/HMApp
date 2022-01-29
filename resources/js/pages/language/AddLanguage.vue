<template>
    <div>
        <h4 className="text-center">Add Language</h4>
        <div className="row">
            <div className="col-md-6">
                <form @submit.prevent="addLanguage">
                    <div className="form-group">
                        <label>Name</label>
                        <input type="text" className="form-control" v-model="language.name">
                    </div>
                    <br>

                    <button type="submit" className="btn btn-primary">Add Language</button>
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
    methods: {
        addLanguage() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/language/add', this.language)
                    .then(response => {
                        this.$router.push({name: 'language'})
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
