<template>
    <div id="schedule" class="container">
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
            <tr v-for="episode in episodes">
                <td>{{airdateFormat(episode.airdate)}}</td>
                <td>{{episode.name}}</td>
                <td>{{episode.show.show_name}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    import moment from 'moment';

    export default {
        data() {
            return {
                episodes: [],
            };
        },
        mounted() {
            axios.get('api/schedule').then(response => {
                this.episodes = response.data.data;
            });
        },
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
</style>
