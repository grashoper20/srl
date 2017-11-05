<template>
    <nav class="main navbar navbar-expand-sm navbar-static-top navbar-dark">
        <router-link :to="{name: 'show_list'}" class="navbar-brand">SRL</router-link>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <router-link :to="{name: 'show_list'}" class="nav-link">Shows</router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{name: 'schedule'}" class="nav-link">Schedule</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/history" class="nav-link">History</router-link>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link dropdown-toggle" id="dropdown02" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" href="#">Manage</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown02">
                        <li class="dropdown-item">
                            <router-link :to="{name: 'manage_update'}">Mass update</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link :to="{name: 'manage_process'}">Manually process shows</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link :to="{name: 'manage_backlog'}">Backlog overview</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link :to="{name: 'manage_search'}">Searches</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link :to="{name: 'manage_episodes'}">Episode management</router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link"><icon-settings></icon-settings></a></li>
                <li class="nav-item"><a class="nav-link"><icon-wrench></icon-wrench></a></li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import IconSettings from 'icons/settings';
    import IconWrench from 'icons/wrench';
    export default {
        components: {
            'icon-settings': IconSettings,
            'icon-wrench': IconWrench,
        },
        mounted() {
//            console.log('HEAD!')
        }
    }
</script>

<style lang="scss">
    $height: 50px;
    $background-light: #444;
    $background-dark: #333;

    @import "~material-shadows/material-shadows";

    nav.main {
        min-height: $height;
        color: white;
        background: $background-light;
        margin-bottom: .5rem;
        border-bottom: 1px solid $background-dark;

        .navbar-toggler {
            padding: .25em .5em;
        }
        .navbar-toggler-icon {
            height: 1em;
            width: 1em;
        }
        #mainNavbar,
        .navbar-brand {
            line-height: $height;
        }
        .navbar-brand {
            font-size: 2.0rem;
        }
        .nav-item {
            & > a:hover {
                @include z-depth-2dp();
            }
            .dropdown-toggle,
            & a.nav-link {
                transition: box-shadow 500ms;
                display: inline-block;
                padding: 0 15px;
            }
            & > .router-link-active {
                background: $background-dark;
            }
        }
        .dropdown-menu {
            margin: 0;
            left: auto;
            right: 0;

            li {
                padding: 0;
            }
            a {
                display: block;
                padding: 0.25rem 1.5rem;
                color: $background-dark;
            }
        }
    }

</style>
