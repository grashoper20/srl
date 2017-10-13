<template>
    <ul class="schedule-poster">
        <li v-for="episode in episodes" :class="statusClass(episode.status)">
            <div class="schedule-poster--details">
                <img :src="getPosterThumbnail(episode.showid)"/>
                <h3>{{episode.show.show_name}}</h3>
                <div class="schedule-poster--episode">Episode: {{episode | formatSeasonEpisode}} - {{episode.name}}</div>
                <div class="schedule-poster--airs">Airs: {{episode.airdate | formatAirDate}} on {{episode.show.network}}</div>
            </div>
        </li>
    </ul>

</template>

<script>
    import StatusMixin from '../mixins/Status';
    import Filters from '../filters';
    import FileCache from '../mixins/FileCache';
    import moment from 'moment';

    export default {
        props: [
            'episodes'
        ],
        mixins: [StatusMixin, FileCache,],
        filters: Filters,
    };
</script>
<style lang="scss">
    .schedule-poster {
        list-style: none;
        padding: 0;

        li {
            padding: 1rem;
        }
    }
</style>
