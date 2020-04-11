/**
 * Create a global application instance for site javascript.
 */
export default class {
    constructor({id, name, username, email}) {
        this.version = '1.0.0';
        this.id = id;
        this.name = name;
        this.username = username;
        this.email = email;
    }
}

