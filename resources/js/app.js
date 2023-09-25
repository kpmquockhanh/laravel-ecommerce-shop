import './bootstrap';
import {createApp} from 'vue'
import router from './routes'
import App from '../views/App.vue'
import { createI18n } from 'vue-i18n-lite'

async function loadLocaleMessages() {
    const modules = import.meta.glob('../locales/*.json')
    const messages = {}
    for (let i = 0; i < Object.keys(modules).length; i++) {
        const fileName = Object.keys(modules)[i]
        const split = fileName.split('/')
        let locale = (split[split.length - 1]).replaceAll('.json', '') || 'en'
        const module = await Object.values(modules)[i]()
        messages[locale] = {
            ...module.default,
        }
    }
    return messages
}

const currentLocale = localStorage.getItem('locale') || 'vi'

const i18n = createI18n({
    locale: currentLocale,
    messages: await loadLocaleMessages(),
    fallbackLocale: 'en'
})


createApp(App).use(i18n).use(router).mount("#app")

