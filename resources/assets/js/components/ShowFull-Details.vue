<template>
    <div class="show-full-details row">
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
                <div class="show-full-details--detail-value">{{formatStatus(show.sub_use_sr_metadata)}}</div>
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
</template>
<script>
    import Filters from '../filters';

    export default {
        props: [
            'show',
        ],
        computed: {
            size() {
                return this.show.stats !== undefined ? this.show.stats.show_size : 0;
            }
        },
        filters: Filters,
        methods: {
            formatStatus(status) {
                return status
                    ? '✔'
                    : '✘';
            }
        }

    };
</script>
<style lang="scss">
    // Variables
    @import "../../sass/variables";
    @import "../../sass/helper";

    .show-full-details {
        min-height: 200px;
        margin: .25rem 0;
        padding: .5rem;
        background: $background-off-white;
        font-size: .9rem;

        display: table;
    }

    .show-full-details--detail {
        display: table-row;
        &:nth-child(odd) {
            background-color: $background-off-white-dark;
        }
    }

    .show-full-details--detail-label {
        padding-right: 2rem;
        display: table-cell;
        white-space: nowrap;
    }

    .show-full-details--detail-value {
        display: table-cell;
        width: 100%;
    }

</style>
