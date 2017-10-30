import moment from 'moment';
import Status from '../mixins/Status';

function toNormalizedDigits(num, size) {
    return ('0000' + num).slice(-size);
}

function formatDate(d, f) {
    if (d === '') {
        return '';
    }
    if (d === '1') {
        return 'Never';
    }
    return moment(d).format(f);
}

export default {
    // https://stackoverflow.com/a/18650828.
    formatBytes(bytes, decimals) {
        if (bytes === '0' || bytes === 0) return '0 Bytes';
        let k = 1024,
            dm = decimals || 2,
            sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
            i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    },
    formatAirDate(date) {
        return formatDate(date, 'YYYY-MM-DD h:mm:ss a');
    },
    formatIsoDate(date) {
        return moment(date).toISOString();
    },
    formatDate(date, format) {
        return formatDate(date, format);
    },
    formatSeasonEpisode(episode, season_size, episode_size) {
        season_size = season_size || Math.max(2, episode.season.toString().length);
        episode_size = episode_size || Math.max(2, episode.episode.toString().length);
        return 'S' + toNormalizedDigits(episode.season, season_size)
            + 'E' + toNormalizedDigits(episode.episode, episode_size);
    },
    formatStatus(status) {
        return status
            ? '✔'
            : '✘';
    },
    formatStatusText(status) {
        return Status.methods.statusText(status);
    }
}
