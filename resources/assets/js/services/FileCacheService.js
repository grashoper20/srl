import UrlService from './UrlService';

export default {
    getFileCacheUrl: (type, id, subtype) => {
        return UrlService.url('/filecache/' + type + '/' + id + '/' + subtype);
    },
    getFileCachePosterUrl: function (id, type) {
        if (typeof id === 'undefined') {
            return '';
        }
        return this.getFileCacheUrl('poster', id, type);
    },
}
