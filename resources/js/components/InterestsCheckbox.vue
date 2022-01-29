<template>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Interest in:</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="interest in interests" :key="interests.name">
                <td><input type="checkbox" :id="interest.id" :value="interest.id"  v-model="checkboxesActive"></td>
                <td>{{ interest.name }}</td>
                <td>{{ interest.description }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "InterestsCheckbox",
    emits: ['interest-checkbox'],
    props: {'checkboxesActive':{required: false,},},
    data() {
        return {
            interests: [],
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
    watch:{
        checkboxesActive: function(checkboxesActive){
            this.$emit('interest-checkbox', checkboxesActive);
        }
    },
}
</script>
