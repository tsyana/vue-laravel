<template lang="html">
  <div class="" style="text-align:center">
    <div class="" >
        您要查询的车牌号为{{num}}
    </div>
    <div class="" v-if="password!=''">
      密码为{{password}}
    </div>
    <div class="" v-else>
      暂无密码，是否上传？
      <input type="text" name="" value="" v-model="newPassword">
      <button type="button" name="button" @click="newPas">upload</button>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios,axios);
export default {
  data(){
    return{
      num:'',
      password:"",
      newPassword:""
    }
  },
  mounted(){
    this.num = this.$route.query.num;
    Vue.axios.get("/api/articleBrief/getPassword",{
      params:{
        id:this.$route.query.num
      }
    }).then((response) => {
      if(response.data.length>0){
        this.password = response.data[0].password
      }
      // console.log(response.data)
    })
  },
  methods:{
    newPas(){
      Vue.axios.post("/api/insertPassword",{
        password:this.newPassword,
        bikeId:this.num
      }).then((data)=>{
        if(data.data=='success'){
          this.$router.push({
            path:'/test'
          })
        }
      })
    }
  }
}
</script>

<style lang="css">
</style>
