<script>
    export default {
        functional: true,
        render: function (createElement, context) {
            let progress = context.props.progress * 100;
            return createElement('div', {
                    'class': [
                        'progress_bar',
                    ],
                },
                [
                    createElement('div', {
                        'class': [
                            'progress',
                            'progress-' + Math.max((Math.floor(progress / 20) * 20), 20),
                        ],
                        style: {
                            width: progress + '%',
                        },
                    }),
                ],
            );
        },
        props: {
            progress: Number,
        }
    }
</script>

<style lang="scss">
    .progress_bar {
        transition: width .5s;
        height: 7px;
        border: 1px solid #111111;
        border-right-width: 0;
        border-left-width: 0;
        overflow: hidden;
        .progress {
            height: 100%;
        }
        .progress-100 {
            background-image: linear-gradient(#A6CF41, #5B990D);
        }
        .progress-80 {
            background-image: linear-gradient(#E1FF97, #9DB269);
        }
        .progress-60 {
            background-image: linear-gradient(#FAD440, #F2A70D);
        }
        .progress-40 {
            background-image: linear-gradient(#FAB543, #F2700D);
        }
        .progress-20 {
            background-image: linear-gradient(#DA5945, #B11A10);
        }
    }
</style>
