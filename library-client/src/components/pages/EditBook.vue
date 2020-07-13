<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" @submit.prevent="submitForm">
                        <div class="form-group text-left">
                            <label for="title text-left">Book Title:</label>
                            <input v-model="book.title" name="title" type="text" class="form-control" placeholder="Enter book author ....." required />
                        </div>
                        <div class="form-group text-left">
                            <label for="author">Book Author:</label>
                            <input v-model="book.author" name="author" type="text" class="form-control" placeholder="Enter book author ....." required />
                        </div>
                        <div class="form-group text-left">
                            <label for="description">Book description</label>
                            <textarea v-model="book.description" name="description" class="form-control" id="description" rows="8" placeholder="Enter book description ....." required></textarea>
                        </div>
                        <div class="form-group text-left">
                            <label for="image">Book image</label>
                            <input @change="onFileChange" name="image" type="file" id="image" class="form-control" placeholder="Put book image ....." required />
                        </div>
                        <div class="form-group text-left">
                            <label for="genre">Book genre</label>
                            <input v-model="book.genre" name="genre" type="text" class="form-control" placeholder="Enter book genre ....." required />
                        </div>
                        <button class="btn btn-primary">
                                                             Create Book
                                                </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {

    data() {
        return {
            book: {
                title: null,
                author: null,
                description: null,
                image: null,
                genre: null
            }
        }
    },
    methods: {
        onFileChange(event) {
            this.book.image = event.target.files[0];
            console.log(event.target.files[0]);
        },
        submitForm() {
            let formData = new FormData();

            formData.append("title", this.book.title);
            formData.append("author", this.book.title);
            formData.append("description", this.book.description);
            formData.append("image", this.book.image);
            formData.append("genre", this.book.description);

            axios.post('http://localhost:8000/api/books/store', formData)
                .then((res) => {
                    console.log(res);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
}
</script>