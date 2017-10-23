<template>
    <v-client-table :data="shows"
                    :columns="tableColumns"
                    :options="tableOptions">
        <template slot="title" slot-scope="props">
            <router-link :to="{name: 'show', params: {id: props.row.indexer_id}}">
                {{props.row.show_name}}
            </router-link>
        </template>
        <template slot="poster" slot-scope="props">
            <router-link :to="{name: 'show', params: {id: props.row.indexer_id}}">
                <poster :id="props.row.indexer_id" :thumbnail="true" :alt="props.row.show_name"></poster>
                {{props.row.show_name}}
            </router-link>
        </template>
        <template slot="banner" slot-scope="props">
            <router-link :to="{name: 'show', params: {id: props.row.indexer_id}}">
                <banner :id="props.row.indexer_id" :thumbnail="true" :alt="props.row.show_name"></banner>
            </router-link>
        </template>
        <template slot="progress" slot-scope="props">
            <progress-bar :progress="props.row.progress"></progress-bar>
        </template>
        <template slot="size" slot-scope="props">
            <span :data-raw="props.row.stats.show_size">{{props.row.stats.show_size | formatBytes}}</span>
        </template>
        <template slot="active" slot-scope="props">
            {{!props.row.paused | formatStatus}}
        </template>
        <template slot="quality" slot-scope="props">
            <quality-pills :qualities="props.row.quality" :simple="true"></quality-pills>
        </template>
        <template slot="nextEp" slot-scope="props">
            {{props.row.stats.next_airs | formatDate('YYYY-MM-DD')}}
        </template>
        <template slot="prevEp" slot-scope="props">
            {{props.row.stats.previous_air | formatDate('YYYY-MM-DD')}}
        </template>
    </v-client-table>
</template>

<script>
    import Banner from './Banner.vue';
    import Filters from '../filters';
    import Poster from './Poster.vue';
    import ProgressBar from './ProgressBar.vue';
    import QualityPills from './QualityPills.vue';
    import Utility from '../mixins/Utility';

    export default {
        components: {
            'poster': Poster,
            'banner': Banner,
            'progress-bar': ProgressBar,
            'quality-pills': QualityPills,
        },
        computed: {
            tableColumns() {
                let position = 2; // 2
                let columns = [
                    'nextEp',
                    'prevEp',
                    'network',
                    'quality',
                    'progress',
                    'size',
                    'active',
                    'status',
                ];
                switch (this.layout) {
                    case '2':
                        columns.splice(position, 0, 'poster');
                        break;
                    case '3':
                        columns.splice(position, 0, 'banner');
                        break;
                    case '4':
                    default:
                        columns.splice(position, 0, 'title');
                        break;
                }
                return columns;
            },
        },
        data() {
            return {
                tableOptions: {
                    perPageValues: [10],
                    pagination: {dropdown: false},
                    skin: 'table-striped',
                    customSorting: {
                        active: (ascending) => {
                            return Utility.methods.getSort(ascending, false, (a) => a.paused);
                        },
                        banner: (ascending) => {
                            return Utility.methods.getSort(ascending, false, (a) => a.show_name);
                        },
                        nextEp: (ascending) => {
                            return Utility.methods.getSort(ascending, false, (a) => a.stats.next_airs);
                        },
                        poster: (ascending) => {
                            return Utility.methods.getSort(ascending, false, (a) => a.show_name);
                        },
                        prevEp: (ascending) => {
                            return Utility.methods.getSort(ascending, false, (a) => a.stats.previous_air);
                        },
                        size: (ascending) => {
                            return Utility.methods.getSort(ascending, true, (a) => a.stats.show_size);
                        },
                        title: (ascending) => {
                            return Utility.methods.getSort(ascending, false, (a) => a.show_name);
                        },
                    },
                    headings: {
                        poster: 'Show',
                        banner: 'Show',
                        title: 'Show',
                        nextEp: 'Next',
                        prevEp: 'Previous',
                        network: 'Network',
                        quality: 'Quality',
                        progress: 'Progress',
                        size: 'Size',
                        active: 'Active',
                        status: 'Status',
                    },
                },
            };
        },
        filters: Filters,
        props: {
            shows: Array,
            layout: String,
        }
    }

</script>
