<template>
    <div class="show-full-details row">
        <div class="col-8">
            <div>Quality:</div>
            <div>Airs:</div>
            <div>Episode Status:</div>
            <div>Location:</div>
            <div>Scene Name:</div>
            <div>Size:</div>
        </div>
        <div class="col-4">
            <div>Language: </div>
            <div>Subtitles: </div>
            <div>Metadata: </div>
            <div>Season Folders: </div>
            <div>Paused: </div>
            <div>Air-by date: </div>
            <div>Sports: </div>
            <div>Anime: </div>
            <div>DVD Order: </div>
            <div>Scene Numbering: </div>
        </div>
    </div>
</template>
<script>
    export default {
        params: [
            'show',
        ],
        data: () => ({
            id: 0,
            imdb_info: {},
            episodes: [],
            errors: [],
        }),
    };
</script>
<style lang="scss">
    .show-full-details {
        min-height: 200px;
        margin: .25rem 0;
        padding: .5rem;
        background: #efefef;
        font-size: .9rem;
    }

</style>
