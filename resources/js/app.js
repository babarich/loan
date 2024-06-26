import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import {InertiaProgress} from "@inertiajs/progress";
import PrimeVue from "primevue/config";
import ConfirmationService from "primevue/confirmationservice";
import ToastService from "primevue/toastservice";
import Tooltip from "primevue/tooltip"
import "primevue/resources/primevue.min.css"
import "primeicons/primeicons.css"
import "primevue/resources/themes/lara-light-indigo/theme.css"
import VueApexCharts from 'vue3-apexcharts'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue)
            .use(ConfirmationService)
            .use(ToastService)
            .use(ZiggyVue)
            .use(VueApexCharts)
            .directive('tooltip', Tooltip)
            .mixin({
                methods:{
                    route,
                    can:function (){
                        return this.$page.props.can
                    }
                }
            })
            .mount(el);
    },
    progress: {
        color: '#E11E1E',
    },
});


InertiaProgress.init({color:'#E11E1E'})
