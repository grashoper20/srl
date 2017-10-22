<template>
    <span class="quality-pills">
        <quality-pill :quality="quality" :key="quality.id" v-for="quality in getQualities"></quality-pill>
    </span>
</template>

<script type="javascript">
    import QualityPill from "./QualityPill.vue";

    export default {
        components: {
            'quality-pill': QualityPill,
        },
        computed: {
            getQualities() {
                if (this.simple && this.qualities.length > 1) {
                    return [{id: 0, quality: 'Custom'}];
                }
                return this.qualities;
            }
        },
        options: {
            name: 'quality-pills',
        },
        props: {
            'qualities': Array,
            simple: {
                type: Boolean,
                default: false,
            }
        },
    };
</script>

<style lang="scss">
</style>
