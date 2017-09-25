export default {
    url: (path) => {
        if (window.srl.settings.baseURL) {
            return window.srl.settings.baseURL + path;
        }
        return path;
    },
}
