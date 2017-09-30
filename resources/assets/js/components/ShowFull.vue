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
                <div class="col">
                    <img class="show-full--poster" style="width:100%" :src="posterThumbnail"/>
                </div>
                <div class="show-full--info col-9">
                    <header class="show-full--info-header">
                        <div>
                            <div>
                                {{imdb_info.rating}} {{imdb_info.countries}} ({{imdb_info.year}}) - {{imdb_info.runtimes}} minutes
                            </div>
                            <div class="show-full--genres">
                                <div class="show-full--genre" v-for="genre in genres">{{genre}}</div>
                            </div>
                        </div>
                        <img style="max-height: 50px; border: 1px solid black;" :src="bannerThumbnail"/>
                    </header>
                    <div class="show-full--details row" style="height: 200px">
                        <div class="col-8">first details</div>
                        <div class="col-4">second details</div>
                    </div>
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
    import {mapGetters} from 'vuex';

    export default {
        components: {
            'episode-list': EpisodeList,
        },
        data: () => ({
            id: 0,
            imdb_info: {},
            episodes: [],
            errors: [],
        }),
        created() {
            this.id = this.$route.params.id;
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
            this.$store.dispatch('shows/find', this.id)
        },
        computed: {
            ...mapGetters('shows', [
                'getShowById'
            ]),
            getBackgroundImage: function () {
                return FileCacheService.getFileCachePosterUrl(this.id, 'fanart');
            },
            poster: function () {
                return FileCacheService.getFileCachePosterUrl(this.id, 'poster');
            },
            posterThumbnail: function () {
                return FileCacheService.getFileCachePosterUrl(this.id, 'poster/thumbnail');
            },
            banner: function () {
                return FileCacheService.getFileCachePosterUrl(this.id, 'banner');
            },
            bannerThumbnail: function () {
                return FileCacheService.getFileCachePosterUrl(this.id, 'banner/thumbnail');
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
                let tmp = [];
                this.episodes.forEach(function (episode) {
                    if (!(episode.season in tmp)) {
                        tmp[episode.season] = [];
                    }
                    tmp[episode.season].push(episode);
                });
                if (!tmp || !tmp.length) {
                    return [];
                }
                console.log(tmp);
                return tmp.slice().reverse().filter(ep => typeof ep !== 'undefined');
            },
        },
        methods: {
            seasonName(season) {
                return parseInt(season[0].season) || 'Specials';
            }
        }
    }
</script>
<style lang="scss">
    .show-full--poster {
        width: 100%;
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
        }
        .show-full--details {
            margin: .25rem 0;
            padding: .5rem;
            background: #efefef;
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
