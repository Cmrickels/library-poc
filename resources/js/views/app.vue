<template>
    <div>
        <md-toolbar class="md-primary" md-elevation="1">
            <h3 class="md-title" style="flex: 1">Library</h3>
            <router-link :to="{ name: 'library'}">
                <md-button class="md-primary">                
                    Genres
                </md-button>            
            </router-link>
        </md-toolbar>

        <div class="container">            
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    const default_layout = "default";


    export default {
    
    };
</script>
<style>
    .container{
        padding: 10px;
    }
</style>