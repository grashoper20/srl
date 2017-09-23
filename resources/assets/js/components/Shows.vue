<template>
    <div id="content" class="container">
        <header class="form-inline shows--search">
            <label for="show-search" class="sr-only">Search</label>
            <input class="form-control" id="show-search" type="search" v-on:input="debounceInput" placeholder="Search">
            <label for="search-show-type">Show type: </label>
            <select class="form-control" id="search-show-type" v-model="showType">
                <option value="1">All</option>
                <option value="2">Shows</option>
                <option value="3">Anime</option>
            </select>
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
    import * as _ from "lodash";

    export default {
        data: () => ({
            errors: [],
            full_list: [],
            filtered_list: [],
            shows: [],
            anime: [],
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
            axios.get('/api/show')
                .then(response => {
                    this.full_list = response.data;
                })
                .catch(e => {
                    this.errors.push(e)
                })
        },
        watch: {
            search() {
                this.triggerSearch();
            },
            full_list() {
                this.fuse = new Fuse(this.full_list, this.fuse_options);
                this.triggerSearch();
            },
            filtered_list() {
                let anime = [], shows = [];
                this.filtered_list.forEach(function (show) {
                    if (parseInt(show.anime)) {
                        anime.push(show);
                    }
                    else {
                        shows.push(show);
                    }
                });
                this.anime = anime;
                this.shows = shows;
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
