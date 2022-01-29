<template>
    <div>
        <h4 class="text-center">Add Person</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addPerson">
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
                        <input type="text" class="form-control" v-model="person.sa_id" placeholder="1234567890123">
                    </div><br>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="person.email">
                    </div><br>

                    <label>Birthdate</label>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" class="form-control" v-model="person.birthyear" placeholder="1980">
                    </div>
                    <div class="form-group">
                        <label>Month</label>
                        <input type="text" class="form-control" v-model="person.birthmonth" placeholder="6">
                    </div>
                    <div class="form-group">
                        <label>Day</label>
                        <input type="text" class="form-control" v-model="person.birthday" placeholder="25">
                    </div><br>
<!--                    <button class="btn btn-primary">New Language</button>-->
                    <language-radio @radio-language="selectLanguageStatus"></language-radio>
<!--                    <button class="btn btn-primary">New Interest</button>-->
                    <interests-checkbox @interest-checkbox="selectInterestStatus" :checkboxes-active="person.interests"></interests-checkbox>

                    <button type="submit" class="btn btn-primary">Add Person</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import LanguageRadio from "../../components/LanguageRadio";
import InterestsCheckbox from "../../components/InterestsCheckbox";

export default {
    components: {InterestsCheckbox, LanguageRadio},
    data() {
        return {
            person: {},
        }
    },
    created() {
        this.person.interests = [];
    },
    methods: {
        addPerson() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/people/add', this.person)
                    .then(response => {
                        this.$router.push({name: 'people'})
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
