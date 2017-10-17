<template>
    <div>
        <span :class="{'sr-only': episode.quality.length}">{{statusText(episode.status)}}</span>
        <quality-pill :quality="quality" :key="quality.id" v-for="quality in episode.quality"></quality-pill>
    </div>
</template>

<script>
    import QualityPill from './QualityPill.vue';
    import StatusMixin from '../mixins/Status';

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
