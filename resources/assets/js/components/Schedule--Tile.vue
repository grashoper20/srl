<template>
    <div class="schedule-tile--details" @click="showDescription = !showDescription">
        <div v-if="poster" class="schedule-tile--poster col-auto">
            <router-link :to="{name: 'show', params: {id: episode.showid}}">
                <img :src="getPoster(episode.showid)"/>
            </router-link>
        </div>
        <div class="col">
            <router-link :to="{name: 'show', params: {id: episode.showid}}">
                <img class="schedule-tile--banner" v-if="banner" :src="getBanner(episode.showid)"/>
            </router-link>
            <div class="schedule-tile--info">
                <h3>{{episode.show.show_name}}</h3>
                <div class="schedule-tile--episode">Episode: {{episode | formatSeasonEpisode}} - {{episode.name}}
                </div>
                <div class="schedule-tile--airs">
                    Airs: {{episode.airdate | formatAirDate}} on {{episode.show.network}}
                </div>
                <transition name="fade">
                    <div class="schedule-tile--description" v-if="showDescription">{{episode.description}}</div>
                </transition>
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
                showDescription: false,
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

    .schedule-tile--details {
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

    .schedule-tile--info {
        padding: 1rem;
    }

    .schedule-tile--banner {
        width: 100%;
    }

    .schedule-tile--poster {
        padding: 0;
        img {
            width: 200px;
        }
    }

    .schedule-tile--description {
        margin: 1rem -1rem 0;
        padding: 1rem 1rem 0;
        border-top: 1px solid $border-dark-grey;
    }

</style>
