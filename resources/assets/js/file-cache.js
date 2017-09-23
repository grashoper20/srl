import axios from 'axios';

let cache = {
    network: [],
    poster: []
};

export default {
    getNetwork(id) {
        if (!cache.network[id]) {
            console.log('Fetching network image for ' + id);
            // axios.get('');
            cache.network[id] = 'NI';
        }
        return cache.network[id];
    },
    getPoster(id, type, thumbnail = false) {
        if (!cache.poster[id]) {
            cache.poster[id] = {};
        }
        key = type;
        if (thumbnail) {
            key = key + ':thumbnail';
        }
        if (!cache.poster[id].hasOwnProperty(key)) {
            cache.poster[id][key] = ''
        }
        return cache.poster[id][key];
    }
}
