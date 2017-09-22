<template>
    <div id="content" class="container">
        <div class="shows">
            <h2>Shows</h2>
            <div class="shows--list">
                <show v-for="show in shows" v-bind:show="show"></show>
            </div>
        </div>
        <div class="anime" v-if="anime && anime.length">
            <h2>Anime</h2>
            <div class="shows--list">
                <show v-for="show in anime" v-bind:show="show"></show>
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

    export default {
        data: () => ({
            shows: [],
            anime: [],
            errors: []
        }),
        created() {
            axios.get('/api/show')
                .then(response => {
                    let self = this;
                    response.data.forEach(function (fetched_show) {
                        if (parseInt(fetched_show.anime)) {
                            self.anime.push(fetched_show);
                        }
                        else {
                            self.shows.push(fetched_show);
                        }
                    });
                })
                .catch(e => {
                    this.errors.push(e)
                })
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
