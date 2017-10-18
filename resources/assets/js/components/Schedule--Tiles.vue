<template>
    <ul class="schedule-card container">
        <li v-for="episode in episodes" :class="statusClass(episode.real_status) + ' row'">
            <schedule-tile-content :poster="poster" :banner="banner" :episode="episode"></schedule-tile-content>
        </li>
    </ul>
</template>

<script>
    import FileCache from '../mixins/FileCache';
    import Filters from '../filters';
    import ScheduleTileContent from './Schedule--Tile';
    import StatusMixin from '../mixins/Status';

    export default {
        components: {
            'schedule-tile-content': ScheduleTileContent,
        },
        data() {
            return {
                show: false,
            };
        },
        filters: Filters,
        mixins: [StatusMixin, FileCache,],
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


    .schedule-card {
        list-style: none;
        padding: 1rem 0 0;

        li {
            border: 1px solid $border-dark-grey;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
            @include z-depth-2dp();
        }
    }
</style>
