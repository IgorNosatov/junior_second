<template>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div v-for="(book, index) in books" :book="book" :key="book.id" class="card mb-3" style="max-width: 1000px;">
    
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img :src="'http://localhost:8000/uploads/'+book.image" alt="image" class="card-img" />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">
                                Book Name: {{ book.title }}
                            </h3>
                            <h5>Book Author: {{ book.author }}</h5>
                            <p class="card-text">
                                Book Genre: {{ book.genre }}
                            </p>
                            <p class="card-text text-left">
                                {{ book.description }}
                            </p>
                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn btn-danger m-1" @click="deleteEntry(book.id, index)">
                                    Delete
                                </a>
                                <router-link :to="{name: 'editBook', params: { id: book.id }}" class="btn btn-warning m-1">Edit</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <pagination :meta_data="meta_data" v-on:next="fetchBooks">
            </pagination>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Pagination from '../components/Pagination';
import { API_BASE_URL } from '../config'
import {mapActions} from 'vuex';

export default {

    components: {
        Pagination
    },

    data() {
        return {
            books: [],
            meta_data: {
                last_page: null,
                current_page: 12,
                prev_page_url: null
            }
        };
    },
    mounted() {
        this.FETCH_BOOKS();
    },
    computed:{
     ...mapActions(['FETCH_BOOKS']),
    },
    methods: {

        fetchBooks(page = 1) {
            axios.get(API_BASE_URL, {
                params: {
                    page
                }
            }).then((res) => {
                this.books = res.data.data;
                this.meta_data.last_page = res.data.last_page;
                this.meta_data.current_page = res.data.current_page;
                this.meta_data.prev_page_url = res.data.prev_page_url;
            });
        },
        deleteEntry(id, index) {
            if (confirm("Do you really want to delete book?")) {
                var app = this;
                axios.delete(API_BASE_URL + '/delete/' + id)
                    .then(function() {
                        app.books.splice(index, 1);
                    })
                    .catch(function() {
                        alert("Could not delete company");
                    });
            }
        }
    }

};
</script>
