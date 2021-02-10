import { Books } from "./Books";
import { Genres } from "./Genres";
import { deepClone } from "../../common";

export class LibraryApi {
    constructor(baseApi) {
        this.books = new Books(deepClone(baseApi));
        this.genres = new Genres(deepClone(baseApi));
    }
}