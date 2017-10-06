import axios from 'axios';

export default {
    getEpisodes() {
        return axios.get('api/schedule');
    }
}