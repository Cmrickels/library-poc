import { Entity } from '../Entity';

export class Books extends Entity
{
    constructor(baseApi) {
        super(baseApi, 'books');
    }

    async getAll() { 
        return await this.instance.get('/'); 
    }

    async getByGenre(genre_id) {
        return await this.instance.get(`/genre/${genre_id}`);
    }

    async deleteOne(book_id) {
        return await this.instance.delete(`/${book_id}`);
    }

    async create(book) {
        return await this.instance.post('/', book);
    }

    async reorder(idOrderPairs) {
        return await this.instance.put('/', idOrderPairs);
    }
}