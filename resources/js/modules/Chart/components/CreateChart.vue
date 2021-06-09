<template>
    <div>
        <h2>Создание диаграммы</h2>
        <p>1 шаг: выберите тип диаграммы
            <select class="form">
                <option
                    v-for="item in items"
                    v-bind:key="item.id"
                    v-bind:value="item"
                    v-text="item.title"
                ></option>
            </select>
        </p>
        <p>2 шаг: введите данные т.е. точки для построения
            <input type="text">
        </p>
        <p>3 шаг: введите данные для отображения по оси
            <select class="form">
                <option
                    v-for="item in axis"
                    v-bind:key="item.id"
                    v-bind:value="item"
                    v-text="item.title"
                ></option>
            </select>
            <input type="text">
        </p>
    </div>
</template>

<script>
export default {
    name: "Create",
    data: () => {
        return {
            items: [
                {
                    id: 1,
                    title: 'line',
                    sort: 1,
                },
                {
                    id: 2,
                    title: 'bar',
                    sort: 2,
                },
                {
                    id: 3,
                    title: 'pie',
                    sort: 3,
                },
            ],
            axis: [
                {
                    id: 1,
                    title: 'x',
                    sort: 1,
                },
                {
                    id: 2,
                    title: 'y',
                    sort: 2,
                },
            ],
            sort: null,
        }
    }
}
</script>

<style scoped>

</style>
