<template>
    <div id="content" class="container">
        <header class="shows--search">
            <div class="form-inline ">
                <label for="show-search" class="sr-only">Search</label>
                <input class="form-control" id="show-search" type="search" v-on:input="debounceInput"
                       placeholder="Search">
                <label for="search-sort">Sort</label>
                <select class="form-control" id="search-sort" v-model="sortField">
                    <option value="show_name">Name</option>
                    <option value="air_by_date">Next Episode</option>
                    <option value="network">Network</option>
                    <option value="show_name">Progress</option>
                </select>
                <label for="search-layout">Layout</label>
                <select class="form-control" id="search-layout">
                    <option value="1">Poster</option>
                    <option value="2">Small poster</option>
                    <option value="3">Banner</option>
                    <option value="3">Simple</option>
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
    import {mapState} from 'vuex';
    import ShowCards from './Shows-Cards.vue';

    export default {
        components: {
            'show-cards': ShowCards,
        },
        data: () => ({
            search: '',
            showType: 1,
            sortField: 'show_name',
            sortDescending: false,
            errors: [],
            fuse_options: {},
        }),
        created() {
            this.fuse_options = {
                shouldSort: true,
                threshold: 0.2,
                location: 0,
                distance: 100,
                maxPatternLength: 32,
                minMatchCharLength: 1,
                keys: [
                    'show_name',
                ]
            };
        },
        mounted() {
            this.$store.dispatch('stats/sync');
            this.$store.dispatch('shows/sync');
        },
        computed: {
            anime() {
                let list = this.full_list
                    .filter(show => parseInt(show.anime));
                if (this.search) {
                    return (new fuse(list, this.fuse_options))
                        .search(this.search);
                }
                return this.sortHelper(list, this.sortField, this.sortDescending);
            },
            shows() {
                let list = this.full_list
                    .filter(show => !parseInt(show.anime));
                if (this.search) {
                    return (new fuse(list, this.fuse_options))
                        .search(this.search);
                }
                return this.sortHelper(list, this.sortField, this.sortDescending);
            },
            ...mapState('shows', {
                full_list: state => state.list,
            }),
        },
        methods: {
            debounceInput: _.debounce(function (e) {
                this.search = e.target.value.trim();
            }, 250),
            sortHelper(list, field, descending) {
                try {
                    return list.sort(function (a, b) {
                        let comp_strings = [];
                        [a[field], b[field]].forEach((x) => {
                            // TODO Logic to converge to comparable strings.
                            if (typeof x === 'undefined' || x === null) {
                                x = '';
                            }
                            comp_strings.push(x);
                        });

                        let comparison = comp_strings[0]
                            .localeCompare(comp_strings[1]);
                        if (comparison === 0 && field !== 'show_name') {
                            comparison = a.show_name
                                .localeCompare(b.show_name);
                        }
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
