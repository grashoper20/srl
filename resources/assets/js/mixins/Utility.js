export default {
    methods: {
        url: (path) => {
            if (window.srl.settings.baseURL) {
                return window.srl.settings.baseURL + path;
            }
            return path;
        },
        getSort: (ascending, isNumber, resolveValue) => {
            return function (a, b) {
                function stringify(x) {
                    return (x === undefined || x === null)
                        ? ''
                        : resolveValue(x).toString()
                }
                // Stringify.
                let stringA = stringify(a),
                    stringB = stringify(b);
                // Compare.
                let comparison = stringA.localeCompare(stringB, {}, {numeric: isNumber});
                // Apply direction.
                return (ascending ? comparison : comparison * -1);
            };
        },
    },
}
