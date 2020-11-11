
// Strings ==================================================================

String.prototype.ucfirst = function() {
    return this.charAt(0).toUpperCase() + this.slice(1)
}


String.prototype.ucwords = function() {
    return this.split(' ').map(s => s.ucfirst()).join(' ')
}


