import { createApp } from 'vue';

const app = createApp({});

import CharacterList from './components/CharacterList.vue';
app.component('character-list', CharacterList);

app.mount('#app');