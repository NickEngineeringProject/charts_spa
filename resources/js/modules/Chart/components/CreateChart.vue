<template>
    <div>
        <form action="#">
            <div>
                <label>Сменить направление оси</label>
                <input type="checkbox" v-model="axis">
            </div>
            <div>
                <label>введите данные или категории для отображения по оси</label>
                <input type="text" v-model="option.xAxis.data">
            </div>
            <div>
                <label>введите данные то есть точки для постороения диаграммы</label>
                <input type="text" v-model="option.series[0].data">
            </div>
        </form>
        <v-chart v-if="render" class="chart" :option="option" />
    </div>
</template>

<script>
import * as echarts from 'echarts/core';
import { GridComponent } from 'echarts/components';
import { LineChart } from 'echarts/charts';
import { CanvasRenderer } from 'echarts/renderers';
import VChart, { THEME_KEY } from "vue-echarts";

echarts.use([GridComponent, LineChart, CanvasRenderer]);

export default {
    name: "HelloWorld",
    components: {
        VChart
    },
    provide: {
        [THEME_KEY]: "dark"
    },
    watch: {
    "axis": function (){
        this.render = false
        this.$nextTick(()=> {this.render = true})
          if (this.axis) {
              this.option.xAxis = this.pointsValue
              this.option.yAxis = this.axisTitles
          }
          if (!this.axis) {
              this.option.Axis = this.axisTitles
              this.option.yAxis = this.pointsValue
          }
          console.log(this.axis)
          console.log(this.option)
      }
    },
    data() {
        return {
            render: true,
            axisTitles: null,
            pointsValue: null,
            axis: false,
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
    methods: {
        transformDataChart() {

        }
    }
};
</script>

<style scoped>
.chart {
    height: 400px;
}
</style>


