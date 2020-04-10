
const langCodes = {
    AUD: 'en-AU',
    JPY: 'ja-JP',
    NZD: 'en-NZ',
    GBP: 'en-GB',
    USD: 'en-US',
};

export function install(Vue, options) {
    /**
     * Formats a string to the correct currency format for the language code.
     *
     * @param value Amount to be formatted according to the currency
     * @param currencyCode Must be an official (ISO 4217) currency code
     * @see https://en.wikipedia.org/wiki/ISO_4217
     * @see http://www.lingoes.net/en/translator/langcode.htm
     */
    Vue.filter('toCurrency',
        function(value, currencyCode)
        {
            currencyCode =  currencyCode || options.currencyCode || 'AUD';

            return Intl.NumberFormat(langCodes[ currencyCode.toUpperCase() ], {
                style: 'currency',
                currency: currencyCode,
                minimumFractionDigits: 2,
            }).format( value );
        }
    );

}
