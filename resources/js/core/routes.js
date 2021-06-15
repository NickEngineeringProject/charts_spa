import NotFound from "./components/NotFound";
import Create from "../modules/Chart/components/CreateChart";

export const routes = [
    {
        path: '/',
        name: 'CreateChart',
        component: Create,
    },
    {
        path: '*',
        component: NotFound,
        name: 'not_found'
    }
];

