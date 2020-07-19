<template>
    <div id="app">
        <div class="container">
            <Navbar/>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Navbar from '@/components/NavBar.vue';

export default {
    name: 'App',

    components: {
        Navbar,
    },
    data() {
        return {
            name: null,
            user_type: 0,
            isLoggedIn: localStorage.getItem('bigStore.jwt') != null
        }
    },
    mounted() {
        this.setDefaults()
    },
    methods: {
        setDefaults() {
            if (this.isLoggedIn) {
                let user = JSON.parse(localStorage.getItem('bigStore.user'))
                this.name = user.name
                this.user_type = user.is_admin
            }
        },
        change() {
            this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
            this.setDefaults()
        },
        logout() {
            localStorage.removeItem('bigStore.jwt')
            localStorage.removeItem('bigStore.user')
            this.change()
            this.$router.push('/')
        }
    }
}
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 10px;
}
</style>
