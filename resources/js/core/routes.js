import Chart from "./components/Chart";
import NotFound from "./components/NotFound";

const requireContext = require.context('../modules', true, /routes\.js$/)

const modules = requireContext.keys()
    .map(file =>
        [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)]
    )

let moduleRoutes = [];

for(let i in modules) {
    moduleRoutes = moduleRoutes.concat(modules[i][1].routes)
}

export const routes = [
    {
        path: '/',
        component: Chart,
        // children: [
        //     {
        //         path: '/',
        //         component: Chart,
        //         name: 'chart',
        //     },
        //     {
        //         path: '*',
        //         component: NotFound,
        //         name: 'not_found'
        //     }
        // ]
    },
    {
        path: '*',
        component: NotFound,
        name: 'not_found'
    }
];

