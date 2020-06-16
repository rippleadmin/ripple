<template>
  <input :type="type" :value="value" @input="$emit('input', value)">
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      required: true
    },
    type: {
      type: String,
      default: 'text'
    }
  }
}
</script>
