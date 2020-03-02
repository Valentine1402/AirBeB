<template>
  <li @click="sendCoordinates"><slot></slot></li>
</template>

<script>
export default {

  props:['lon', 'lat', 'address'],
  data(){
    return{
      coordinates:{
        long: this.lon,
        lati: this.lat,
        addr: this.address
      }
    }
  },
  methods:{
    sendCoordinates(){
      this.$emit('click-address', this.coordinates)
    }
  }

}
</script>

<style lang="scss" scoped>
  li:hover{
    cursor: pointer;
  }
</style>
