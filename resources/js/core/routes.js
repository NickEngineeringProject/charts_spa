import NotFound from "./components/NotFound";
import Create from "../modules/Chart/components/CreateChart";
import Chart from "../modules/Chart/components/Chart";

export const routes = [
    {
        path: '/',
        name: 'Chart',
        component: Chart,
    },
    {
        path: '/create',
        name: 'CreateChart',
        component: Create,
    },
    {
        path: '*',
        component: NotFound,
        name: 'not_found'
    }
];

