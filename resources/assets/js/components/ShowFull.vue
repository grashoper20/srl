<template>
    <div class="show-full">
        <div class="container">
            <header class="show-full--head row">
                <h1 class="col">{{show.show_name}}</h1>
                <div class="col-auto show-full--seasons">Seasons: <a
                        v-for="season in orderedEpisodeList" :href="'#season-' + season[0].season">{{seasonName(season)}}</a>
                </div>
            </header>
            <div class="row">
                <show-details v-bind:show="show"></show-details>
            </div>
            <div class="row">
                <h2 class="show-full--episode-header col-12">Episode list</h2>
                <div class="col-12">
                    <episode-list v-bind:seasons="orderedEpisodeList"></episode-list>
                </div>
            </div>
        </div>
        <div class="show-full--backdrop" :style="{backgroundImage: 'url(' + getFanArt(id) + ')'}"></div>
    </div>
</template>

<script>
    import api from '../api';
    import FileCache from '../mixins/FileCache';
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
            episodes: [],
            errors: [],
        }),
        created() {
            this.id = parseInt(this.$route.params.id);
            api.show.getEpisodes(this.id)
                .then(response => {
                    this.episodes = response.data;
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
        mixins: [FileCache,],
        methods: {
            seasonName(season) {
                return season[0].season || 'Specials';
            },
        }
    }
</script>
<style lang="scss">
    @import "../../sass/variables";

    .show-full--head {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid $border-dark-grey;
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
    .show-full--episode-header {
        margin-top: 1rem;
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
