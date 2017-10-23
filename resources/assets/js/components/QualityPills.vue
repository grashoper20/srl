<template functional>
    <span class="quality-pills">
        <quality-pill v-if="props.simple && props.qualities.length > 1" :quality="{id: 0, quality: 'Custom'}"></quality-pill>
        <quality-pill v-else :quality="quality" :key="quality.id" v-for="quality in props.qualities"></quality-pill>
    </span>
</template>

<script type="javascript">
    export default {
        props: {
            qualities: Array,
            simple: {
                type: Boolean,
                default: false,
            }
        },
    };
</script>
