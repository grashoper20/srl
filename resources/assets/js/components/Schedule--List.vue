<template>
    <div>
        <v-client-table :data="tableData"
                        :columns="columns"
                        :headings="headings"
                        :options="options"></v-client-table>
    </div>
</template>

<script>
    import StatusMixin from '../mixins/Status';
    import Filters from '../filters';

    export default {
        computed: {
            tableData() {
                let data = [];
                this.episodes.forEach(function (episode) {
                    data.push({
                        airs: Filters.formatAirDate(episode.airdate),
                        show: episode.show.show_name,
                        episode: Filters.formatSeasonEpisode(episode),
                        episodeName: episode.name,
                        status: episode.real_status,
                    });
                });
                return data;
            }
        },
        data() {
            return {
                columns: [
                    'airs',
                    'show',
                    'episode',
                    'episodeName',
                ],
                headings: [
                    'Airs',
                    'Show',
                    'Episode',
                    'Episode Name',
                ],
                options: {
                    filterable: false,
                    rowClassCallback: this.rowClass,
                    skin: '',
                    perPageValues: [10],
                    pagination: {dropdown: false},
                },
            };
        },
        filters: Filters,
        mixins: [StatusMixin],
        methods: {
            rowClass(row) {
                return this.statusClass(row.status);
            },
        },
        props: [
            'episodes'
        ],
    };
</script>
