<template>
    <div class="show-full">
        <div class="container">
            <header class="show-full--head">
                <h1>{{show.show_name}}</h1>
                <div class="show-full--seasons">Seasons: <a>1</a>|<a>2</a></div>
            </header>
            <div class="row">
                <div class="col">
                    <img class="show-full--poster" style="width:100%" :src="poster"/>
                </div>
                <div class="show-full--info col-9">
                    <header class="show-full--info-header">
                        <div>
                            <div>{{imdb_info.rating}} {{imdb_info.countries}} ({{imdb_info.year}}) - {{imdb_info.runtimes}} minutes</div>
                            <div>{{imdb_info.genres}}</div>
                        </div>
                        <img style="max-height: 50px; border: 1px solid black;" :src="bannerThumbnail"/>
                    </header>
                    <div class="show-full--details row" style="height: 200px">
                        <div class="col-8">first details</div>
                        <div class="col-4">second details</div>
                    </div>
                </div>
            </div>
            <div class="show-full--episode-list">
                <h4>Episode list</h4>
            </div>
        </div>
        <div class="show-full--backdrop" :style="{backgroundImage: 'url(' + getBackgroundImage + ')'}"></div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: () => ({
            id: 0,
            show: {},
            imdb_info: {},
        }),
        created() {
            this.id = this.$route.params.id;
            axios.get('/api/show/' + this.id)
                .then(response => {
                    this.show = response.data;
                    axios.get('/api/imdb/' + this.show.indexer_id)
                        .then(response => {
                            this.imdb_info = response.data;
                        })
                        .catch(e => {
                            console.log(e);
                            this.errors.push(e)
                        });
                })
                .catch(e => {
                    console.log(e);
                    this.errors.push(e)
                });
        },
        computed: {
            getBackgroundImage: function () {
                if (typeof this.show.indexer_id === 'undefined') {
                    return '';
                }
                return '/filecache/poster/' + this.show.indexer_id + '/fanart';
            },
            poster: function () {
                return '/filecache/poster/' + this.show.indexer_id + '/poster/thumbnail';
            },
            banner: function () {
                return '/filecache/poster/' + this.show.indexer_id + '/banner';
            },
            bannerThumbnail: function () {
                return '/filecache/poster/' + this.show.indexer_id + '/banner/thumbnail';
            },
        },
        mounted() {
            console.log('show');
        }
    }
</script>
<style lang="scss">
    .show-full--poster {
        width: 100%;
    }

    .show-full--head {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #888;
        padding-bottom: .5rem;
        margin-bottom: 1rem;
        h1 {
            margin: 0;
        }
    }

    .show-full--seasons {
        align-self: flex-end;
    }

    .show-full--info {
        .show-full--info-header {
            display: flex;
            justify-content: space-between;
        }
        .show-full--details {
            margin: .25rem 0;
            padding: .5rem;
            background: #efefef;
        }
    }

    .show-full--episode-list {
        margin: .5rem 0;
    }

    .show-full--backdrop {
        position: fixed;
        top: 0;
        z-index: -9999;
        height: 100vh;
        width: 100%;
        opacity: 0.4;
        background: no-repeat center center fixed;
        background-size: cover;
    }
</style>
