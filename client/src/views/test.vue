<template lang="html">
  <div class="test-rem">
    <div class="box-title">
    </div>
    <div class="box-content">
      <input type="number" name="" value="" placeholder="请输入车牌号" :class="{'center':bikeNum!=''}" v-model="bikeNum">
      <button type="button" name="button" :class="{'active':bikeNum!=''}" @click="goGet">→</button>
      <h3>输入车牌号，查询解锁码</h3>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      bikeNum:''
    }
  },
  methods:{
    goGet(){
      if(this.bikeNum != ""){
        this.$router.push({
          path:'/get-password',
          query:{
            num:this.bikeNum
          }
        })
      }else{
        return
      }

    }
  }
}
</script>

<style lang="less" scoped>
.test-rem {
    padding: 20px;
    border-radius: 6px;
    position: absolute;
    width: 80%;
    top: 30%;
    left: 50%;
    transform: translate(-50%,0);
    box-shadow: 1px 1px 11px #333333;
    .box-content,
    .box-title {
        text-align: center;
    }
    .box-title {
        padding: 20px;
        height: 100px;
        background: url('../assets/ceshi.png') no-repeat;
        background-size: contain;
        background-position: center;
    }
    .box-content {
        padding: 20px;
        button {
            height: 60px;
            width: 60px;
            border: 0;
            border-radius: 6px;
            background: #e3e3e3;
            color: #333333;
            margin-left: 20px;
            font-size: 20px;
        }
        h3 {
            margin-top: 20px;
            font-size: 10px;
            color: dimgray;
        }
    }
    .box-content input {
        height: 60px;
        border: 2px solid yellow;
        border-radius: 6px;
        font-size: 16px;
    }
    input::placeholder{
      text-align: center;
    }
    .center{
      text-align: center;
      // padding-left: 0 !important;
    }
    .active{
      background: yellow !important;
    }
}
</style>
