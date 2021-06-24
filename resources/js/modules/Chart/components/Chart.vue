<template>
    <div class="dark:bg-gray-800">
        <h2>Создание диаграммы</h2>
        <form action="#" method="post">
            <div>
                <label>Выберите тип диаграммы</label>
                <input type="text" v-model="this.option.series[0].type">
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
        <v-chart class="chart" :option="options" />
        <div>{{this.options}}</div>
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
import VChart, { THEME_KEY, UPDATE_OPTIONS_KEY } from "vue-echarts";
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
    provide: { [THEME_KEY]: "dark"},
    data() {
        return {
            option: {
                xAxis: {
                    type: 'category',
                    data: []
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                    data: [],
                    type: 'line'
                }]
            },
            options: {}
        };
    },
    methods: {
        getFilterRequest() {
            axios['post']('http://127.0.0.1:8000/api/chart', {
                "x_axis": this.option.xAxis.data ? this.option.xAxis.data.toString() : "",
                "y_axis": this.option.yAxis.data ? this.option.xAxis.data.toString() : "",
                "series_data": this.option.series[0].data.toString(),
                "series_name": "",
                "series_type": this.option.series[0].type
            }).then(response => {
                this.options = response.data
                console.log(response.data)
            })
                .catch(error => console.log(error));
        }
    }
}
</script>

<style scoped>
.chart { height: 400px; }
</style>
