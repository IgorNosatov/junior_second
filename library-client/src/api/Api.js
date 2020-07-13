import axios from 'axios';

class Api {
    constructor(apiUrl) {
        this.axios = axios.create({ baseURL: apiUrl });
    }

    get(url, params) {
        return this.axios.get(url, { params });
    }

}

export default new Api(process.env.VUE_APP_API_URL);