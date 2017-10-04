<template>
    <div id="content" class="container">
        <header class="shows--search">
            <div class="form-inline ">
                <label for="show-search" class="sr-only">Search</label>
                <input class="form-control" id="show-search" type="search" v-on:input="debounceInput"
                       placeholder="Search">
                <label for="search-sort">Sort</label>
                <select class="form-control" id="search-sort" :value="sortField" @input="updateSortField">
                    <option value="show_name">Name</option>
                    <option value="show_name">Next Episode</option>
                    <option value="network">Network</option>
                    <option value="progress">Progress</option>
                </select>
                <label for="search-layout">Layout</label>
                <select class="form-control" id="search-layout">
                    <option value="1">Poster</option>
                    <option value="2">Small poster</option>
                    <option value="3">Banner</option>
                    <option value="3">Simple</option>
                </select>
                <label for="search-direction">Direction</label>
                <select class="form-control" id="search-direction" :value="sortDescending" @input="updateSortDescending">
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
            <show-cards v-bind:shows="shows"></show-cards>
        </div>
        <div class="shows" v-if="anime && anime.length && showType != 2">
            <h2>Anime</h2>
            <show-cards v-bind:shows="anime"></show-cards>
        </div>
        <ul v-if="errors && errors.length">
            <li v-for="error in errors">
                {{error.message}}
            </li>
        </ul>
    </div>
</template>

<script>
    import fuse from 'fuse.js';
    import * as _ from 'lodash';
    import {mapGetters, mapMutations} from 'vuex';
    import ShowCards from './Shows-Cards.vue';
    import jQuery from 'jquery';

    export default {
        components: {
            'show-cards': ShowCards,
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
                return this.filterShows(this.getAnime.slice(), this.search, this.sortField, this.sortDescending);
            },
            shows() {
                return this.filterShows(this.getShows.slice(), this.search, this.sortField, this.sortDescending);
            },
            ...mapGetters('shows', [
                'getAnime',
                'getShows',
            ]),
            sortField() {
                return this.$store.state.settings.settings['sortField'] || 'show_name';
            },
            sortDescending() {
                return this.$store.state.settings.settings['sortDescending'] || 1;
            },
        },
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
            ...mapMutations('settings', {
                setSetting: 'set',
            }),
            filterShows(list, search, sortField, direction) {
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
