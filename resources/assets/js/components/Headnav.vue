<template>
    <nav class="main navbar navbar-expand-md navbar-static-top navbar-dark">
        <router-link :to="{name: 'show_list'}" class="navbar-brand">SRL</router-link>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" href="#">Shows</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <li class="dropdown-item">
                            <router-link :to="{name: 'show_list'}">List shows</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link :to="{name: 'show_add'}">Add show</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link :to="{name: 'show_process'}">Manually process shows</router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <router-link to="/schedule" class="nav-link">Schedule</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/history" class="nav-link">History</router-link>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link dropdown-toggle" id="dropdown02" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" href="#">Manage</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown02">
                        <li class="dropdown-item">
                            <router-link to="/manage">Mass update</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link to="/manage/backlog">Backlog overview</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link to="/manage/search">Searches</router-link>
                        </li>
                        <li class="dropdown-item">
                            <router-link to="/manage/episodes">Episode management</router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link">Gear</a></li>
                <li class="nav-item"><a class="nav-link">Toolbox</a></li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
//            console.log('HEAD!')
        }
    }
</script>

<style lang="scss">
    $height: 50px;
    $background-light: #555;
    $background-dark: #333;

    nav.main {
        min-height: $height;
        color: white;
        background: $background-light linear-gradient($background-light, $background-dark);
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
            .dropdown-toggle,
            & > a {
                display: inline-block;
                padding: 0 10px;
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
