import axios from 'axios';

export default {
    getShow(id) {
        return axios.get('/api/imdb/' + id);

    }
}