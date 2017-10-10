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
            <td>{{airdateFormat(episode.airdate)}}</td>
            <td>{{episode.show.show_name}}</td>
            <td>S{{episode.season}}E{{episode.episode}}</td>
            <td>{{episode.name}}</td>
        </tr>
    </table>
</template>

<script>
    import StatusMixin from '../mixins/Status';
    import moment from 'moment';

    export default {
        props: [
            'episodes'
        ],
        mixins: [StatusMixin],
        methods: {
            airdateFormat(date) {
                return moment(date).format('YYYY-MM-DD h:mm:ss a');
            }
        },
    };
</script>
