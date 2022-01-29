<template>
    <div>
        <h4 class="text-center">People</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Birthdate</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="person in people" :key="people.name">
                <td>{{ person.name }}</td>
                <td>{{ person.surname }}</td>
                <td>{{ person.email }}</td>
                <td>{{ person.birthdate }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editperson', params: { id: person.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deletePerson(person.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
export default {
    data() {
        return {
            people: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/people')
                .then(response => {
                    this.people = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deletePerson(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/people/delete/${id}`)
                    .then(response => {
                        let i = this.people.map(item => item.id).indexOf(id); // find index of your object
                        this.people.splice(i, 1)
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
