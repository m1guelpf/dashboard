import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import Dashboard from './components/Dashboard';
import Calendar from './components/Calendar';
import Statistics from './components/Statistics';
import InternetConnection from './components/InternetConnection';
import TaskList from './components/TaskList';
import MRR from './components/MRR';
import TimeWeather from './components/TimeWeather';
import Twitter from './components/Twitter';
import Uptime from './components/Uptime';
import TileTimer from './components/TileTimer';
import Music from './components/Music';

new Vue({
    el: '#dashboard',

    components: {
        Dashboard,
        Calendar,
        Statistics,
        InternetConnection,
        TaskList,
        TimeWeather,
        Twitter,
        Uptime,
        Music,
        TileTimer,
        mrr: MRR,
    },

    created() {
        let config = {
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
            wsHost: window.location.hostname,
            wsPath: window.dashboard.clientConnectionPath,
            wsPort: window.dashboard.wsPort,
            disableStats: true,
        };

        if (window.dashboard.environment === 'local') {
            config.wsPort = 6001;
        }

        this.echo = new Echo(config);
    },
});
