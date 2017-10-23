<template>
    <div id="schedule" class="container schedule">
        <header class="schedule--search">
            <h1>Schedule</h1>
            <div class="form-inline ">
                <!--
                <label for="search-sort">Sort</label>
                <select class="form-control" id="search-sort">
                    <option value="date">Date</option>
                    <option value="network">Network</option>
                    <option value="show_name">Show</option>
                </select>
                <label for="search-paused">Paused</label>
                <select class="form-control" id="search-paused">
                    <option value="hidden">Hidden</option>
                    <option value="shown">Shown</option>
                </select>
                <label for="search-snatched">Snatched</label>
                <select class="form-control" id="search-snatched">
                    <option value="hidden">Hidden</option>
                    <option value="shown">Shown</option>
                </select>
                -->
                <label for="search-layout">Layout</label>
                <select class="form-control" id="search-layout" :value="getScheduleLayout" @input="updateShowLayout">>
                    <option value="1">Banner</option>
                    <option value="2">Poster</option>
                    <option value="3">List</option>
                    <option value="4">Calendar</option>
                </select>
            </div>
        </header>

        <div v-if="getScheduleLayout == 1">
            <div v-for="(episodeList, groupDate) in groupedEpisodes">
                <h3 style="margin:0">{{groupDate | formatDate('dddd L')}}</h3>
                <schedule-banner :episodes="episodeList" :banner="true"></schedule-banner>
            </div>
        </div>
        <div v-if="getScheduleLayout == 2">
            <div v-for="(episodeList, groupDate) in groupedEpisodes">
                <h3 style="margin:0">{{groupDate | formatDate('dddd L')}}</h3>
                <schedule-poster :episodes="episodeList" :poster="true"></schedule-poster>
            </div>
        </div>
        <schedule-list v-else-if="getScheduleLayout == 3" :episodes="episodes"></schedule-list>
        <calendar v-else-if="getScheduleLayout == 4"></calendar>
    </div>
</template>

<script>
    import * as _ from 'lodash';
    import api from '../../api/index';
    import moment from 'moment';
    import EpisodeTiles from '../Episode-Tiles';
    import Fallback from './Example.vue';
    import Filters from '../../filters';
    import ScheduleList from '../Schedule--List';

    export default {
        data() {
            return {
                episodes: [],
                layout: 1,
            };
        },
        components: {
            'schedule-banner': EpisodeTiles,
            'schedule-poster': EpisodeTiles,
            'schedule-list': ScheduleList,
            'calendar': Fallback,
        },
        computed: {
            getScheduleLayout() {
                return this.layout;
            },
            groupedEpisodes() {
                return _.groupBy(this.episodes, (episode) => moment(episode.airdate).startOf('day'));
            },
        },
        filters: Filters,
        methods: {
            updateShowLayout(e) {
                this.layout = e.target.value;
            },
        },
        mounted() {
            api.schedule.getEpisodes().then(response => {
                this.episodes = response.data.data;
            });
        },
    }
</script>

<style lang="scss">
    .schedule--search {
        display: flex;
        justify-content: space-between;
    }

    .form-inline label {
        padding: 0 5px;
    }

    .schedule {
        table {
            width: 100%;
            background-color: #ddd;
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
    }

</style>
