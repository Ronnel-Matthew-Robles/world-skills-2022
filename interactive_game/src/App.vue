<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap";

export default {
  name: "App",
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
}
body {
  width: 1280px;
  height: 720px;
}
</style>
