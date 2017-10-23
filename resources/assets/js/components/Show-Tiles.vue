<template functional>
    <div class="show-tiles">
        <show-tile v-for="show in props.shows" :key="show.show_id" :show="show"></show-tile>
    </div>
</template>

<script>
    export default {
        props: [
            'shows',
        ],
    };
</script>

<style lang="scss">
    .show-tiles {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }
</style>
