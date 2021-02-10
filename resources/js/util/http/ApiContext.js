import { BaseApi } from './BaseApi';
import { LibraryApi } from './Library/LibraryApi';

class ApiContext 
{
    constructor() {
        this.libraryBase = new BaseApi(
            '/api',
            1000,
            false
        );
        this.library = new LibraryApi(this.libraryBase);
    }
}

let context = new ApiContext();
export default context;