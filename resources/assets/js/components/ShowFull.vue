<template>
    <div class="show-full">
        <div class="container">
            <header class="show-full--head">
                <h1>{{show.show_name}}</h1>
                <div class="show-full--seasons">Seasons: <a
                        v-for="season in orderedEpisodeList" :href="'#season-' + season[0].season">{{seasonName(season)}}</a>
                </div>
            </header>
            <div class="row">
                <div class="col d-lg-block d-none col-3">
                    <img v-on:click="showModal" class="show-full--poster-thumb" :src="posterThumbnail"/>
                    <modal name="full-poster" :height="'100%'">
                        <div class="show-full--poster" :style="{backgroundImage: 'url(' + poster + ')'}">
                            <button @click="$modal.hide('full-poster')">❌</button>
                        </div>
                    </modal>
                </div>
                <div class="d-lg-none">
                    <img class="show-full--banner" :src="banner"/>
                </div>
                <div class="show-full--info col">
                    <header class="show-full--info-header row">
                        <div>
                            <div>
                                {{imdb_info.rating}} {{imdb_info.countries}} ({{imdb_info.year}}) - {{imdb_info.runtimes}} minutes
                            </div>
                            <div class="show-full--genres">
                                <div class="show-full--genre" v-for="genre in genres">{{genre}}</div>
                            </div>
                        </div>
                        <img class="show-full--banner-thumb d-none d-lg-block" :src="bannerThumbnail"/>
                    </header>
                    <show-details v-bind:show="show"></show-details>
                </div>
            </div>
            <div class="show-full--episode-list">
                <h4>Episode list</h4>
                <episode-list v-bind:seasons="orderedEpisodeList"></episode-list>
            </div>
        </div>
        <div class="show-full--backdrop" :style="{backgroundImage: 'url(' + getBackgroundImage + ')'}"></div>
    </div>
</template>

<script>
    import axios from 'axios'
    import FileCacheService from '../services/FileCacheService';
    import EpisodeList from './ShowEpisodeList.vue';
    import ShowFullDetails from './ShowFull-Details.vue';
    import {mapGetters} from 'vuex';

    export default {
        components: {
            'episode-list': EpisodeList,
            'show-details': ShowFullDetails,
        },
        data: () => ({
            id: 0,
            imdb_info: {},
            episodes: [],
            errors: [],
        }),
        created() {
            this.id = parseInt(this.$route.params.id);
            axios.get('/api/show/' + this.id + '/episodes')
                .then(response => {
                    this.episodes = response.data;
                })
                .catch(e => {
                    this.errors.push(e)
                });
            axios.get('/api/imdb/' + this.id)
                .then(response => {
                    this.imdb_info = response.data;
                })
                .catch(e => {
                    this.errors.push(e)
                });
            this.$store.dispatch('shows/find', this.id);
        },
        computed: {
            ...mapGetters('shows', [
                'getShowById'
            ]),
            getBackgroundImage: function () {
                return FileCacheService.getFileCacheImageUrl(this.id, 'fanart');
            },
            poster: function () {
                return FileCacheService.getFileCacheImageUrl(this.id, 'poster');
            },
            posterThumbnail: function () {
                return FileCacheService.getFileCacheImageUrl(this.id, 'poster/thumbnail');
            },
            banner: function () {
                return FileCacheService.getFileCacheImageUrl(this.id, 'banner');
            },
            bannerThumbnail: function () {
                return FileCacheService.getFileCacheImageUrl(this.id, 'banner/thumbnail');
            },
            genres: function () {
                if (typeof this.imdb_info.genres === 'undefined') {
                    return [];
                }
                return this.imdb_info.genres.split('|');
            },
            show() {
                return this.getShowById(this.id);
            },
            orderedEpisodeList: function () {
                let episodes = [];
                this.episodes.forEach(function (episode) {
                    if (!(episode.season in episodes)) {
                        episodes[episode.season] = [];
                    }
                    episodes[episode.season].push(episode);
                });
                if (!episodes || !episodes.length) {
                    return [];
                }
                return episodes.slice().reverse().filter(ep => typeof ep !== 'undefined');
            },
        },
        methods: {
            seasonName(season) {
                return season[0].season || 'Specials';
            },
            showModal() {
                this.$modal.show('full-poster');
            },
        }
    }
</script>
<style lang="scss">
    .show-full {
        .v--modal-overlay {
            background-color: rgba(0, 0, 0, .75);
        }
    }

    .show-full--poster-thumb {
        width: 100%;
    }

    .show-full--poster {
        background: black no-repeat center center;
        background-size: contain;
        height: 100%;
        button {
            opacity: .5;
            transition: opacity 0.5s;
            position: absolute;
            right: 0;
        }
        &:hover button {
            opacity: 1;
        }
    }

    .show-full--banner-thumb {
        max-height: 50px;
        border: 1px solid black;
    }

    .show-full--banner {
        width: 100%;
        border: 1px solid black;
    }

    .show-full--genre {
        display: inline-block;
        border-radius: 3px;
        background: #555;
        border: 1px solid #111;
        color: white;
        padding: 0 .25em;
        margin: 0 .25em;
    }

    .show-full--head {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #888;
        padding-bottom: .5rem;
        margin-bottom: 1rem;
        h1 {
            margin: 0;
        }
    }

    .show-full--seasons {
        align-self: flex-end;
        a {
            color: #337ab7;
            padding: 0 .5rem;
            border-right: 1px solid black;
        }
        a:last-child {
            border: none;
        }
    }

    .show-full--info {
        .show-full--info-header {
            display: flex;
            justify-content: space-between;
            padding-bottom: 5px;
        }
    }

    .show-full--episode-list {
        margin: .5rem 0;
    }

    .show-full--backdrop {
        position: fixed;
        top: 0;
        z-index: -9999;
        height: 100vh;
        width: 100%;
        opacity: 0.4;
        background: no-repeat center center fixed;
        background-size: cover;
    }
</style>
