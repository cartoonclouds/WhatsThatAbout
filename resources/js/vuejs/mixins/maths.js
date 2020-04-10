
export function install(Vue, options) {

    /**
     * Returns a nicely formatted (with correct group separators) number.
     *
     * @return String
     */
    Vue.filter('formatNumber',
        function(value, fraction)
        {
            fraction = fraction || 0;

            return Intl.NumberFormat('en-AU', {
                notation: 'decimal',
                minimumFractionDigits: fraction,
            }).format( value );
        }
    );

    /**
     * Converts a string (with invalid numeric characters) back into a number.
     *
     * @return Number
     */
    Vue.filter('toNumber',
        function(value)
        {
            return parseFloat( value.toString().replace(/([^\d.-])/g, '') );
        }
    );

}
