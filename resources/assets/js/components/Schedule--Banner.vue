<template>
    <ul class="schedule-banner">
        <li v-for="episode in episodes" :class="statusClass(episode.status)">
            <div class="schedule-banner--details">
                <img :src="getBanner(episode.showid)"/>
                <h3>{{episode.show.show_name}}</h3>
                <div class="schedule-banner--episode">Episode: {{episode | formatSeasonEpisode}} - {{episode.name}}</div>
                <div class="schedule-banner--airs">Airs: {{episode.airdate | formatAirDate}} on {{episode.show.network}}</div>
            </div>
        </li>
    </ul>
</template>

<script>
    import StatusMixin from '../mixins/Status';
    import FileCache from '../mixins/FileCache';
    import Filters from '../filters';

    export default {
        props: [
            'episodes'
        ],
        mixins: [StatusMixin, FileCache,],
        filters: Filters,
    };
</script>

<style lang="scss">
    // Variables
    @import "../../sass/variables";
    @import "../../sass/helper";

    .schedule-banner {
        list-style: none;
        padding: 0;

        li {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid $border-dark-grey;
        }
        img {
            width: 100%;
        }
    }
    .schedule-banner--details {
        background: $background-off-white;
        padding: 1rem;
        h3 {
            font-size: 1.25rem;
        }
    }
</style>
