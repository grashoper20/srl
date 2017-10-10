<template>
    <div id="content" class="container">
        <header class="shows--search">
            <div class="form-inline ">
                <label for="show-search" class="sr-only">Search</label>
                <input class="form-control" id="show-search" type="search" v-on:input="debounceInput"
                       placeholder="Search">
                <label for="search-sort">Sort</label>
                <select class="form-control" id="search-sort" :value="getShowSortField" @input="updateSortField">
                    <option value="show_name">Name</option>
                    <option value="show_name">Next Episode</option>
                    <option value="network">Network</option>
                    <option value="progress">Progress</option>
                </select>
                <label for="search-layout">Layout</label>
                <select class="form-control" id="search-layout" :value="getShowLayout" @input="updateShowLayout">
                    <option value="1">Poster</option>
                    <option value="2">Small poster</option>
                    <option value="3">Banner</option>
                    <option value="4">Simple</option>
                </select>
                <label for="search-direction">Direction</label>
                <select class="form-control" id="search-direction" :value="getShowSortDescending"
                        @input="updateSortDescending">
                    <option value="1">Asc</option>
                    <option value="2">Desc</option>
                </select>
            </div>
            <div class="form-inline "><label for="search-show-type">Show type</label>
                <select class="form-control" id="search-show-type" v-model="showType">
                    <option value="1">All</option>
                    <option value="2">Shows</option>
                    <option value="3">Anime</option>
                </select>
            </div>
        </header>
        <div class="shows" v-if="shows && shows.length && showType != 3">
            <h2>Shows</h2>
            <show-cards v-if="getShowLayout == 1" v-bind:shows="shows"></show-cards>
            <small-poster v-else-if="getShowLayout == 2">small-poster</small-poster>
            <banner v-else-if="getShowLayout == 3">banner</banner>
            <simple v-else-if="getShowLayout == 4">simple</simple>
        </div>
        <div class="shows" v-if="anime && anime.length && showType != 2">
            <h2>Anime</h2>
            <show-cards v-if="getShowLayout == 1" v-bind:shows="anime"></show-cards>
            <small-poster v-else-if="getShowLayout == 2">small-poster</small-poster>
            <banner v-else-if="getShowLayout == 3">banner</banner>
            <simple v-else-if="getShowLayout == 4">simple</simple>
        </div>
        <ul v-if="errors && errors.length">
            <li v-for="error in errors">
                {{error.message}}
            </li>
        </ul>
    </div>
</template>

<script>
    import Fallback from './Example.vue';
    import FileCache from '../mixins/FileCache';
    import ShowCards from './Shows-Cards.vue';
    import fuse from 'fuse.js';
    import * as _ from 'lodash';
    import {mapGetters, mapMutations} from 'vuex';
    import jQuery from 'jquery';

    export default {
        components: {
            'show-cards': ShowCards,
            'small-poster': Fallback,
            'banner': Fallback,
            'simple': Fallback,
        },
        data: () => ({
            search: '',
            showType: 1,
            errors: [],
            fuse_options: {
                shouldSort: true,
                threshold: 0.2,
                location: 0,
                distance: 100,
                maxPatternLength: 32,
                minMatchCharLength: 1,
                keys: [
                    'show_name',
                ]
            },
        }),
        mounted() {
            this.$store.dispatch('shows/sync');
        },
        computed: {
            anime() {
                return this.filterShows(this.getAnime.slice(), this.search, this.getShowSortField, this.getShowSortDescending);
            },
            shows() {
                return this.filterShows(this.getShows.slice(), this.search, this.getShowSortField, this.getShowSortDescending);
            },
            ...mapGetters('shows', [
                'getAnime',
                'getShows',
            ]),
            ...mapGetters('settings', [
                'getShowSortField',
                'getShowSortDescending',
                'getShowLayout',
            ]),
        },
        mixins: [FileCache,],
        methods: {
            updateSortField(e) {
                this.setSetting({
                    key: 'sortField',
                    value: e.target.value,
                });
            },
            updateSortDescending(e) {
                this.setSetting({
                    key: 'sortDescending',
                    value: e.target.value,
                });
            },
            updateShowLayout(e) {
                this.setSetting({
                    key: 'showLayout',
                    value: e.target.value,
                });
            },
            ...mapMutations('settings', {
                setSetting: 'setShowSetting',
            }),
            filterShows(list, search, sortField, direction) {
                sortField = sortField || 'show_name';
                direction = direction || 1;
                if (search) {
                    return (new fuse(list, this.fuse_options))
                        .search(search);
                }
                return this.sortHelper(list, sortField, direction - 1);
            },
            debounceInput: _.debounce(function (e) {
                this.search = e.target.value.trim();
            }, 250),
            sortHelper(list, field, descending) {
                try {
                    let isNumber = false;
                    list.forEach((x) => {
                        isNumber |= jQuery.isNumeric(x);
                    });
                    return list.sort(function (a, b) {
                        let comp_strings = [];
                        // Stringify.
                        [a[field], b[field]].forEach((x) => {
                            comp_strings.push((typeof x === 'undefined' || x === null)
                                ? ''
                                : x.toString());
                        });
                        // Compare.
                        let comparison = comp_strings[0]
                            .localeCompare(comp_strings[1], {numeric: isNumber});
                        // Apply direction.
                        return (descending ? comparison * -1 : comparison);
                    });
                }
                catch (e) {
                    console.error(e);
                    return [];
                }
            },
        },
    }
</script>

<style lang="scss">
    .shows--search {
        .form-control {
            margin-left: 5px;
        }
    }
</style>
