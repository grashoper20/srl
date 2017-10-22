import Utility from './Utility';

export default {
    methods: {
        getFileCacheUrl: (type, id, subtype) => {
            return Utility.methods.url('/filecache/' + type + '/' + id + '/' + subtype);
        },
        getFileCacheImageUrl: function (id, type) {
            if (typeof id === 'undefined') {
                return '';
            }
            return this.getFileCacheUrl('images', id, type);
        },
        getFanArt(id) {
            return this.getFileCacheImageUrl(id, 'fanart');
        },
        getPoster(id) {
            return this.getFileCacheImageUrl(id, 'poster');
        },
        getPosterThumbnail(id) {
            return this.getFileCacheImageUrl(id, 'poster/thumbnail');
        },
        getBanner(id) {
            return this.getFileCacheImageUrl(id, 'banner');
        },
        getBannerThumbnail(id) {
            return this.getFileCacheImageUrl(id, 'banner/thumbnail');
        },
    }
}
