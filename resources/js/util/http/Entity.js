import axios from 'axios';

export class Entity {
    constructor(baseApi, uri) {
        console.log("BASEAPI, SUBURL", baseApi, uri);
        baseApi.config.baseURL = `${baseApi.config.baseURL}/${uri}`;
        console.log("BASE API AFTER", baseApi);

        this.instance = axios.create(baseApi.config);
    }
}