<template>
    <div :class="getClass" @click="showDescription = !showDescription">
        <router-link :to="{name: 'show', params: {id: episode.showid}}">
            <img class="episode-tile--poster card-img-top" v-if="poster" :src="getPosterThumbnail(episode.showid)"
                 :alt="episode.show.show_name"/>
            <img class="episode-tile--banner card-img-top" v-if="banner" :src="getBannerThumbnail(episode.showid)"
                 :alt="episode.show.show_name"/>
        </router-link>
        <div :class="poster ? 'card-img-overlay' : 'card-body'">
            <h3 class="card-title">
                <router-link :to="{name: 'show', params: {id: episode.showid}}">
                    {{episode.name}}
                </router-link>
            </h3>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <strong>Episode:</strong> {{episode | formatSeasonEpisode}}
            </li>
            <li class="list-group-item">
                <strong>Airs:</strong> {{episode.airdate | formatAirDate}}
            </li>
            <li class="list-group-item">
                <strong>Network:</strong> {{episode.show.network}}
            </li>
        </ul>
    </div>
</template>

<script>
    import FileCache from '../mixins/FileCache';
    import Filters from '../filters';

    export default {
        computed: {
            getClass() {
                let classes = 'episode-tile card';
                if (this.banner) {
                    classes += ' episode-tile--banner';
                }
                if (this.poster) {
                    classes += ' episode-tile--poster';
                }
                return classes;
            },
        },
        data() {
            return {
                showDescription: false,
            };
        },
        filters: Filters,
        mixins: [FileCache,],
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
    @import "~material-shadows/material-shadows";

    .episode-tile {
        background: $background-off-white;
        margin: 15px;
        overflow: hidden;
        @include z-depth-2dp();

        h3 {
            font-size: 1.1rem;
            margin-bottom: 0;
            a {
                color: black;
            }
        }
        .card-img-overlay {
            background: linear-gradient(rgba(0, 0, 0, 1), rgba(0, 0, 0, .5) 15%, transparent 25%);
        }
        .list-group {
            font-size: .9rem;
        }
    }

    .episode-tile--poster {
        width: 200px;
        h3 {
            &, a {
                color: #eee;
            }
        }
    }

    .episode-tile--banner {
        width: 270px;
    }

    .episode-tile--description {
        margin: 1rem -1.25rem 0;
        padding: 1rem 1.25rem 0;
        border-top: 1px solid $border-dark-grey;
    }

</style>
