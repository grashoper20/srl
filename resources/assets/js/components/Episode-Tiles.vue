<template>
    <div class="episode-tiles">
        <episode-tile :poster="poster" :banner="banner" :episode="episode"
                       :key="episode.episode_id" v-for="episode in episodes">
        </episode-tile>
    </div>
</template>

<script>
    import EpisodeTile from './Episode-Tile';

    export default {
        components: {
            EpisodeTile,
        },
        props: {
            episodes: Array,
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
    .episode-tiles {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px 0;
    }
</style>
