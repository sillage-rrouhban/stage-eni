import { createApp } from 'vue'
import App from './pages/AppAccount'
import{setupI18n} from "./i18n"
import fr from '@/i18n/locales/fr.json'
import en from '@/i18n/locales/en.json'

const i18n = setupI18n({
    globalInjection: true,
    legacy: false,
    locale: 'fr',
    fallbackLocale: 'fr',
    messages: {
        fr,
        en
    }
})

const app = createApp(App);

app.use(i18n)
app.mount('#app')