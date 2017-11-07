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
                    <a class="nav-link dropdown-toggle" id="dropdown-manage" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" href="#">Manage</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-manage">
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
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link dropdown-toggle" id="dropdown-settings" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" href="#">
                        <icon-settings></icon-settings>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-settings">
                        <li class="dropdown-item">
                            <a href="#">
                                <icon-settings></icon-settings>
                                General</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <icon-search></icon-search>
                                Search Settings</a>
                        </li>
                        <li class="dropdown-item">
                            <a href="#">
                                <icon-provider></icon-provider>
                                Provider Settings</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link dropdown-toggle" id="dropdown-x" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" href="#">
                        <icon-wrench></icon-wrench>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-x">
                        <li class="dropdown-item">
                            <a href="#">Tools TBD</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import IconSettings from 'icons/settings';
    import IconWrench from 'icons/wrench';
    import IconSearch from 'icons/magnify';
    import IconProvider from 'icons/power-plug';

    export default {
        components: {
            'icon-settings': IconSettings,
            'icon-wrench': IconWrench,
            'icon-search': IconSearch,
            'icon-provider': IconProvider,
        },
    }
</script>

<style lang="scss">
    $height: 50px;
    $background-light: #444;
    $background-dark: #333;
    $dropdown-background: #F5F1E4;

    @import "../../sass/helper";
    @import "~material-shadows/material-shadows";

    @include media-breakpoint-up(sm) {
        nav.main {
            .dropdown-menu:after {
                position: absolute;
                top: -12px;
                right: 12px;
                display: inline-block;
                border: 6px solid transparent;
                border-bottom-color: $dropdown-background;
                content: "";
            }

            .dropdown-hover:hover > .dropdown-menu {
                display: block;
            }
        }
    }

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
            background-color: $dropdown-background;

            li {
                padding: 0;
            }
            a {
                display: block;
                padding: 0.25rem 1.5rem;
                color: $background-dark;
            }
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background-color: $dropdown-background;
        }
    }

</style>
