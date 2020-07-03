<template>
    <main class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div v-for="book in books"  v-bind:key="book.id" class="card mb-3" style="max-width: 1000px;">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                       <img :src="'http://localhost:8000/uploads/'+book.image" alt="image" class="w-100"/>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h3 class="card-title">Book Name: {{ book.title }}</h3>
                                            <h5>Book Author:{{ book.author }}</h5>
                                            <p class="card-text">Book Genre:{{ book.genre }}</p>
                                            <p class="card-text">{{ book.description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'

export default {
    data() {
        return {
            books: {},
            isLoading: true,
        }
    },
    async created () {
            const response = await axios.get(API_BASE_URL + '/library')
            this.books = response.data.data
            this.isLoading = false
    },
}
</script>