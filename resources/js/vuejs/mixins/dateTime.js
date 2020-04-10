
import moment from 'moment';

export function install(Vue, options) {

    /**
     * Returns a time string/moment in the format HH:mm:ss (default).
     *
     * @return string
     */
    Vue.filter('formatTime',
        function(datetime, format)
        {
            try {
                var dateValue = moment(datetime);
            } catch(e) {
                console.log(e);
                return '';
            }

            const defaultFormat = options.defaultTimeFormat || 'HH:mm:ss';

            if (dateValue.isValid()) {
                return dateValue.format(format || defaultFormat);
            }

            return '';
        }
    );

    /**
     * Returns a date string/moment instance in the format DD-MM-YYYY (default).
     *
     * @return string
     */
    Vue.filter('formatDate',
        function(datetime, format)
        {
            try {
                var dateValue = moment(datetime);
            } catch(e) {
                console.log(e);
                return '';
            }

            const defaultFormat = options.defaultDateFormat || 'DD-MM-YYYY';

            if (dateValue.isValid()) {
                return dateValue.format(format || defaultFormat);
            }

            return '';
        }
    );

}
