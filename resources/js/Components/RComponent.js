import { mergeData } from 'vue-functional-data-merge'

export default {
  functional: true,
  props: {
    value: {
      type: Object,
      required: true,
      validator: function (component) {
        return ['name', 'props'].every(key => component.hasOwnProperty(key))
      }
    }
  },
  render(h, { props, data, children }) {
    return h(props.value.name.split('/').pop(), mergeData(data, {
      props: props.value.props
    }), children)
  }
}
