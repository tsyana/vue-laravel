<template lang="html">
  <div class="" style="text-align:center">
      您要查询的车牌号为{{num}}
  </div>
</template>

<script>
export default {
  data(){
    return{
      num:''
    }
  },
  mounted(){
    console.log(this.$route.query.num)
    this.num = this.$route.query.num;
  }
}
</script>

<style lang="css">
</style>
