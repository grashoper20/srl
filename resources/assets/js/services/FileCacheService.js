import UrlService from './UrlService';

export default {
    getFileCacheUrl: (type, id, subtype) => {
        return UrlService.url('/filecache/' + type + '/' + id + '/' + subtype);
    },
    getFileCachePosterUrl: function(show, type) {
        if (typeof show.indexer_id === 'undefined') {
            return '';
        }
        return this.getFileCacheUrl('poster',show.indexer_id, type);
    },
}
