import textfit from 'textfit'
import rafThrottle from 'utils/raf-throttle'

export default ({
  elements,
  selector = '.featured__hero-item-title',
  minFontSize = 0,
  maxFontSize = 9999
} = {}) => {
  elements = elements || document.querySelectorAll(selector)
  if (!elements || !elements.length) return

  const fitter = rafThrottle(() => {
    // NOTE: as textfit seems to have difficulties resizing the font, setting
    // already fitted text to 0px so that it only has to grow
    const alreadyFitted = document.querySelector('.textFitted')
    if (alreadyFitted) alreadyFitted.style.fontSize = '0px'

    textfit(elements, {
      minFontSize,
      maxFontSize,
      widthOnly: false,
      multiLine: true
    })
  })

  window.addEventListener('resize', fitter, false)
  fitter()

  return {
    destroy: () => {
      window.removeEventListener('resize', fitter)
    }
  }
}
