<template>
    <div class="episode_list">
        <div v-for="seasonList in orderedEpisodeList">
            <h4>Season {{seasonList[0].season}}</h4>
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
                <tr v-bind:class="episodeClass(episode.status)" v-for="episode in seasonList.slice().reverse()">
                    <td>{{episode.hasnfo == '1' ? 'Y' : 'N'}}</td>
                    <td>{{episode.hastbn == '1' ? 'Y' : 'N'}}</td>
                    <td>{{episode.episode}}</td>
                    <td class="w-100">{{episode.name}}</td>
                    <td>{{episode.airdate}}</td>
                    <td>{{episodeStatusText(episode.status)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            episodeList: [],
        }),
        props: [
            'episodes'
        ],
        watch: {
            episodes() {
                let tmp = [];
                this.episodes.forEach(function (episode) {
                    if (!(episode.season in tmp)) {
                        tmp[episode.season] = [];
                    }
                    tmp[episode.season].push(episode);
                });
                this.episodeList = tmp;
            }
        },
        computed: {
            orderedEpisodeList: function () {
                if (!this.episodeList || !this.episodeList.length) {
                    return [];
                }
                return this.episodeList.slice().reverse().filter(ep => typeof ep !== 'undefined');
            }
        },
        methods: {
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
