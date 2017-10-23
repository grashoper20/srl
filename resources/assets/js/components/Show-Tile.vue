<template>
    <div class="show-tile card">
        <router-link :to="{name: 'show', params: {id: show.indexer_id}}">
            <img class="card-img-top" :src="getPosterThumbnail(show.indexer_id)" :alt="show.show_name"/>
        </router-link>
        <progress-bar :progress="show.progress"></progress-bar>
        <div class="card-body">
            <h4 class="card-title">{{show.show_name}}</h4>
            <div class="show--date">{{airDate}}</div>
            <div class="show--details">
                <div class="show--count">{{completed}}</div>
                <div class="show--network">{{networkImage}}</div>
                <div class="show--quality">
                    <span v-if="show.quality.length === 1">{{show.quality[0].quality}}</span>
                    <span v-else>Custom</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FileCache from '../mixins/FileCache';
    import ProgressBar from './ProgressBar.vue';
    import QualityPills from './QualityPills.vue';

    export default {
        components: {
            'quality-pills': QualityPills,
            'progress-bar': ProgressBar,
        },
        computed: {
            completed() {
                return this.show.stats === undefined
                    ? '0/0'
                    : this.show.stats.downloaded + '/' + this.show.stats.total;
            },
            progress() {
                return 100 * this.show.progress;
            },
            progressClass() {
                return 'progress-' + Math.max((Math.floor(this.progress / 20) * 20), 20);
            },
            networkImage() {
                // TODO Figure out how to do this in a legit way.
                return this.show.network;
            },
            airDate() {
                // TODO calculate actual air date and fallback on status.
                return this.show.status;
            },
        },
        mixins: [FileCache,],
        props: [
            'show'
        ],
    }
</script>

<style lang="scss">
    @import "~material-shadows/material-shadows";

    // use wrapper because "show" conflicts with bootstrap.
    .show-tile {
        width: 188px;
        margin: 4px;
        background-color: #F3F3F3;

        overflow: hidden;

        @include z-depth-2dp();

        .progress {
            height: 7px;
            border: 0 solid #999;
            border-bottom-width: 1px;
            border-radius: 0;
        }
        .card-body {
            padding: 8px;
        }
        .card-title {
            font-size: .8rem;
            margin: 0;
        }
    }

    .show--date {
        white-space: nowrap;
        font-size: .75rem;
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

</style>
