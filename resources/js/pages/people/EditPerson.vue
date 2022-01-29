<template>
    <div>
        <h4 class="text-center">Edit Person</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updatePerson">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="person.name">
                    </div><br>
                    <div class="form-group">
                        <label>Surname</label>
                        <input type="text" class="form-control" v-model="person.surname">
                    </div><br>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" v-model="person.mobile_number">
                    </div><br>
                    <div class="form-group">
                        <label>SAID</label>
                        <input type="text" class="form-control" v-model="person.sa_id">
                    </div><br>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="person.email">
                    </div><br>

                    <div class="form-group">
                        <label>Birthdate</label>
                        <input type="text" class="form-control" v-model="person.birthdate">
                    </div><br>

                    <language-radio @radio-language="selectLanguageStatus" :language-active="person.language"></language-radio>

                    <interests-checkbox @interest-checkbox="selectInterestStatus" :checkboxes-active="person.interests"></interests-checkbox>

                    <button type="submit" class="btn btn-primary">Update Person</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import InterestsCheckbox from "../../components/InterestsCheckbox";
import LanguageRadio from "../../components/LanguageRadio";

export default {
    components: {InterestsCheckbox, LanguageRadio},
    data() {
        return {
            person: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/people/edit/${this.$route.params.id}`)
                .then(response => {
                    this.person = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updatePerson() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/people/update/${this.$route.params.id}`, this.person)
                    .then(response => {
                        this.$router.push({name: 'people'});
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        selectLanguageStatus(languageId){
            this.person.language=languageId;
        },
        selectInterestStatus(interestsArray){
            this.person.interests=interestsArray;
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
