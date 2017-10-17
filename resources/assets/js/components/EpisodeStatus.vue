<template>
    <div>
        <span class="sr-only">{{statusText(episode.status)}}</span>
        <quality-pill :quality="quality" :key="quality.id" v-for="quality in episode.quality"></quality-pill>
    </div>
</template>

<script>
    import QualityPill from './QualityPill.vue';
    import StatusMixin from '../mixins/Status';

    // TODO it would be nice if status text was sr-only when there is a quality and visible otherwise...
    export default {
        components: {
            'quality-pill': QualityPill,
        },
        mixins: [
            StatusMixin,
        ],
        props: [
            'episode',
        ],
    }
</script>

<style lang="sass">
</style>
