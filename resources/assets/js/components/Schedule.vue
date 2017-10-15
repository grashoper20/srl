<template>
    <div id="schedule" class="container schedule">
        <header class="schedule--search row">
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

        <schedule-banner v-if="getScheduleLayout == 1" :episodes="episodes" :banner="true"></schedule-banner>
        <schedule-poster v-else-if="getScheduleLayout == 2" :episodes="episodes" :poster="true"></schedule-poster>
        <schedule-list v-else-if="getScheduleLayout == 3" :episodes="episodes"></schedule-list>
        <calendar v-else-if="getScheduleLayout == 4"></calendar>
    </div>
</template>

<script>
    import api from '../api';
    import Fallback from './Example.vue';
    import ScheduleCard from './Schedule--Card';
    import ScheduleList from './Schedule--List';

    export default {
        data() {
            return {
                episodes: [],
                layout: 1,
            };
        },
        components: {
            'schedule-banner': ScheduleCard,
            'schedule-poster': ScheduleCard,
            'schedule-list': ScheduleList,
            'calendar': Fallback,
        },
        mounted() {
            api.schedule.getEpisodes()
                .then(response => {
                    this.episodes = response.data.data;
                });
        },
        computed: {
            getScheduleLayout() {
                return this.layout;
            },
        },
        methods: {
            updateShowLayout(e) {
                this.layout = e.target.value;
            },
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
