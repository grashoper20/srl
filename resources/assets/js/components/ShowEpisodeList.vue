<template>
    <div class="episode_list">
        <div v-for="episodes in seasons" :id="'season-' + episodes[0].season">
            <h4>Season {{episodes[0].season}}</h4>
            <!-- TODO Handle Season 0 - Specials -->
            <table>
                <thead>
                <tr>
                    <th>NFO</th>
                    <th>TBN</th>
                    <th>Episode</th>
                    <th>Name</th>
                    <th>Air Date</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-bind:class="episodeClass(episode.status)" v-for="episode in episodes.slice().reverse()">
                    <td class="episode--info">{{episode.hasnfo == '1' ? 'Y' : 'N'}}</td>
                    <td class="episode--tbn">{{episode.hastbn == '1' ? 'Y' : 'N'}}</td>
                    <td class="episode--episode">{{episode.episode}}</td>
                    <td class="episode--name w-100">{{episode.name}}</td>
                    <td class="episode--airdate">{{formatAirDate(episode.airdate)}}</td>
                    <td class="episode--status">{{episodeStatusText(episode.status)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        props: [
            'seasons'
        ],
        computed: {
        },
        methods: {
            formatAirDate(airdate) {
                if (airdate == 1) {
                    return 'Never';
                }
                return moment(airdate).format('YYYY-MM-DD');
            },
            episodeClass(state) {
                state = parseInt(state);
                if (state > 100) {
                    state %= 100;
                }
                switch (state) {
                    case 1:
                        return 'unaired';
                    case 2:
                    case 9:
                    case 12:
                        return 'snatched';
                    case 3:
                        return 'wanted';
                    case 4:
                        return 'good';
                    case 5:
                    case 7:
                        return 'skipped';
                    case 6:
                        return 'archived';
                    case 50:
                        return 'qual';
                }
                console.warn('Unhandled state class: ' + state);
                return 'weird-' + state;
            },
            episodeStatusText(state) {
                state = parseInt(state);
                if (state > 100) {
                    state %= 100;
                }
                switch (state) {
                    case 1:
                        return 'unaired';
                    case 2:
                    case 9:
                    case 12:
                        return 'snatched';
                    case 3:
                        return 'wanted';
                    case 4:
                        return 'good';
                    case 5:
                        return 'skipped';
                    case 6:
                        return 'archived';
                    case 7:
                        return 'ignored';
                    case 50:
                        return 'qual';
                    default:
                        console.warn('Unhandled state text: ' + state);
                        return 'weird-' + state;
                }
            }
        },
    };
</script>

<style lang="scss">
    .episode_list {
        table {
            width: 100%;
            background-color: #ddd;
        }
        th {
            padding: 0 .25rem;
            white-space: nowrap;
        }
        th, td {
            border: 1px solid white;
        }
        td {
            white-space: nowrap;
            padding: .25rem .75rem;
            text-align: center;
        }
        td.episode--name {
            text-align: left;
        }
        .unaired {
            background-color: #F5F1E4;
        }
        .good {
            background-color: #C3E3C8;
        }
        .qual {
            background-color: #FFDA8A;
        }
        .skipped {
            background-color: #BEDEED;
        }
        .wanted {
            background-color: #FFB0B0;
        }
        .snatched {
            background-color: #EBC1EA;
        }
    }
</style>
