<template>
    <div class="schedule-tiles">
        <schedule-tile :poster="poster" :banner="banner" :episode="episode"
                       :key="episode.episode_id" v-for="episode in episodes">
        </schedule-tile>
    </div>
</template>

<script>
    import ScheduleTile from './Schedule--Tile';

    export default {
        components: {
            ScheduleTile,
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
    .schedule-tiles {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px 0;
    }
</style>
