<template>
    <div class="dark:bg-gray-800">
        <h2>Создание диаграммы</h2>
        <form action="#" method="post">
            <div>
                <label>Выберите тип диаграммы</label>
                <input type="text" v-model="this.option.series[0].type">
            </div>
            <div>
                <label>Сменить направление оси</label>
                <input type="checkbox" v-model="axis">
            </div>
            <div>
                <label>Введите данные или категории для отображения по оси</label>
                <input type="text" v-model="option.xAxis.data">
            </div>
            <div>
                <label>Введите данные то есть точки для постороения диаграммы</label>
                <input type="text" v-model="option.series[0].data">
            </div>
            <button v-on:click.prevent="getFilterRequest()">Создать</button>
        </form>
        <v-chart v-if="render" class="chart" :option="option" />
        <div>
            {{this.option}}
        </div>
    </div>
</template>

<script>
import * as echarts from 'echarts/core';
import {
    GridComponent,
    LegendComponent,
    TitleComponent,
    ToolboxComponent,
    DataZoomComponent,
    VisualMapComponent,
    TimelineComponent,
    CalendarComponent
} from 'echarts/components';
import { LineChart } from 'echarts/charts';
import { CanvasRenderer } from 'echarts/renderers';
import VChart, { THEME_KEY } from "vue-echarts";
echarts.use([
    GridComponent,
    LegendComponent,
    TitleComponent,
    ToolboxComponent,
    DataZoomComponent,
    VisualMapComponent,
    TimelineComponent,
    CalendarComponent,
    LineChart,
    CanvasRenderer
]);

export default {
    name: "Chart",
    components: { VChart },
    provide: { [THEME_KEY]: "dark" },
    watch: {
        // "axis": function () {
        //     axios('')
        // }
    },
    data() {
        return {
            render: true,
            option: {
                xAxis: {
                    type: 'category',
                    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                    data: [150, 230, 224, 218, 135, 147, 260],
                    type: 'line'
                }]
            }
        };
    },
    mounted() {},
    methods: {
        getFilterRequest() {
            axios['post']('http://127.0.0.1:8000/api/chart', {
                "x_axis": this.option.xAxis.data ? this.option.xAxis.data.toString() : "",
                "y_axis": this.option.yAxis.data ? this.option.xAxis.data.toString() : "",
                "series_data": this.option.series[0].data.toString(),
                "series_name": "",
                "series_type": this.option.series[0].type,
                "array_series": ""
            }).then(response => console.log(response))
                .catch(error => console.log(error));
        }
    }
}
</script>

<style scoped>
.chart { height: 400px; }
</style>
