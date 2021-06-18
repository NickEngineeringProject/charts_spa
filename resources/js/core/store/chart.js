export default {
    namespaced: true,
    state: () => ({
      option:  {
          series_type : null,
          series_data: null,
          series_name: null,
          x_axis: null,
          y_axis: null,
          array_series: null
      }
    }),
    getters: {
        getOption: state => state.option,
    },
    mutations: {
        setOption: (state,payload) => state.option = payload
    }
}
