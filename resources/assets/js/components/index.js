import Banner from './Banner.vue';
import EpisodeStatus from './EpisodeStatus.vue';
import EpisodeTile from './Episode-Tile.vue';
import EpisodeTiles from './Episode-Tiles.vue';
import HeadNav from './Headnav.vue';
import Poster from './Poster.vue';
import ProgressBar from './ProgressBar.vue';
import QualityPill from './QualityPill.vue';
import QualityPills from './QualityPills.vue';
import ShowTile from './Show-Tile.vue';
import ShowTiles from './Show-Tiles.vue';
import Vue from 'vue';

Vue.component('banner', Banner);
Vue.component('episode-status', EpisodeStatus);
Vue.component('episode-tile', EpisodeTile);
Vue.component('episode-tiles', EpisodeTiles);
Vue.component('head-nav', HeadNav);
Vue.component('poster', Poster);
Vue.component('progress-bar', ProgressBar);
Vue.component('quality-pill', QualityPill);
Vue.component('quality-pills', QualityPills);
Vue.component('show-tile', ShowTile);
Vue.component('show-tiles', ShowTiles);

export default {
    Banner,
    EpisodeStatus,
    EpisodeTile,
    EpisodeTiles,
    HeadNav,
    Poster,
    ProgressBar,
    QualityPill,
    QualityPills,
    ShowTile,
    ShowTiles,
}

