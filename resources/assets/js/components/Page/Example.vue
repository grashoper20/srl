<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Placeholder {{route}}</div>

                    <div class="panel-body">
                        Placeholder content for pages that haven't been created yet.
                    </div>
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        computed: {
            route: function() {
                return this.$route.path;
            }
        }
    }
</script>
