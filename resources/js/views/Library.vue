<template>
    <div>
        <h2>Genres</h2>
        <div class="genre-wrapper">
            <md-card class="genre-item" :key="Math.random()" v-for="(genre, index) in genres">
                <md-card-header>
                    {{ genre.label }}
                </md-card-header>
                
                <md-card-content>
                    
                </md-card-content>     

                <md-card-actions>
                    <router-link :to="{ name: 'genre', params: { genre_id: genre.id, genre_name: genre.label } }">
                        <md-button>View</md-button>
                    </router-link>
                </md-card-actions>               
            </md-card>
        </div>
    </div>
</template>
<script>
    const default_layout = "default";
    import context from '../util/http/ApiContext';

    export default {
        async mounted() {
            let {data: genres} = await context.library.genres.getAll();
            this.genres = genres;
        },
        data() {
            return {
                genres: []
            }
        }
    }
</script>
<style scoped>    
    .genre-wrapper {
        display: flex;
        flex-direction: row;
    }
    .genre-item {
        flex: 3;
        max-width: 250px;
        margin: 20px 10px;
    }
</style>

