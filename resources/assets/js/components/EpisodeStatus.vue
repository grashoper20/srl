<template>
    <div>
        <span :class="{'sr-only': episode.quality.length}">{{statusText(episode.status)}}</span>
        <quality-pills :qualities="episode.quality"></quality-pills>
    </div>
</template>

<script>
    import QualityPills from './QualityPills.vue';
    import StatusMixin from '../mixins/Status';

    export default {
        components: {
            QualityPills,
        },
        mixins: [
            StatusMixin,
        ],
        props: [
            'episode',
        ],
    }
</script>
