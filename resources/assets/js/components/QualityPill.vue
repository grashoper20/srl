<template>
    <span :class="qualityClass + ' quality--pill'">{{quality.quality}}</span>
</template>

<script type="javascript">
    export default {
        computed: {
            qualityClass() {
                // TODO fix combined status pill styling.
                switch (this.quality.id) {
                    case 1:
                    case 2:
                        return 'quality--sd';
                    case 4:
                    case 32:
                    case 128:
                        return 'quality--hd720';
                    case 8:
                        return 'quality--rawhd';
                    case 16:
                    case 64:
                    case 256:
                        return 'quality--hd1080';
                    case 512:
                    case 1024:
                    case 2048:
                        return 'quality--uhd4k';
                    case 4096:
                    case 8192:
                    case 16384:
                        return 'quality--uhd8k';

                    case 32768:
                    default:
                        console.log(this.quality.id);
                        return 'quality--unknown';
                }
            },
        },
        props: [
            'quality',
        ],
    };
</script>

<style lang="scss">
    @import "../../sass/helper";
    @import "~material-shadows/material-shadows";

    .quality--pill {
        display: inline-block;
        padding: 0 6px;

        border: 1px solid #888;
        border-radius: 4px;
        color: white;

        font-family: $font-family-sans-serif-small;
        font-size: 12px !important;
        vertical-align: baseline;
        white-space: nowrap;
        text-shadow: 0 1px rgba(0, 0, 0, 0.8);

        @include z-depth-2dp();
    }

    .quality--sd {
        background-color: #AB1A1A;
    }

    .quality--rawhd {
        background-color: #CD7300;
    }

    .quality--hd720 {
        background-color: #5B990D;
    }

    .quality--hd1080 {
        background-color: #2672B6;
    }

    .quality--uhd4k {
        background-color: #7500FF;
    }

    .quality--uhd8k {
        background-color: #410077;
    }

    .quality--unknown {
        background-color: #999999;
    }
</style>
