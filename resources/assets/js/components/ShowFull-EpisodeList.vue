<template>
    <div class="episode_list">
        <div class="table-responsive show-episode-list--season" v-for="episodes in seasons"
             :id="'season-' + episodes[0].season">
            <h4>{{seasonName(episodes)}}</h4>
            <v-client-table :data="episodes"
                            :columns="columns"
                            :options="options">
                <template slot="hasnfo" slot-scope="props">
                    {{props.row.hasnfo ? 'Y' : 'N'}}
                </template>
                <template slot="hastbn" slot-scope="props">
                    {{props.row.hastbn ? 'Y' : 'N'}}
                </template>
                <template slot="airdate" slot-scope="props">
                    {{props.row.airdate | formatAirDate}}
                </template>
                <template slot="status" slot-scope="props">
                    <episode-status :episode="props.row"></episode-status>
                </template>
            </v-client-table>
        </div>
    </div>
</template>

<script>
    import Filters from '../filters';
    import EpisodeStatus from './EpisodeStatus.vue';
    import StatusMixin from '../mixins/Status';

    export default {
        components: {
            EpisodeStatus,
        },
        data() {
            return {
                columns: [
                    'hasnfo',
                    'hastbn',
                    'episode',
                    'name',
                    'airdate',
                    'status',
                ],
                options: {
                    perPage: 1000,
                    perPageValues: [1000],
                    pagination: false,
                    orderBy: {column: 'episode', ascending: false,},
                    headings: {
                        hasnfo: 'NFO',
                        hastbn: 'TBN',
                        episode: '#',
                        name: 'Name',
                        airdate: 'Air Date',
                        status: 'Status',
                    },
                    columnsClasses: {
                        hasnfo: 'episode--nfo',
                        hastbn: 'episode--tbn',
                        episode: 'episode--episode',
                        name: 'episode--name w-100',
                        airdate: 'episode--airdate',
                        status: 'episode--status w-100',
                    },
                    rowClassCallback: (episode) => {
                        return this.statusClass(episode.real_status);
                    },
                    sortable: [],
                },
                tableData: []

            };
        },
        filters: Filters,
        methods: {
            seasonName(season) {
                if (season[0].season) {
                    return 'Season ' + season[0].season;
                }
                return 'Specials';
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
    @import "../../sass/helper";
    @import "~material-shadows/material-shadows";

    .show-episode-list--season {
        background: $background-off-white;
        @include z-depth-2dp();
        h4 {
            margin: 0;
            padding: .5rem;
        }
    }

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
        .VuePagination__count {
            display: none;
        }
    }
</style>
