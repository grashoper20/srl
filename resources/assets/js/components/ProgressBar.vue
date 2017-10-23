<script>
    export default {
        functional: true,
        render: function (createElement, context) {
            let progress = context.props.progress * 100;
            return createElement('div', {
                    'class': [
                        'progress',
                    ],
                },
                [
                    createElement('div', {
                        'class': [
                            'progress-bar',
                            'progress-' + Math.max((Math.floor(progress / 20) * 20), 20),
                        ],
                        attrs: {
                            role: 'progressbar',
                            'aria-valuenow': progress,
                            'aria-valuemin': 0,
                            'aria-valuemax': 100,
                        },
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
    .progress {
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
