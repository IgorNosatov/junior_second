<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form @submit="formSubmit" enctype="multipart/form-data">
                            <strong>Title:</strong>
                            <input type="text" class="form-control" v-model="title">
                            <strong>Author:</strong>
                            <input type="text" class="form-control" v-model="author">
                            <strong>Description:</strong>
                            <input type="text" class="form-control" v-model="description">
                            <strong>Image:</strong>
                            <input type="file" class="form-control" v-on:change="onImageChange">
                            <strong>Genre:</strong>
                            <input type="text" class="form-control" v-model="genre">
                            <button class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
import axios from 'axios';
import { API_BASE_URL } from '../config';

export default {
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            title: '',
            author: '',
            description: '',
            image: '',
            genre: '',
            success: ''
        };
    },
    methods: {
        onImageChange(e) {
            console.log(e.target.files[0]);
            this.image = e.target.files[0];
        },
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;

            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('author', this.author);
            formData.append('description', this.description);
            formData.append('image', this.image);
            formData.append('genre', this.genre);

            axios.post(API_BASE_URL + '/store', formData, config)
                .then(function(response) {
                    currentObj.success = response.data.success;
                })
                .catch(function(error) {
                    currentObj.output = error;
                });
        }
    }
}
</script>