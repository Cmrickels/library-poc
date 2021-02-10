import { Entity } from '../Entity';

export class Genres extends Entity
{
    constructor(baseApi) {
        super(baseApi, 'genres');
    }

    async getAll() { 
        return await this.instance.get('/'); 
    }

    async getBooks(genre_id) {
        return await this.instance.get(`/${genre_id}/books`);
    }
}