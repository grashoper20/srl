import moment from 'moment';

function toNormalizedDigits(num, size) {
    return ('0000' + num).slice(-size);
}

export default {
    // https://stackoverflow.com/a/18650828.
    formatBytes(bytes, decimals) {
        if (bytes == 0) return '0 Bytes';
        let k = 1024,
            dm = decimals || 2,
            sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
            i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    },
    formatAirDate(date) {
        if (date === '1') {
            return 'Never';
        }
        return moment(date).format('YYYY-MM-DD h:mm:ss a');
    },
    formatSeasonEpisode(episode, season_size, episode_size) {
        season_size = season_size || Math.max(2, episode.season.toString().length);
        episode_size = episode_size || Math.max(2, episode.episode.toString().length);
        return 'S' + toNormalizedDigits(episode.season, season_size)
            + 'E' + toNormalizedDigits(episode.episode, episode_size);
    }
}