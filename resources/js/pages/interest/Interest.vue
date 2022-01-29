<template>
    <div>
        <h4 class="text-center">Interests</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="interest in interests" :key="interests.name">
                <td>{{ interest.name }}</td>
                <td>{{ interest.description }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editinterest', params: { id: interest.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteInterest(interest.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/interest/create')">Add Interest</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            interests: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/interest')
                .then(response => {
                    this.interests = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteInterest(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/interest/delete/${id}`)
                    .then(response => {
                        let i = this.interests.map(item => item.id).indexOf(id); // find index of your object
                        this.interests.splice(i, 1)
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
