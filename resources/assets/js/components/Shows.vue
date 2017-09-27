<template>
    <div id="content" class="container">
        <header class="shows--search">
            <div class="form-inline ">
                <label for="show-search" class="sr-only">Search</label>
                <input class="form-control" id="show-search" type="search" v-on:input="debounceInput"
                       placeholder="Search">
                <label for="search-sort">Sort</label>
                <select class="form-control" id="search-sort">
                    <option value="1">Name</option>
                    <option value="2">Next Episode</option>
                    <option value="3">Network</option>
                    <option value="3">Progress</option>
                </select>
                <label for="search-layout">Layout</label>
                <select class="form-control" id="search-layout">
                    <option value="1">Name</option>
                    <option value="2">Next Episode</option>
                    <option value="3">Network</option>
                    <option value="3">Progress</option>
                </select>
            </div>
            <div class="form-inline ">
                <label for="search-show-type">Show type</label>
                <select class="form-control" id="search-show-type" v-model="showType">
                    <option value="1">All</option>
                    <option value="2">Shows</option>
                    <option value="3">Anime</option>
                </select>
            </div>
        </header>
        <div class="shows" v-if="shows && shows.length && showType != 3">
            <h2>Shows</h2>
            <div class="shows--list">
                <show v-for="show in shows" :key="show.show_id" v-bind:show="show"></show>
            </div>
        </div>
        <div class="anime" v-if="anime && anime.length && showType != 2">
            <h2>Anime</h2>
            <div class="shows--list">
                <show v-for="show in anime" :key="show.show_id" v-bind:show="show"></show>
            </div>
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
    import {mapState, mapGetters} from 'vuex'
    import Show from './Show.vue';

    export default {
        components: {
            'show': Show,
        },
        data: () => ({
            errors: [],
//            full_list: [],
            filtered_list: [],
            search: '',
            fuse: {},
            showType: 1,
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

    .shows--list {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }
</style>
