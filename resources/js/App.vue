<template>
    <div class="container">
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">

                <div class="navbar-nav" v-if="isLoggedIn">
                    <router-link to="/people/create" class="nav-item nav-link">Add People</router-link>
                    <router-link to="/people" class="nav-item nav-link">People</router-link>
                    <router-link to="/language" class="nav-item nav-link">Languages</router-link>
                    <router-link to="/interest" class="nav-item nav-link">Interests</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
                </div>

                <div class="navbar-nav" v-else>
                    <router-link to="/login" class="nav-item nav-link">login</router-link>
                </div>

            </div>
        </nav>
        <br/>
        <router-view/>
    </div>
</template>

<script>
export default {
        name: "App",
        data() {
            return {
                isLoggedIn: false,
            }
        },
        created() {
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
            }
        },
        methods: {
            logout(e) {
                console.log('ss')
                e.preventDefault()
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('/api/logout')
                        .then(response => {
                            if (response.data.success) {
                                window.location.href = "/"
                            } else {
                                console.log(response)
                            }
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
                })
            }
        },
}
</script>
