import Ripple from './Ripple'

if (window !== undefined && ! window.Ripple) {
  window.Ripple = new Ripple()
}
