<template>
    <div class="show">
        <div class="show--image">
            <router-link :to="{name: 'show', params: {id: show.show_id}}">
                <img v-bind:src="poster"/>
            </router-link>
        </div>
        <div class="show--progress">
            <div class="show--progress_bar" v-bind:class="[progressClass]" v-bind:style="{width: progress +'%'}"></div>
        </div>
        <h4 class="show--title">{{show.show_name}}</h4>
        <div class="show--date">{{airDate}}</div>
        <div class="show--details">
            <div class="show--count">1/1</div>
            <div class="show--network">{{networkImage}}</div>
            <div class="show--quality">{{show.quality}}</div>
        </div>
    </div>
</template>

<script>

    import {random} from "lodash";

    export default {
        data: () => ({
            progress: random(0, 100),
        }),
        props: [
            'show'
        ],
        mounted() {
            console.log('show');
        },
        computed: {
            progressClass: function () {
                return 'progress-' + Math.max((Math.floor(this.progress / 20) * 20), 20);
            },
            networkImage: function () {
                // TODO Figure out how to do this in a legit way.
                return this.show.network;
            },
            poster: function () {
                return '/filecache/poster/' + this.show.indexer_id + '/poster/thumbnail';
            },
            airDate: function () {
                // TODO calculate actual air date and fallback on status.
                return this.show.status;
            }
        }
    }
</script>

<style lang="scss">
    //
    .show {
        width: 188px;
        margin: 4px;
        background-color: #F3F3F3;
        border: 6px solid #F3F3F3;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 1px 1px 3px 0 rgba(0, 0, 0, 0.31);
    }

    .show--image img {
        overflow: hidden;
        max-width: 100%;
    }

    .show--title {
        white-space: nowrap;
        font-size: .8rem;
        margin: 6px 4px 0;
    }

    .show--date {
        white-space: nowrap;
        font-size: .75rem;
        margin: 0 4px 4px;
        color: #949494;
    }

    .show--details {
        height: 32px;
        overflow: hidden;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .show--count, .show--network, .show--quality {
        font-size: .7rem;
        vertical-align: middle;
        width: 33%;
    }

    .show--network {
        text-align: center;
    }

    .show--quality {
        text-align: right;
    }

    .show--progress {
        height: 7px;
        border: 1px solid #111111;
        border-right-width: 0;
        border-left-width: 0;
        overflow: hidden;
        .show--progress_bar {
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
