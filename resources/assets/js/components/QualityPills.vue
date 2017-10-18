<template>
    <span class="quality-pills">
        <quality-pill :quality="quality" :key="quality.id" v-for="quality in qualities"></quality-pill>
    </span>
</template>

<script type="javascript">
    import QualityPill from "./QualityPill.vue";

    export default {
        components: {
            'quality-pill': QualityPill,
        },
        props: [
            'qualities',
        ],
    };
</script>

<style lang="scss">
</style>
