<script>
    import FileCache from '../mixins/FileCache';

    export default {
        functional: true,
        render: function (createElement, context) {
            let props = context.props;
            return createElement(
                'img', {
                    attrs: {
                        src: props.thumbnail ?
                            FileCache.methods.getPosterThumbnail(props.id) :
                            FileCache.methods.getPoster(props.id),
                        alt: props.alt,
                    },
                },
                context.children
            );
        },
        props: {
            id: Number,
            thumbnail: {
                type: Boolean,
                default: false,
            },
            alt: {
                type: String,
                default: '',
            },
        }
    }
</script>
