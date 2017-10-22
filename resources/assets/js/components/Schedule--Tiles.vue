<template>
    <ul class="schedule-tile container">
        <li v-for="episode in episodes" :class="statusClass(episode.real_status) + ' row'">
            <schedule-tile :poster="poster" :banner="banner" :episode="episode"></schedule-tile>
        </li>
    </ul>
</template>

<script>
    import FileCache from '../mixins/FileCache';
    import Filters from '../filters';
    import ScheduleTile from './Schedule--Tile';
    import StatusMixin from '../mixins/Status';

    export default {
        components: {
            ScheduleTile,
        },
        filters: Filters,
        mixins: [FileCache, StatusMixin,],
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
    @import "../../sass/variables";
    @import "~material-shadows/material-shadows";

    .schedule-tile {
        list-style: none;
        padding: 1rem 0 0;

        li {
            border: 1px solid $border-dark-grey;
            border-bottom-width: 0;
            /*border-radius: 5px;*/
            padding: 1rem;
            border-collapse: collapse;
            /*margin-bottom: 1rem;*/
//            @include z-depth-2dp();
        }
        li:last-child{
            border-bottom-width: 1px;
        }
    }
</style>
