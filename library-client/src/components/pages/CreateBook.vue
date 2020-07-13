<template>
    <div class='row justify-content-center'>
        <div class='col-md-8'>
            <div class='card'>
                <div class='card-body'>
                    <form enctype='multipart/form-data' @submit.prevent='addBook'>
                        <div class='form-group text-left'>
                            <label for='title text-left'>Book Title:</label>
                            <input v-model='title' name='title' type='text' class='form-control' placeholder='Enter book author .....' required />
                        </div>
                        <div class='form-group text-left'>
                            <label for='author'>Book Author:</label>
                            <input v-model='author' name='author' type='text' class='form-control' placeholder='Enter book author .....' required />
                        </div>
                        <div class='form-group text-left'>
                            <label for='description'>Book description</label>
                            <textarea v-model='description' name='description' class='form-control' id='description' rows='8' placeholder='Enter book description .....' required></textarea>
                        </div>
                        <div class='form-group text-left'>
                            <label for='image'>Book image</label>
                            <input @change='onFileChange' name='image' type='file' id='image' class='form-control' placeholder='Put book image .....' required />
                        </div>
                        <div class='form-group text-left'>
                            <label for='genre'>Book genre</label>
                            <input v-model='genre' name='genre' type='text' class='form-control' placeholder='Enter book genre .....' required />
                        </div>
                        <button class='btn btn-primary' >
                                                                     Create Book
                                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    data() {
        return {
                title: '',
                author: '',
                description: '',
                image: '',
                genre: ''
        }
    },
    methods: {
        onFileChange(event) {
            this.image = event.target.files[0];
        },
        addBook() {
            this.$store.dispatch('addBook', {
                title: this.title,
                author: this.author,
                description: this.description,
                image: this.image,
                genre: this.genre,
            })
        }
    },
}
</script>