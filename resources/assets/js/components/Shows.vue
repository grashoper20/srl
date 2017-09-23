<template>
    <div id="content" class="container">
        <input type="text" v-model="search">
        <div class="shows">
            <h2>Shows</h2>
            <div class="shows--list">
                <show v-for="show in shows" :key="show.show_id" v-bind:show="show"></show>
            </div>
        </div>
        <div class="anime" v-if="anime && anime.length">
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

    export default {
        data: () => ({
            errors: [],
            full_list: [],
            filtered_list: [],
            shows: [],
            anime: [],
            search: '',
            fuse: {},
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
                console.log('triggering search');
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
            triggerSearch: function() {
                console.log("search triggered:" + this.search);
                let keyworks = this.search.trim();
                if (keyworks === '') {
                    this.filtered_list = this.full_list;
                } else {
                    this.filtered_list = this.fuse.search(keyworks);
                }
            }
        }
    }
</script>

<style lang="scss">
    .shows--list {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }

    //
</style>
