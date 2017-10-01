import UrlService from './UrlService';

export default {
    getFileCacheUrl: (type, id, subtype) => {
        return UrlService.url('/filecache/' + type + '/' + id + '/' + subtype);
    },
    getFileCacheImageUrl: function (id, type) {
        if (typeof id === 'undefined') {
            return '';
        }
        return this.getFileCacheUrl('images', id, type);
    },
}
