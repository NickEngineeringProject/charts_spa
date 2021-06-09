import NotFound from "./components/NotFound";
import Create from "../modules/Chart/components/CreateChart";
import CreateCharts from "../modules/Chart/components/CreateCharts";

export const routes = [
    {
        path: '/',
        name: 'CreateChart',
        component: Create,
    },
    {
        path: '/charts',
        name: 'CreateCharts',
        component: CreateCharts,
    },
    {
        path: '*',
        component: NotFound,
        name: 'not_found'
    }
];

