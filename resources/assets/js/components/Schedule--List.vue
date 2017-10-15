<template>
    <table>
        <thead>
        <tr>
            <th>Airs</th>
            <th>Show</th>
            <th>Episode</th>
            <th>Episode Name</th>
        </tr>
        </thead>
        <tr v-for="episode in episodes" :class="statusClass(episode.status)">
            <td>{{episode.airdate | formatAirDate}}</td>
            <td>{{episode.show.show_name}}</td>
            <td>S{{episode.season}}E{{episode.episode}}</td>
            <td>{{episode.name}}</td>
        </tr>
    </table>
</template>

<script>
    import StatusMixin from '../mixins/Status';
    import Filters from '../filters';

    export default {
        props: [
            'episodes'
        ],
        mixins: [StatusMixin],
        filters: Filters,
    };
</script>
