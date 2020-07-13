<template>
    <div id="app">
        <div class="container">
     <Navbar/>
        <router-view></router-view>
    </div>
    </div>
</template>

<script>
import Navbar from '@/components/partials/NavBar.vue';

export default {
    name: 'App',

    components: {
        Navbar,
    },
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
