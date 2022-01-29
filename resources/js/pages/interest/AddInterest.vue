<template>
    <div>
        <h4 className="text-center">Add Interest</h4>
        <div className="row">
            <div className="col-md-6">
                <form @submit.prevent="addInterest">
                    <div className="form-group">
                        <label>Name</label>
                        <input type="text" className="form-control" v-model="interest.name">
                    </div>
                    <br>
                    <div className="form-group">
                        <label>Name</label>
                        <input type="text" className="form-control" v-model="interest.description">
                    </div>
                    <br>

                    <button type="submit" className="btn btn-primary">Add Interest</button>
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
    methods: {
        addInterest() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/interest/add', this.interest)
                    .then(response => {
                        this.$router.push({name: 'interest'})
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
