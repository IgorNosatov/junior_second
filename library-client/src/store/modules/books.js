import axios from 'axios';
import { API_BASE_URL } from '../../config'

const state = {
    books: [],
    book: {}
}

const mutations = {
    FETCH_BOOKS(state, books) {
        state.books = [...state.books, ...books];
    },
    UPDATE_BOOK(state, book) {
        const bookIndex = state.books.findIndex((t) => t.id === book.id)
        Object.assign(state.books[bookIndex], book)
    },
    DELETE_BOOK(state, bookId) {
        let books = state.books.filter((v => v.id != bookId))
        state.books = books;
    }
}

const actions = {
    async addBook(context, book) {
        let data = new FormData();
        data.append('title', book.title);
        data.append('author', book.author);
        data.append('description', book.description);
        data.append('image', book.image);
        data.append('genre', book.genre);

        axios.post(API_BASE_URL + '/store', data)
            .then((res) => {
                console.log(res);
            })
            .catch((error) => {
                console.log(error);
            });

    },
    async updateBoook({ commit }, book) {
        return new Promise((resolve, reject) => {
            axios.post(API_BASE_URL + `/update/${book.id}`, { book })
                .then((response) => {
                    commit('UPDATE_BOOK', response.data)
                    resolve(response)
                })
                .catch((error) => { reject(error) })
        })
    },
    async fetchBooks(store) {
        await axios.get(API_BASE_URL)
            .then(({ data: books }) => {
                store.commit('FETCH_BOOKS', books);
            })
            .catch(err => { console.log(err) })
    },
    async deleteBook({ commit }, book) {
        await axios.delete(API_BASE_URL + `/delete/${book.id}`)
        commit('DELETE_BOOK', book.id)
    }
}

const getters = {
    books(state) {
        return state.books;
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}