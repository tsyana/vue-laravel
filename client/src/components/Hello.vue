<template>
  <div class="hello">
    <div class="main-contain">
      dafsf
      <div class="test">
        alsdfjalskdjflak
      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'hello',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang="less">
.hello{
  display: flex;
  justify-content: center;
  align-items: center;
  .main-contain{
    display: flex;
    background: green;
  }
}
div.test{
  background: red;
  font-size:50px;
}
</style>
