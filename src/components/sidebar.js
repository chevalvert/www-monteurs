import rafThrottle from 'utils/raf-throttle'
import stick from 'controllers/sticky'
import docHeight from 'utils/dom-document-height'
import mobile from 'utils/is-mobile'

export default ({
  element = document.querySelector('.sidebar__content'),
  margin = 40
} = {}) => {
  if (mobile) return
  if (!element) return

  const container = element.parentNode
  const menu = document.querySelector('header.menu')
  const header = document.querySelector('.main__header')
  const footer = document.querySelector('.footer[role="main"]')

  const h = {
    menu: menu && (menu.offsetHeight + margin),
    header: header && header.offsetHeight,
    footer: footer && (footer.offsetHeight + margin)
  }

  const topWindowPadding = () => h.menu + Math.max(0, h.header - window.pageYOffset)
  const pageYBottomOffset = () => docHeight() - (window.pageYOffset + window.innerHeight)
  const bottomWindowPadding = () => margin + Math.max(0, h.footer - pageYBottomOffset())
  const visibleAvailableHeight = () => (window.innerHeight - topWindowPadding() - bottomWindowPadding())

  let update = rafThrottle(refreshLayout)
  window.addEventListener('scroll', update, false)
  window.addEventListener('resize', update, false)
  window.addEventListener('load', update)
  update()

  let sticker = stick({
    elements: [element],
    offy: h.menu
  })

  return {
    destroy: () => {
      window.removeEventListener('scroll', update)
      window.removeEventListener('resize', update)
      sticker.destroy()
    }
  }

  function refreshLayout () {
    const height = visibleAvailableHeight() + 'px'
    if (height !== element.style.height) element.style.height = height
    if (element.style.width !== container.offsetWidth + 'px') element.style.width = container.offsetWidth + 'px'
  }
}
