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
                <div class="show-full-details--detail-value">{{size}}</div>
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
    export default {
        props: [
            'show',
        ],
        computed: {
            size() {
                let size = 0;
                if (this.show.stats !== undefined) {
                    size = this.show.stats.show_size;
                }
                return this.formatBytes(size);
            }
        },
        methods: {
            // https://stackoverflow.com/a/18650828.
            formatBytes(bytes, decimals) {
                if (bytes == 0) return '0 Bytes';
                let k = 1024,
                    dm = decimals || 2,
                    sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                    i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
            },
            formatStatus(status) {
                return status
                    ? '✔'
                    : '✘';
                return status;
            }
        }

    };
</script>
<style lang="scss">
    .show-full-details {
        min-height: 200px;
        margin: .25rem 0;
        padding: .5rem;
        background: #efefef;
        font-size: .9rem;

        display: table;
    }

    .show-full-details--detail {
        display: table-row;
        &:nth-child(odd) {
            background-color: #ccc;
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
