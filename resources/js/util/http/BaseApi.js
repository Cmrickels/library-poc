export class BaseApi {

    constructor(baseUrl, timeout, auth, content = 'json') {
        let config = {
            baseURL: baseUrl,
            timeout: timeout
        }
        if (content == 'json') {
            config.headers = {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        } else {
            config.headers = {
                'Accept': 'text/html',
                'Content-Type': 'text/html'
            }            
        }
        if(auth && auth.scheme, auth.token) {
            config.headers = {
                ...config.headers,
                'Authentication': `${auth.schema} ${auth.token}`
            }
        }
        this.config = config;
    }
}