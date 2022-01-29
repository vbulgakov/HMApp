<template>
    <div class="LanguageRadio form-group">
        <label>Language:</label><br>
        <template v-for="language in languages" :key="language.id">
            <input type="radio" name="language" :value="language.id" :id="language.id" v-model="languageActive"> <label :for="language.id">{{ language.name }}</label><br>
        </template>
    </div><br>
</template>

<script>

export default {
    name: "LanguageRadio",
    emits: ['radio-language'],
    props: {'languageActive':{required: false,},},
    data() {
        return {
            languages: [],
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
    watch:{
        languageActive: function(id){
            this.$emit('radio-language', id);
        }
    },
}
</script>
