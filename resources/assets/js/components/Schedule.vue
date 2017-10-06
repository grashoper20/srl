<template>
    <div id="schedule" class="container schedule">
        <header class="schedule--search">
            <h1>Schedule</h1>
            <div class="form-inline ">
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
                <label for="search-layout">Layout</label>
                <select class="form-control" id="search-layout">
                    <option value="1">Poster</option>
                    <option value="2">Calendar</option>
                    <option value="3">Banner</option>
                    <option value="4">List</option>
                </select>
            </div>
        </header>

        <table>
            <thead>
                <th>Airs</th>
                <th>Show</th>
                <th>Episode</th>
                <th>Episode Name</th>
            </thead>
            <tr v-for="episode in episodes" :class="statusClass(episode.status)">
                <td>{{airdateFormat(episode.airdate)}}</td>
                <td>{{episode.show.show_name}}</td>
                <td>S{{episode.season}}E{{episode.episode}}</td>
                <td>{{episode.name}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    import api from '../api';
    import StatusMixin from '../mixins/Status';
    import moment from 'moment';

    export default {
        data() {
            return {
                episodes: [],
            };
        },
        mounted() {
            api.schedule.getEpisodes()
                .then(response => {
                    this.episodes = response.data.data;
                });
        },
        mixins: [StatusMixin],
        methods: {
            airdateFormat(date) {
                return moment(date).format('YYYY-MM-DD h:mm:ss a');
            }
        }
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
