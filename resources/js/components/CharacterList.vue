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
    props: {
        initialCharacters: {
            type: Array,
            required: true
        },
        initialNextPage: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            characters: [...this.initialCharacters], // Spread the initial characters to ensure it's an array
            loading: false,
            nextPage: this.initialNextPage
        };
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        loadCharacters() {
            if (this.loading || !this.nextPage) return;
            this.loading = true;

            axios.get(this.nextPage).then(response => {
                if (response.data.results && Array.isArray(response.data.results)) {
                    this.characters = this.characters.concat(response.data.results);
                    this.nextPage = response.data.info.next; // Update nextPage with the next link
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

.text-center {
    margin-top: 1rem;
}
</style>
