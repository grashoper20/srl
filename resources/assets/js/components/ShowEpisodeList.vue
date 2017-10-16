<template>
    <div class="episode_list">
        <div class="table-responsive" v-for="episodes in seasons" :id="'season-' + episodes[0].season">
            <h4>Season {{seasonName(episodes)}}</h4>
            <!-- TODO Handle Season 0 - Specials -->
            <table class="table">
                <thead>
                <tr>
                    <th class="episode--nfo">NFO</th>
                    <th class="episode--tbn">TBN</th>
                    <th class="episode--episode">#</th>
                    <th class="episode--name">Name</th>
                    <th class="episode--airdate">Air Date</th>
                    <th class="episode--status">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-bind:class="statusClass(episode.real_status)" v-for="episode in episodes.slice().reverse()">
                    <td class="episode--nfo">{{episode.hasnfo ? 'Y' : 'N'}}</td>
                    <td class="episode--tbn">{{episode.hastbn ? 'Y' : 'N'}}</td>
                    <td class="episode--episode">{{episode.episode}}</td>
                    <td class="episode--name w-100">{{episode.name}}</td>
                    <td class="episode--airdate">{{episode.airdate | formatAirDate}}</td>
                    <td class="episode--status"><quality-pill :qualities="episode.quality"></quality-pill></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Filters from '../filters';
    import QualityPill from "./QualityPill.vue";
    import StatusMixin from '../mixins/Status';

    export default {
        components: {
            QualityPill,
            'quality-pill': QualityPill,
        },
        filters: Filters,
        methods: {
            seasonName(season) {
                return season[0].season || 'Specials';
            },

        },
        mixins: [StatusMixin,],
        props: [
            'seasons'
        ],
    };
</script>

<style lang="scss">
    // Variables
    @import "../../sass/variables";
    @import "../../sass/helper";

    @include media-breakpoint-down(md) {
        .episode--nfo,
        .episode--tbn {
            display: none;
        }
    }

    @include media-breakpoint-down(sm) {
        .episode--airdate,
        .episode--status {
            display: none;
        }
    }

    .episode_list {
        table {
            width: 100%;
            background-color: $background-off-white-dark;
        }
        th, td {
            border: 1px solid white;
            white-space: nowrap;
            text-align: center;
            padding: .25rem .75rem;
        }
        th {
            padding-bottom: .1rem;
        }
        .episode--name {
            text-align: left;
        }
    }
</style>
