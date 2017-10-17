<template>
    <div class="show-full-details container">
        <div class="row d-lg-none">
            <img class="show-full--banner" :src="getBanner(id)"/>
        </div>
        <div class="row">
            <div class="d-lg-block d-none col-3">
                <img v-on:click="showModal" class="show-full-details--poster-thumb" :src="getPosterThumbnail(id)"/>
                <modal name="full-poster" :height="'100%'">
                    <div class="show-full-details--poster" :style="{backgroundImage: 'url(' + getPoster(id) + ')'}">
                        <button @click="$modal.hide('full-poster')">❌</button>
                    </div>
                </modal>
            </div>
            <div class="show-full-details--info col">
                <header class="show-full-details--info-header">
                    <div>
                        <div>
                            {{imdb_info.rating}} {{imdb_info.countries}} ({{imdb_info.year}}) - {{imdb_info.runtimes}} minutes
                        </div>
                        <div class="show-full--genres">
                            <div class="show-full--genre" v-for="genre in genres">{{genre}}</div>
                        </div>
                    </div>
                    <img class="show-full-details--banner-thumb d-none d-lg-block" :src="getBannerThumbnail(id)"/>
                </header>

                <div class="show-full-details--details row">
                    <div class="col-8">
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Quality:</div>
                            <div class="show-full-details--detail-value">{{show.quality}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Airs:</div>
                            <div class="show-full-details--detail-value">{{show.airs}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Default Status:</div>
                            <div class="show-full-details--detail-value">{{show.default_ep_status}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Location:</div>
                            <div class="show-full-details--detail-value">{{show.location}}</div>
                        </div>
                        <div class="show-full-details--detail" v-if="show.exceptions">
                            <div class="show-full-details--detail-label">Scene Name:</div>
                            <div class="show-full-details--detail-value">{{show.exceptions}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Size:</div>
                            <div class="show-full-details--detail-value">{{size | formatBytes }}</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Language:</div>
                            <div class="show-full-details--detail-value">{{show.lang}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Subtitles:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(show.subtitles)}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Subtitle SR Metadata:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(show.sub_use_sr_metadata)}}
                            </div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Season Folders:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(!show.flatten_folders)}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Paused:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(show.paused)}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Air-by date:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(show.air_by_date)}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Sports:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(show.sports)}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Anime:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(show.anime)}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">DVD Order:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(show.dvdorder)}}</div>
                        </div>
                        <div class="show-full-details--detail">
                            <div class="show-full-details--detail-label">Scene Numbering:</div>
                            <div class="show-full-details--detail-value">{{formatStatus(show.scene)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import api from '../api';
    import Filters from '../filters';
    import FileCache from '../mixins/FileCache';

    export default {
        computed: {
            size() {
                return this.show.stats !== undefined ? this.show.stats.show_size : 0;
            },
            id() {
                return this.show.indexer_id;
            },
            genres: function () {
                if (typeof this.imdb_info.genres === 'undefined') {
                    return [];
                }
                return this.imdb_info.genres.split('|');
            },
            imdb_info() {
                if (typeof this.show.imdb_info === 'undefined') {
                    return {};
                }
                return this.show.imdb_info;
            }
        },
        created() {
        },
        data() {
            return {
//                imdb_info: {},
                errors: [],
            };
        },
        filters: Filters,
        methods: {
            formatStatus(status) {
                return status
                    ? '✔'
                    : '✘';
            },
            showModal() {
                this.$modal.show('full-poster');
            },
        },
        mixins: [FileCache,],
        props: [
            'show',
        ],
    };
</script>
<style lang="scss">
    // Variables
    @import "../../sass/variables";
    @import "../../sass/helper";

    .show-full-details {
        .v--modal-overlay {
            background-color: rgba(0, 0, 0, .75);
        }
    }

    .show-full-details--banner-thumb {
        max-height: 50px;
        border: 1px solid black;
    }

    .show-full--banner {
        width: 100%;
        border: 1px solid black;
    }

    .show-full-details--poster-thumb {
        width: 100%;
    }

    .show-full-details--poster {
        background: black no-repeat center center;
        background-size: contain;
        height: 100%;
        button {
            opacity: .5;
            transition: opacity 0.5s;
            position: absolute;
            right: 0;
        }
        &:hover button {
            opacity: 1;
        }
    }

    .show-full-details--info {
        .show-full-details--info-header {
            display: flex;
            justify-content: space-between;
            padding-bottom: 5px;
        }
    }

    .show-full-details--genre {
        display: inline-block;
        border-radius: 3px;
        background: #555;
        border: 1px solid #111;
        color: white;
        font-size: .8rem;
        padding: .2rem .25rem;
        margin-right: .5em;
        text-shadow: 1px 1px #000;
    }

    .show-full--genre {
        display: inline-block;
        border-radius: 3px;
        background: #555;
        border: 1px solid #111;
        color: white;
        font-size: .8rem;
        padding: .2rem .25rem;
        margin-right: .5em;
        text-shadow: 1px 1px #000;
    }

    .show-full-details--details {
        min-height: 200px;
        margin: .25rem 0 0 0;
        font-size: .9rem;
        & > div {
            padding: 0;
            background-color: $background-off-white;

        }
    }

    .show-full-details--detail {
        display: table-row;
        &:nth-child(odd) {
            background-color: $background-off-white-dark;
        }
    }

    .show-full-details--detail-label {
        padding: 0 .5em;
        display: table-cell;
        white-space: nowrap;
    }

    .show-full-details--detail-value {
        display: table-cell;
        width: 100%;
    }

</style>
