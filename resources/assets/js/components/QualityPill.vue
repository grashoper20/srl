<template>
    <div>
        <div v-for="quality in qualities">{{getQualityText(quality)}}</div>
    </div>
</template>

<script type="javascript">
    import StatusMixin from '../mixins/Status';

    export default {
        methods: {
            getQualityText(quality) {
                return quality;
            },
        },
        props: [
            'qualities',
        ],
    };
</script>

<style lang="sass">
</style>