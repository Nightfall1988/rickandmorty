<template>
    <div class="container">
        <transition-group name="fade" tag="div" class="character-grid">
            <div class="character-card" v-for="character in characters" :key="character.id">
                <a :href="`/character/${character.id}`" class="btn btn-primary">
                    <div class="card">
                        <img :src="character.image" class="card-img-top" :alt="character.name">
                        <div class="card-body">
                            <p class="card-title">{{ character.name }}</p>
                            <p class="card-text">Status: {{ character.status }}</p>
                            <p class="card-text">Species: {{ character.species }}</p>
                            <p class="card-text">Gender: {{ character.gender }}</p>
                            <p class="card-text">Location: {{ character.location.name }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </transition-group>
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
            characters: [...this.initialCharacters],
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
                    this.nextPage = response.data.info.next;
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