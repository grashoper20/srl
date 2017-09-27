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
                    <option value="show_name">Next Episode</option>
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
    import axios from 'axios';
    import Fuse from 'fuse.js';
    import * as _ from 'lodash';
    import {mapState, mapGetters} from 'vuex';
    import ShowCards from './Shows-Cards.vue';

    export default {
        components: {
            'show-cards': ShowCards,
        },
        data: () => ({
            errors: [],
//            full_list: [],
            filtered_list: [],
            search: '',
            fuse: {},
            showType: 1,
            sortField: 'show_name',
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
            this.$store.dispatch('shows/sync').then(() => {
                this.fuse = new Fuse(this.full_list, this.fuse_options);
                this.triggerSearch();
            });
        },
        computed: {
            ...mapGetters('shows', [
                'shows',
                'anime',
            ]),
            ...mapState('shows', {
                full_list: state => state.list,
            }),
        },
        watch: {
            sortField() {
                this.$store.commit('shows/sort', {
                    field: this.sortField,
                    descending: false,
                });
                console.log(this.sortField);
            },
            search() {
                this.triggerSearch();
            },
        },
        methods: {
            triggerSearch: function () {
                let keyworks = this.search.trim();
                if (keyworks === '') {
                    this.filtered_list = this.full_list;
                } else {
                    this.filtered_list = this.fuse.search(keyworks);
                }
            },
            debounceInput: _.debounce(function (e) {
                this.search = e.target.value;
            }, 250),
        }
    }
</script>

<style lang="scss">
    .shows--search {
        .form-control {
            margin-left: 5px;
        }
    }
</style>
