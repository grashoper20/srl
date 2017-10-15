<template>
    <div class="schedule-card--details">
        <div v-if="poster" class="schedule-card--poster col-auto">
            <router-link :to="{name: 'show', params: {id: episode.showid}}">
                <img :src="getPoster(episode.showid)"/>
            </router-link>
        </div>
        <div class="col">
            <router-link :to="{name: 'show', params: {id: episode.showid}}">
                <img class="schedule-card--banner" v-if="banner" :src="getBanner(episode.showid)"/>
            </router-link>
            <div class="schedule-card--info">
                <h3>{{episode.show.show_name}}</h3>
                <div class="schedule-card--episode">Episode: {{episode | formatSeasonEpisode}} - {{episode.name}}
                </div>
                <div class="schedule-card--airs">
                    Airs: {{episode.airdate | formatAirDate}} on {{episode.show.network}}
                </div>
                <div v-if="show">{{episode.description}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    import StatusMixin from '../mixins/Status';
    import FileCache from '../mixins/FileCache';
    import Filters from '../filters';

    export default {
        data() {
            return {
                show: false,
            };
        },
        filters: Filters,
        mixins: [StatusMixin, FileCache,],
        props: {
            episode: Object,
            banner: {
                type: Boolean,
                default: false,
            },
            poster: {
                type: Boolean,
                default: false,
            },
        },
    };
</script>

<style lang="scss">
    // Variables
    @import "../../sass/variables";

    .schedule-card--details {
        background: $background-off-white;
        border: 1px solid $border-dark-grey;
        border-radius: 5px;
        display: flex;
        width: 100%;

        & > div {
            padding: 0;
        }
        h3 {
            font-size: 1.25rem;
        }
    }

    .schedule-card--info {
        padding: 1rem;
    }
    .schedule-card--banner {
        width: 100%;
    }

    .schedule-card--poster {
        padding: 0;
        img {
            width: 200px;
        }
    }
</style>
