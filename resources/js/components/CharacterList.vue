<template>
    <div class="container">
        
        <div class="row">

            <div class="col-md-4" v-for="character in characters" :key="character.id">
                <div class="card mb-4">
                    <img :src="character.image" class="card-img-top" :alt="character.name">
                    <div class="card-body">
                        <p class="card-title">{{ character.name }}</p>
                        <p class="card-text">Status: {{ character.status }}</p>
                        <p class="card-text">Species: {{ character.species }}</p>
                        <p class="card-text">Gender: {{ character.gender }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center" v-if="loading">
            <p>Loading...</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {

    data() {
        return {
            characters: [],
            loading: false,
            page: 1,
            perPage: 5
        };
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
    },

    computed() {

    },

    methods: {
        loadCharacters() {
            if (this.loading) return;
            this.loading = true;

            axios.get('/api/characters', {
                params: {
                    page: this.page,
                    perPage: this.perPage
                }

            }).then(response => {
                console.log(response);

                if (response.data.characters && Array.isArray(response.data.characters)) {

                    this.characters = this.characters.concat(response.data.characters); // Use concat to merge arrays
                    this.page++;
                    this.loading = false;
                }
            }).catch(error => {
                console.error(error);
                this.loading = false;
            });
        },
        handleScroll() {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500) {
                this.loadCharacters();
            }
        }
    }
};
</script>


<style scoped>
.container {
    margin-top: 2rem;
}

.card {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
}

.card-text {
    font-size: 1rem;
    color: #6c757d;
}

h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.text-center {
    margin-top: 1rem;
}
</style>

  