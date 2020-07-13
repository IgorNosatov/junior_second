<template>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div v-for="book in books" :key="book.id" class="card mb-3" style="max-width: 1000px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img :src="'http://localhost:8000/uploads/'+book.image" alt="image" class="card-img" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">Book Name: {{ book.title }}</h3>
                                <h5>Book Author: {{ book.author }}</h5>
                                <p class="card-text">Book Genre: {{ book.genre }}</p>
                                <p class="card-text text-left">{{ book.description }}</p>
                                <div class="d-flex justify-content-start">
                                    <button type="button" class="btn btn-danger m-1" @click="deleteBook(book)">
                                            Delete
                                    </button>
                                    <a class="btn btn-warning m-1" href="">Edit book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
 
<script>
import { mapGetters } from 'vuex';


export default {
    mounted() {
        this.$store.dispatch('fetchBooks');
    },
    computed: {
        ...mapGetters({
            books: 'books',
        })
    },
    methods: {
        deleteBook(book) {
            this.$store.dispatch('deleteBook', book);
        }
    }
}
</script>