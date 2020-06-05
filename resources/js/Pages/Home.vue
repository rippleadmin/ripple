<template>
  <div>
    Hi Home
    <water-component :value="aaa"></water-component>
  </div>
</template>

<script>
export default {
  props: {
    aaa: Object
  }
}
</script>
