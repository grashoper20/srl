<template>
    <div class="container">
        <h1>History</h1>
        <v-server-table url="/api/history" :columns="columns" :options="options">
            <template slot="date" slot-scope="props">
                <time :datetime="props.row.date | formatIsoDate">{{props.row.date | formatAirDate}}</time>
            </template>
            <template slot="episode" slot-scope="props">
                <router-link :to="{name: 'show', params: {id: props.row.showid}}">
                    {{ props.row.show.show_name }} - {{ props.row | formatSeasonEpisode }}
                </router-link>
                <quality-pill :quality="{id:-1, quality: 'Proper', custom: 'proper'}"
                              v-if="props.row.resource.toLowerCase().match(/proper|repack/)"></quality-pill>
            </template>
            <template slot="action" slot-scope="props">
                <span :title="props.row.resource">{{props.row.action[0] | formatStatusText }}</span>
            </template>
            <template slot="quality" slot-scope="props">
                <quality-pill :quality="props.row.quality"></quality-pill>
            </template>
        </v-server-table>
    </div>
</template>

<script>
    import Filters from '../../filters';
    import QualityPill from '../QualityPill.vue';

    export default {
        component: {
            QualityPill,
        },
        data() {
            return {
                columns: ['date', 'episode', 'action', 'provider', 'quality'],
                options: {
                    columnsClasses: {
                        episode: 'w-100',
                    },
                    orderBy: {
                        ascending: false,
                        column: 'date',
                    },
                },
            };
        },
        filters: Filters,
    }
</script>

<style lang="scss">
    td {
        white-space: nowrap;
    }
</style>