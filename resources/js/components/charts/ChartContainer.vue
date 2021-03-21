<template>
  <div class="container">
    <line-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
import LineChart from './Chart.vue'

export default {
  name: 'LineChartContainer',
  components: { LineChart },
  data: () => ({
    loaded: false,
    chartdata: null,
    options: null
  }),
  async mounted () {
    this.loaded = false
    try {
      axios.get('/chart/product-orders')
      .then(function(response){
        this.chartdata = response.data;
        this.loaded = true
      }.bind(this));
      
    } catch (e) {
      console.error(e)
    }
  }
}
</script>
