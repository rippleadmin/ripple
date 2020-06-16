<template>
  <div>
    Hi Home
    <w-component :value="aaa"></w-component>
  </div>
</template>

<script>
export default {
  props: {
    aaa: Object
  }
}
</script>
