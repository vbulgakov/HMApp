import {createWebHistory, createRouter} from "vue-router";

import Login from './pages/Login';
import Welcome from "./pages/Welcome";

import People from './pages/people/People';
import AddPerson from './pages/people/AddPerson';
import EditPerson from './pages/people/EditPerson';

import Language from './pages/language/Language';
import AddLanguage from './pages/language/AddLanguage';
import EditLanguage from './pages/language/EditLanguage';

import Interest from './pages/interest/Interest';
import AddInterest from './pages/interest/AddInterest';
import EditInterest from './pages/interest/EditInterest';


export const routes = [
    {
        name: 'welcome',
        path: '/',
        component: Welcome
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'people',
        path: '/people',
        component: People
    },
    {
        name: 'addperson',
        path: '/people/create',
        component: AddPerson
    },
    {
        name: 'editperson',
        path: '/people/edit/:id',
        component: EditPerson
    },

    {
        name: 'language',
        path: '/language',
        component: Language
    },
    {
        name: 'addlanguage',
        path: '/language/create',
        component: AddLanguage
    },
    {
        name: 'editlanguage',
        path: '/language/edit/:id',
        component: EditLanguage
    },

    {
        name: 'interest',
        path: '/interest',
        component: Interest
    },
    {
        name: 'addinterest',
        path: '/interest/create',
        component: AddInterest
    },
    {
        name: 'editinterest',
        path: '/interest/edit/:id',
        component: EditInterest
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
