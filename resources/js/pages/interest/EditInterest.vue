<template>
    <div>
        <h4 class="text-center">Edit Interest</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateInterest">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="interest.name">
                    </div><br>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="interest.description">
                    </div><br>

                    <button type="submit" class="btn btn-primary">Update Interest</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            interest: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/interest/edit/${this.$route.params.id}`)
                .then(response => {
                    this.interest = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateInterest() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/interest/update/${this.$route.params.id}`, this.interest)
                    .then(response => {
                        this.$router.push({name: 'interest'});
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
