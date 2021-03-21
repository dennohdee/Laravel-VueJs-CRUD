<script>
import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  props: {
    chartdata: {
      type: Object,
      default: null
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
    }
  },
  mounted () {
      console.log(this.chartdata)
    this.renderChart(this.chartdata, this.options)
  }
}
</script>