

/**
 * Attaches to the string prototype to upper case the first word.
 *
 * eg, Assign to String.prototype.ucfirst
 *
 * @returns {string}
 */
function ucfirst() {
    return this.charAt(0).toUpperCase() + this.slice(1)
}


/**
 * Attaches to the string prototype to upper case the all words.
 *
 * eg, Assign to String.prototype.ucwords
 *
 * @returns {string}
 */
function ucwords() {
    return this.split(' ').map(s => s.ucfirst()).join(' ')
}


/**
 * Creates an array filled with numbers up to _length_.
 * A mapping function can be passed to modify the array values
 * and the initial value can be determined via _startFrom_.
 *
 * @url https://stackoverflow.com/questions/3746725/how-to-create-an-array-containing-1-n
 * @param length
 * @param f
 * @param startFrom
 * @returns {Array}
 */
function range(length, f = f => f, startFrom = 0) {
    if (arguments.length === 2 && typeof f !== 'function') {
        startFrom = f;
        f = (f => f)
    }
    return [ ...Array(length).keys() ].splice(startFrom).map((_, i) => f(_))
}


export {
    ucfirst,
    ucwords,
    range
}
