<template>
    <div id="content" class="container">
        <header class="shows--search">
            <div class="form-inline ">
                <label for="show-search" class="sr-only">Search</label>
                <input class="form-control mr-auto" id="show-search" type="search" v-on:input="debounceInput"
                       placeholder="Search">
                <div class="btn-group">
                    <div id="layout-select" class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Layout
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" @click.prevent="setShowLayout(1)" href="#">Tiles</a>
                            <a class="dropdown-item" @click.prevent="setShowLayout(2)" href="#">Table: Poster</a>
                            <a class="dropdown-item" @click.prevent="setShowLayout(3)" href="#">Table: Banner</a>
                            <a class="dropdown-item" @click.prevent="setShowLayout(4)" href="#">Table: Simple</a>
                        </div>
                    </div>
                    <button @click="toggleShow" :class="typeBtnClass('tv')">TV</button>
                    <button @click="toggleAnime" :class="typeBtnClass('anime')">Anime</button>
                </div>
            </div>
            <div class="form-inline input-group" v-show="getShowLayout === '1'">
                <label for="search-sort" class="input-group-addon">Sort</label>
                <select class="form-control custom-select" id="search-sort" :value="getShowSortField"
                        @input="updateSortField">
                    <option value="show_name">Name</option>
                    <option value="show_name">Next Episode</option>
                    <option value="network">Network</option>
                    <option value="progress">Progress</option>
                </select>
                <span class="input-group-btn"><button @click="toggleDirection" class="btn btn-secondary">
                    <icon-chevron-up v-show="getShowSortDescending == 1"></icon-chevron-up>
                    <icon-chevron-down v-show="getShowSortDescending == 2"></icon-chevron-down>
                </button></span>
            </div>
        </header>
        <div class="shows" v-if="shows && shows.length && showTypeShow">
            <h2>Shows</h2>
            <show-tiles v-if="getShowLayout == 1" :shows="shows"></show-tiles>
            <shows-table class="shows--poster" v-else :shows="shows" :layout="getShowLayout"></shows-table>
        </div>
        <div class="shows" v-if="anime && anime.length && showTypeAnime">
            <h2>Anime</h2>
            <show-tiles v-if="getShowLayout == 1" :shows="anime"></show-tiles>
            <shows-table class="shows--poster" v-else :shows="anime" :layout="getShowLayout"></shows-table>
        </div>
        <div class="shows" v-if="!showTypeShow && !showTypeAnime">
            No show types selected.
        </div>
        <ul v-if="errors && errors.length">
            <li v-for="error in errors">
                {{error.message}}
            </li>
        </ul>
    </div>
</template>

<script>
    import fuse from 'fuse.js';
    import * as _ from 'lodash';
    import {mapGetters, mapMutations} from 'vuex';
    import IconChevronUp from 'icons/chevron-up';
    import IconChevronDown from 'icons/chevron-down';
    import jQuery from 'jquery';
    import ShowTiles from '../Show-Tiles.vue';
    import ShowsTable from '../Shows--Table.vue';

    export default {
        components: {
            'show-tiles': ShowTiles,
            'shows-table': ShowsTable,
            'icon-chevron-up': IconChevronUp,
            'icon-chevron-down': IconChevronDown,
        },
        computed: {
            shows() {
                return this.filterShows(this.getShows.slice(), this.search, this.getShowSortField, this.getShowSortDescending);
            },
            anime() {
                return this.filterShows(this.getAnime.slice(), this.search, this.getShowSortField, this.getShowSortDescending);
            },
            ...mapGetters('shows', [
                'getAnime',
                'getShows',
            ]),
            ...mapGetters('settings', [
                'getShowSortField',
                'getShowSortDescending',
                'getShowLayout',
            ]),
        },
        data: () => ({
            search: '',
            showTypeShow: true,
            showTypeAnime: true,
            showType: 1,
            errors: [],
            fuse_options: {
                shouldSort: true,
                threshold: 0.2,
                location: 0,
                distance: 100,
                maxPatternLength: 32,
                minMatchCharLength: 1,
                keys: [
                    'show_name',
                ],
            },
        }),
        methods: {
            typeBtnClass(type) {
                let c = 'btn btn-secondary';
                if (type === 'tv') {
                    c += this.showTypeShow ? ' active' : '';
                }
                if (type === 'anime') {
                    c += this.showTypeAnime ? ' active' : '';
                }
                return c;
            },
            toggleShow() {
                this.showTypeShow = !this.showTypeShow;
            },
            toggleAnime() {
                this.showTypeAnime = !this.showTypeAnime;
            },
            toggleDirection() {
                this.setSortDescending(this.getShowSortDescending === '1' ? '2' : '1');
            },
            updateSortField(e) {
                this.setSetting({
                    key: 'sortField',
                    value: e.target.value,
                });
            },
            updateSortDescending(e) {
                this.setSortDescending(e.target.value);
            },
            setSortDescending(value) {
                this.setSetting({
                    key: 'sortDescending',
                    value: value,
                });
            },
            setShowLayout(value) {
                console.log(value);
                this.setSetting({
                    key: 'showLayout',
                    value: value.toString(),
                });

            },
            ...mapMutations('settings', {
                setSetting: 'setShowSetting',
            }),
            filterShows(list, search, sortField, direction) {
                sortField = sortField || 'show_name';
                direction = direction || 1;
                if (search) {
                    return (new fuse(list, this.fuse_options))
                        .search(search);
                }
                return this.sortHelper(list, sortField, direction - 1);
            },
            debounceInput: _.debounce(function (e) {
                this.search = e.target.value.trim();
            }, 250),
            sortHelper(list, field, descending) {
                try {
                    let isNumber = false;
                    list.forEach((x) => {
                        isNumber |= jQuery.isNumeric(x);
                    });
                    return list.sort(function (a, b) {
                        let comp_strings = [];
                        // Stringify.
                        [a[field], b[field]].forEach((x) => {
                            comp_strings.push((typeof x === 'undefined' || x === null)
                                ? ''
                                : x.toString());
                        });
                        // Compare.
                        let comparison = comp_strings[0]
                            .localeCompare(comp_strings[1], {numeric: isNumber});
                        // Apply direction.
                        return (descending ? comparison * -1 : comparison);
                    });
                }
                catch (e) {
                    console.error(e);
                    return [];
                }
            },
        },
        mounted() {
            this.$store.dispatch('shows/sync');
        },
    }
</script>

<style lang="scss">
    #layout-select {
        border-right: 2px solid #666;
    }

    .shows {
        .table td {
            vertical-align: middle;
        }
    }

    .shows--poster {
        img {
            height: 66px;
        }
    }

    .shows--search {
        .form-inline {
            margin: 10px 0;
        }
    }

</style>
