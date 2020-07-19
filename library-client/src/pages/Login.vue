<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="email" class="col-md-12 text-left">Email</label>
                                <div class="col-md-12">
                                    <input id="email"
                                           type="email" 
                                           class="form-control" 
                                           name="email" 
                                           v-model="email" 
                                           required autocomplete="email" 
                                           autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-12 text-left">Password</label>
                                <div class="col-md-12">
                                    <input id="password" 
                                           type="password" 
                                           class="form-control" 
                                           name="password" 
                                           v-model="password" 
                                           required autocomplete="current-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 float-left">
                                    <button 
                                           type="submit" 
                                           class="btn btn-primary  w-100" 
                                           @click="handleSubmit">
                                               Login
                                    </button>
                                    <br>
                                    <br>
                                    <h6> Or you can register</h6>
                                    <router-link to="/register" class="btn btn-info m-1 w-100">Register</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { API_BASE_AUTH__URL } from '../config';

export default {
    data() {
        return {
            email: "",
            password: ""
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                let email = this.email
                let password = this.password

                axios.post(API_BASE_AUTH__URL + '/login', { email, password }).then(response => {
                    let user = response.data.user
                    let is_admin = user.is_admin

                    localStorage.setItem('authKey.user', JSON.stringify(user))
                    localStorage.setItem('authKey.jwt', response.data.token)

                    if (localStorage.getItem('authKey.jwt') != null) {
                        this.$emit('loggedIn')
                        if (this.$route.params.nextUrl != null) {
                            this.$router.push(this.$route.params.nextUrl)
                        } else {
                            this.$router.push((is_admin == 1 ? '/' : '/'))
                        }
                    }
                });
            }
        }
    }
}
</script>