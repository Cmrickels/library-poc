<template>
    <div>        
        <h2>{{ title }}</h2>
 
        <draggable class="book-items-wrapper" v-if="books.length" v-model="books" :sort="true" @change="updateOrder" @start="dragging=true" @end="dragging=false">
            <md-card class="book-wrapper" v-for="(book, index) in books">
                <md-card-header>
                    {{ book.title }}
                </md-card-header>
                
                <md-card-content>
                    Author: {{ book.author }}
                </md-card-content>     

                <md-card-actions>
                    <md-button @click="showBookDetail(book)">View</md-button>
                    <md-button class="md-accent" @click="deleteBook(book.id, index)">Delete</md-button>
                </md-card-actions>               
            </md-card>
        </draggable>

        <div class="action-pane">
            <md-button class="md-raised md-primary add-book-btn" @click="showCreateDialog = true">Add Book</md-button>
        </div>

        <!-- MODALS -->    

        <md-dialog v-if="activeBook" :md-active.sync="showDialog">
            <md-dialog-title>{{ activeBook.title }}</md-dialog-title>
            <md-dialog-content>
                <p>
                    <b>Description:</b> {{ activeBook.description }}
                </p>
                <p>
                    <b>Author:</b> {{ activeBook.author }}
                </p>
                <p>
                    <b>ISBN:</b> {{ activeBook.isbn }}
                </p>
            </md-dialog-content>
            <md-dialog-actions>
                <md-button class="md-primary" @click="showDialog = false">Close</md-button>                
            </md-dialog-actions> 
        </md-dialog>

        <md-dialog :md-active.sync="showCreateDialog">
            <md-dialog-title>Create New Book</md-dialog-title>
            
            <form novalidate class=" new-book-dialog" @submit.prevent="validateBook">
                <md-field :class="getValidationClass('title')">
                    <label for="book-title">Title</label>
                    <md-input name="book-title" id="book-title-field" v-model="newbook.title" :disabled="sending" />
                    <span class="md-error" v-if="!$v.newbook.title.required">The title is required</span>
                    <span class="md-error" v-else-if="!$v.newbook.title.minlength">Invalid title</span>
                </md-field>
                <md-field :class="getValidationClass('description')">
                    <label for="book-description">Description</label>
                    <md-input name="book-description" id="book-title-description" v-model="newbook.description" :disabled="sending" />
                    <span class="md-error" v-if="!$v.newbook.description.required">The description is required</span>
                    <span class="md-error" v-else-if="!$v.newbook.description.minlength">Invalid description</span>
                </md-field>
                <md-field :class="getValidationClass('author')">
                    <label for="book-author">Author</label>
                    <md-input name="book-author" id="book-title-author" v-model="newbook.author" :disabled="sending" />
                    <span class="md-error" v-if="!$v.newbook.author.required">The author is required</span>
                    <span class="md-error" v-else-if="!$v.newbook.author.minlength">Invalid author</span>
                </md-field>
                <md-field :class="getValidationClass('isbn')">
                    <label for="book-isbn">ISBN</label>
                    <md-input name="book-isbn" id="book-title-isbn" v-model="newbook.isbn" :disabled="sending" />
                    <span class="md-error" v-if="!$v.newbook.isbn.required">The isbn is required</span>
                    <span class="md-error" v-else-if="!$v.newbook.isbn.minlength">Invalid isbn</span>
                </md-field>                       
                <md-dialog-actions>
                    <md-button type="submitBook" class="md-primary" :disabled="sending">Create Book</md-button>
                    <md-button class="md-primary" @click="showCreateDialog = false">Close</md-button>                
                </md-dialog-actions> 
            </form>

        </md-dialog>

        <!-- end modals -->
    </div>
</template>
<script>
    const default_layout = "default";
    import context from '../util/http/ApiContext';
    import { validationMixin } from 'vuelidate'
    import {
        required,
        email,
        minLength,
        maxLength
    } from 'vuelidate/lib/validators';
  import draggable from 'vuedraggable';
  import { deepClone } from '../util/common';


    export default {
        mixins: [validationMixin],
        components: {
            draggable
        },
        async mounted() {
            await this.getBooks();
        },
        data() {
            return {
                title: this.$route.params.genre_name,
                books: [],
                showDialog: false,
                showCreateDialog: false,
                activeBook: null,
                
                newbook: {
                    title: null,
                    description: null,
                    isbn: null,
                    author: null,
                    genres_id: this.$route.params.genre_id
                },
                sending: false
            }
        },
        methods: {
            getBooks: async function() {
                let genre_id = this.$route.params.genre_id;
                let {data: books} = await context.library.genres.getBooks(genre_id);
                this.setBooks(books);
            },
            setBooks: function(books) {
                let compareIndexFound = (a, b) => {
                    if (a.order < b.order) { return -1; }
                    if (a.order > b.order) { return 1; }
                    return 0;
                }
                console.log('books before sorting', books, this.books);
                books.sort(compareIndexFound);
                this.books = deepClone(books);
                console.log('books after sorting', books, this.books);
            },
            showBookDetail: function(book) {
                this.activeBook = book;
                this.showDialog = true;
            },
            deleteBook: async function(id, index) {
                let { data: success } = await context.library.books.deleteOne(id);
                if (success) {
                    this.books.splice(index, 1);
                }
            },
            getValidationClass: function(fieldName) {
                const field = this.$v.newbook[fieldName]

                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            },
            submitBook: function() {
                this.validateBook();
            },
            validateBook: async function() {
                this.$v.$touch();

                if (!this.$v.$invalid) {
                    let {data: createdBook} = await context.library.books.create(this.newbook);
                    this.books.push(createdBook);
                    this.setBooks(this.books);
                }
            },
            updateOrder: async function(e) {
                let idOrderPairs = {};
                this.books.forEach((book, index) => {
                    console.log("BOOK AND INDEX", book.id, book.title, index + 1);
                    idOrderPairs[book.id] = index + 1;
                });
                console.log("NEW PAIRS", idOrderPairs);
                let {data:booksResponse} = await context.library.books.reorder(idOrderPairs); 
            }
        },
        validations: {
            newbook: {
                title: {
                    required,
                    minLength: minLength(3)
                },
                description: {
                    required,
                    minLength: minLength(3)
                },
                isbn: {
                    required,
                    minLength: minLength(3)
                },
                author: {
                    required,
                    minLength: minLength(3)
                },            
            }
        }
    }
</script>
<style scoped>
    .book-items-wrapper {
        border: '1px grey solid';
        

        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .book-wrapper {
        flex: 3;
        margin: 10px 10px;
        cursor: grab;
        max-width: 210px;
    }

    .action-pane {
        padding: 0 10px;
    }

    .add-book-btn {
        margin: 0 auto;
    }

    .new-book-dialog {
        padding: 30px;
    }
</style>