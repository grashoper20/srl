import axios from 'axios';

export default {
    getShows() {
        return axios.get('/api/show');
    },
    getShow(id) {
        return axios.get('/api/show/' + id);
    },
    getEpisodes(id) {
        return axios.get('/api/show/' + id + '/episodes');
    },
}