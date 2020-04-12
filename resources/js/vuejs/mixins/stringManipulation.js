
export function install(Vue, options) {

    /**
     * Changes the first letter to upper-case.
     *
     * @return String
     */
    Vue.filter('ucfirst',
        function(word)
        {
            return word.charAt(0).toUpperCase() + word.slice(1);
        }
    );

    /**
     * Converts a variable to a string.
     *
     * @return String
     */
    Vue.filter('toString',
        function(input)
        {
            return String(input);
        }
    );

}
