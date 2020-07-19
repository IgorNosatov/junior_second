<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm mb-5">
        <div class="container">
            <router-link to="/" class="navbar-brand"> Laravel +Vue
            </router-link>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link to="/" class="btn btn-info m-1">BOOKS</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/create" class="btn btn-info m-1">CREATE BOOKS</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 10px;
}
</style>