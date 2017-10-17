
export default {
    methods: {
        ensureState(state) {
            return state > 100 ? (state % 100) : state;
        },

        statusClass(state) {
            state = this.ensureState(state);
            switch (state) {
                case 1:
                    return 'status-unaired';
                case 2:
                case 9:
                case 12:
                    return 'status-snatched';
                case 3:
                    return 'status-wanted';
                case 4:
                    return 'status-good';
                case 5:
                case 7:
                    return 'status-skipped';
                case 6:
                    return 'status-archived';
                case 50:
                    return 'status-qual';
            }
            console.warn('Unhandled state class: ' + state);
            return 'status-weird-' + state;
        },
        statusText(state) {
            state = this.ensureState(state);
            switch (state) {
                case 1:
                    return 'Unaired';
                case 2:
                case 9:
                case 12:
                    return 'Snatched';
                case 3:
                    return 'Wanted';
                case 4:
                    return 'Downloaded';
                case 5:
                    return 'Skipped';
                case 6:
                    return 'Archived';
                case 7:
                    return 'Ignored';
                case 50:
                    return 'qual';
            }
            console.warn('Unhandled state text: ' + state);
            return 'weird-' + state;
        },
    }
}